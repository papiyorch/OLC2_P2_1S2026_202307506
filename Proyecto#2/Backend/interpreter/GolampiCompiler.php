<?php

use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;

class GolampiCompiler extends GolampiBaseVisitor
{
    // Archivos de salida
    private string $output      = ''; 
    private string $dataOutput  = ''; 
    
    private Environment $globalEnv;
    private Environment $currentEnv;
    private array $semanticErrors = [];

    private int $labelCount  = 0;
    private int $stringCount = 0;
    
    private array $loopStartLabels = [];
    private array $loopEndLabels   = [];

    public function __construct()
    {
        $this->globalEnv  = new Environment('global');
        $this->currentEnv = $this->globalEnv;
        Environment::resetSymbols();
    }

    public function getFinalAssembly(): string 
    {
        $dataSection = ".section .data\n";
        $dataSection .= "buffer:\n    .ascii \"0\\n\"\n";             
        $dataSection .= "newline:\n    .asciz \"\\n\"\n";             
        $dataSection .= "concat_buffer:\n    .space 2048\n";          
        $dataSection .= $this->dataOutput . "\n";
        
        $textSection = ".section .text\n.align 2\n.global _start\n\n";
        $textSection .= $this->output;
        
        return $dataSection . $textSection;
    }

    public function getSymbolTable(): array { return Environment::getAllSymbols(); }
    public function getSemanticErrors(): array { return $this->semanticErrors; }

    private function addError(string $msg, int $line = 0, int $col = 0): void
    {
        $this->semanticErrors[] = ['type' => 'Semántico', 'desc' => $msg, 'line' => $line, 'column' => $col];
    }

    private function nextLabel(string $prefix): string {
        return $prefix . ($this->labelCount++);
    }

    // ──────────────────────────────────────────────
    // INFERENCIA BÁSICA DE TIPOS 
    // ──────────────────────────────────────────────
    private function getExprType($exprCtx): string 
    {
        if ($exprCtx === null) return 'int32';
        if (is_array($exprCtx)) $exprCtx = $exprCtx[0];
        $text = $exprCtx->getText();

        // --- INFERENCIA PARA TERNARIO (? :) ---
        if (method_exists($exprCtx, 'expression')) {
            $exprs = $exprCtx->expression();
            // Validamos que sea un arreglo y tenga exactamente 3 expresiones
            if (is_array($exprs) && count($exprs) === 3) {
                // Retornamos el tipo del lado "verdadero"
                return $this->getExprType($exprs[1]);
            }
        }
        
        // 1. Funciones Nativas, Strings y Booleanos
        if (str_contains($text, '"')) return 'string';
        if (str_starts_with($text, 'len(')) return 'int32';
        if (str_starts_with($text, 'substr(')) return 'string';
        if (str_starts_with($text, 'now(')) return 'string';
        if (str_starts_with($text, 'typeOf(')) return 'string';
        
        $textNoPipe = str_replace('|>', '', $text); 
        if ($textNoPipe === 'true' || $textNoPipe === 'false' || str_contains($textNoPipe, '==') || str_contains($textNoPipe, '!=') || str_contains($textNoPipe, '<') || str_contains($textNoPipe, '>') || str_contains($textNoPipe, '&&') || str_contains($textNoPipe, '||') || str_starts_with($textNoPipe, '!')) return 'bool';
        
        // 2. Arreglos literales (ej. [2][2]int32)
        if (preg_match('/^(\[\d+\])+(int32|float32|string|bool|rune)/', $text, $matches)) {
            return $matches[0]; 
        }
        
        // 3. Literales Flotantes
        if (str_contains($text, '.')) return 'float32';
        
        // 4. Inferencia Dinamica por Tabla de Simbolos
        $foundType = 'int32';
        preg_match_all('/[a-zA-Z_][a-zA-Z_0-9]*/', $text, $matches);
        if (!empty($matches[0])) {
            foreach ($matches[0] as $word) {
                if (in_array($word, ['int32', 'float32', 'string', 'bool', 'rune'])) continue;
                try {
                    $sym = $this->currentEnv->getSymbol($word);
                    $t = $sym['type'];
                    
                    // --- LIMPIEZA DE PUNTEROS MULTIPLES ---
                    $t = ltrim($t, '*'); 
                    
                    if (str_contains($t, 'float32')) $foundType = 'float32';
                    if (str_contains($t, 'string')) $foundType = 'string';
                    if (str_contains($t, 'bool')) $foundType = 'bool'; 
                    if (str_contains($t, 'rune')) $foundType = 'rune';
                    if (str_contains($t, '[')) $foundType = $t; // Arrastrar matriz si existe
                } catch (\Exception $e) {}
            }
        }
        
        // 5. BLINDAJE MATEMATICO
        if (str_contains($text, '[') || str_contains($text, '+') || str_contains($text, '-') || str_contains($text, '*') || str_contains($text, '/')) {
            if (!preg_match('/^(\[\d+\])+/', $text)) {
                $foundType = preg_replace('/\[\d+\]/', '', $foundType);
            }
        }
        
        return $foundType;
    }

    

    public function visitStart($ctx): mixed
    {
        foreach ($ctx->topDecl() as $decl) {
            $this->visit($decl);
        }
        return null;
    }

    public function visitDeclFunction($ctx): mixed
    {
        $funcDecl = $ctx->functionDecl() ?? $ctx; 
        $name     = $funcDecl->ID()->getText();
        $line     = $funcDecl->ID()->getSymbol()->getLine();
        $col      = $funcDecl->ID()->getSymbol()->getCharPositionInLine();

        try {
            $this->globalEnv->declare($name, 'función', 0, $line, $col);
        } catch (Exception $e) {}

        $label = ($name === 'main') ? '_start' : $name;
        
        $prevEnv = $this->currentEnv;
        $this->currentEnv = $this->globalEnv->createChild("func_$name");

        $this->output .= "{$label}:\n";
        $this->output .= "    stp x29, x30, [sp, #-16]!   // Guardar Frame Pointer y Link Register \n"; 
        $this->output .= "    mov x29, sp\n";
        $this->output .= "    sub sp, sp, #2048            // Reservar memoria estatica para variables\n\n"; 

        $params = $funcDecl->paramList() ? $funcDecl->paramList()->parametro() : [];
        foreach ($params as $i => $param) {
            $pName = $param->ID()->getText();
            $pType = $param->type()->getText();
            
            if (str_contains($pType, '[') && !str_starts_with($pType, '*')) {
                $pType = '*' . $pType; 
            }
            
            $this->currentEnv->declare($pName, $pType, 8, $line, $col); 
            
            $offset = $this->currentEnv->getSymbol($pName)['offset'];
            if ($i < 8) {
                $this->output .= "    sub x9, x29, #{$offset}\n";
                $this->output .= "    str x{$i}, [x9]             // Guardar param\n";
            }
        }

        $this->visitBlock($funcDecl->block());

        $this->output .= "\n";
        if ($name === 'main') {
            $this->output .= "    // --- Salida Limpia (QEMU) ---\n";
            $this->output .= "    mov x0, #0\n";
            $this->output .= "    mov x8, #93\n";
            $this->output .= "    svc #0\n\n";
        } else {
            $this->output .= "    // --- Retornar Funcion ---\n";
            $this->output .= "    mov sp, x29\n";
            $this->output .= "    ldp x29, x30, [sp], #16\n";
            $this->output .= "    ret\n\n";
        }

        $this->currentEnv = $prevEnv;
        return null;
    }

    // ───────────────────
    // BLOQUES DE CÓDIGO 
    // ───────────────────
    public function visitBlock($ctx): mixed
    {
        $prevEnv = $this->currentEnv;
        $this->currentEnv = $this->currentEnv->createChild("block_" . uniqid());

        if ($ctx->statement()) {
            foreach ($ctx->statement() as $stmt) {
                $this->visit($stmt);
            }
        }

        $this->currentEnv = $prevEnv;

        return null;
    }

    private function flattenArrayValues($exprCtx, &$flat): void 
    {
        // Si el nodo tiene sub-valores lo aplanamos recursivamente
        if (method_exists($exprCtx, 'arrayLiteral') && $exprCtx->arrayLiteral() !== null) {
            if ($exprCtx->arrayLiteral()->valores()) {
                foreach ($exprCtx->arrayLiteral()->valores()->expression() as $e) {
                    $this->flattenArrayValues($e, $flat);
                }
            }
        } elseif (method_exists($exprCtx, 'valores') && $exprCtx->valores() !== null) {
            foreach ($exprCtx->valores()->expression() as $e) {
                $this->flattenArrayValues($e, $flat);
            }
        } else {
            $flat[] = $exprCtx; // Es un valor primitivo
        }
    }

    // ──────────────────────────────────────────────
    // LECTURA DE ARREGLOS
    // ──────────────────────────────────────────────
    public function visitExprArrayAccess($ctx): mixed 
    {
        $indices = [];
        $current = $ctx;
        
        while (method_exists($current, 'LBRACK') && $current->LBRACK() !== null) {
            array_unshift($indices, $current->expression(1));
            $current = $current->expression(0);
        }
        
        $idName = $current->getText();
        $sym = $this->currentEnv->getSymbol($idName);
        $type = $sym['type'];
        $baseOffset = $sym['offset'];

        $typeClean = str_starts_with($type, '*') ? substr($type, 1) : $type;
        preg_match_all('/\[(\d+)\]/', $typeClean, $matches);
        $dims = $matches[1];

        $this->visit($indices[0]); 
        for ($k = 1; $k < count($indices); $k++) {
            $this->output .= "    str x0, [sp, #-16]!         // PUSH acumulado\n";
            $dimVal = $dims[$k];
            $this->output .= "    mov x1, #{$dimVal}\n";
            $this->output .= "    mul x0, x0, x1              // acumulado *= dimension_actual\n";
            $this->output .= "    str x0, [sp]                // Update PUSH\n";
            
            $this->visit($indices[$k]);                 // x0 = nuevo indice
            
            $this->output .= "    ldr x1, [sp], #16           // POP acumulado\n";
            $this->output .= "    add x0, x1, x0              // x0 = acumulado + nuevo\n";
        }

        $this->output .= "    mov x1, #8\n";
        $this->output .= "    mul x0, x0, x1              // x0 = byte offset\n";

        if (str_starts_with($type, '*')) {
            $this->output .= "    sub x9, x29, #{$baseOffset}\n";
            $this->output .= "    ldr x1, [x9]                // Cargar la direccion apuntada\n";
        } else {
            $this->output .= "    sub x1, x29, #{$baseOffset}\n"; 
        }
        
        $this->output .= "    add x1, x1, x0              // Direccion Exacta\n"; 
        $this->output .= "    ldr x0, [x1]                // Leer valor del arreglo\n";

        return null;
    }

    // ──────────────────────────────────────────────
    // ESCRITURA EN ARREGLOS 
    // ──────────────────────────────────────────────
    public function visitStmtArrayAssign($ctx): mixed 
    {
        // Entramos al nodo real de la asignación
        $arrCtx = $ctx->arrayAssignment();
        
        $idName = $arrCtx->ID()->getText();
        $sym = $this->currentEnv->getSymbol($idName);
        $type = $sym['type'];
        $baseOffset = $sym['offset'];

        $exprs = $arrCtx->expression();
        $valToAssign = array_pop($exprs); // El último es el valor a asignar
        $indices = $exprs;                // Los anteriores son los índices

        // Evaluar el valor a asignar y guardarlo en el stack
        $this->visit($valToAssign);
        $this->output .= "    str x0, [sp, #-16]!         // PUSH valor a escribir\n";

        // Calcular índice plano
        $typeClean = str_starts_with($type, '*') ? substr($type, 1) : $type;
        preg_match_all('/\[(\d+)\]/', $typeClean, $matches);
        $dims = $matches[1];

        // --- Metodo de Horner para N dimensiones ---
        $this->visit($indices[0]); 
        for ($k = 1; $k < count($indices); $k++) {
            $this->output .= "    str x0, [sp, #-16]!         // PUSH acumulado\n";
            $dimVal = $dims[$k];
            $this->output .= "    mov x1, #{$dimVal}\n";
            $this->output .= "    mul x0, x0, x1              // acumulado *= dimension_actual\n";
            $this->output .= "    str x0, [sp]                // Update PUSH\n";
            
            $this->visit($indices[$k]);                 // x0 = nuevo indice
            
            $this->output .= "    ldr x1, [sp], #16           // POP acumulado\n";
            $this->output .= "    add x0, x1, x0              // x0 = acumulado + nuevo\n";
        }

        $this->output .= "    mov x1, #8\n";
        $this->output .= "    mul x0, x0, x1              // x0 = byte offset\n";

        // Soporte para arreglos normales y pasados por puntero
        if (str_starts_with($type, '*')) {
            $this->output .= "    sub x9, x29, #{$baseOffset}\n";
            $this->output .= "    ldr x1, [x9]                // Cargar la direccion apuntada\n";
        } else {
            $this->output .= "    sub x1, x29, #{$baseOffset}\n"; 
        }
        $this->output .= "    add x1, x1, x0              // x1 = Direccion fisica de la celda\n"; 

        // Recuperar valor y escribir
        $this->output .= "    ldr x0, [sp], #16           // POP valor a escribir\n";
        $this->output .= "    str x0, [x1]                // ¡Sobrescribir celda!\n\n";

        return null;
    }

    public function visitVarDecl($ctx): mixed
    {
        $ids = $ctx->ID();
        $type = $ctx->type()->getText();
        $hasVal = $ctx->valores() !== null;

        // Detectar si el tipo es un arreglo y calcular su tamaño total
        preg_match_all('/\[(\d+)\]/', $type, $matches);
        $isArray = !empty($matches[1]);
        $totalElements = 1;
        if ($isArray) {
            foreach ($matches[1] as $dim) $totalElements *= (int)$dim;
        }
        $sizeInBytes = $isArray ? ($totalElements * 8) : 8;

        foreach ($ids as $i => $idNode) {
            $name = $idNode->getText();
            $line = $idNode->getSymbol()->getLine();
            $col  = $idNode->getSymbol()->getCharPositionInLine();

            try {
                $visualValue = '—';
                if ($hasVal && $ctx->valores()->expression($i)) {
                    $visualValue = $ctx->valores()->expression($i)->getText();
                    
                    // VALIDACIÓN DE NIL
                    if ($visualValue === 'nil' && !str_starts_with($type, '*')) {
                        $this->addError("No se puede asignar 'nil' al tipo primitivo '$type'.", $line, $col);
                        continue; // Saltamos a la siguiente variable sin declararla
                    }

                } else {
                    $visualValue = $isArray ? '[...]' : '0';
                }

                // Declaramos el tamaño completo del arreglo en el entorno
                $this->currentEnv->declare($name, $type, $sizeInBytes, $line, $col, $visualValue);
                $offset = $this->currentEnv->getSymbol($name)['offset'];

                if ($isArray) {
                    if ($hasVal && $ctx->valores()->expression($i)) {
                        $flatExprs = [];
                        $this->flattenArrayValues($ctx->valores()->expression($i), $flatExprs);
                        
                        // Guardar cada elemento del arreglo plano en la memoria
                        foreach ($flatExprs as $idx => $expr) {
                            $this->visit($expr); // El valor evaluado queda en x0
                            $elemOffset = $offset - ($idx * 8); 
                            $this->output .= "    sub x9, x29, #{$elemOffset} // Calcular direccion\n";
                            $this->output .= "    str x0, [x9]                // Init array $name elem {$idx}\n";
                        }
                    }
                } else {
                    if ($hasVal && $ctx->valores()->expression($i)) {
                        $exprCtx = $ctx->valores()->expression($i);
                        $this->visit($exprCtx); // El valor evaluado queda en x0
                        
                        $exprType = $this->getExprType($exprCtx);
                        if ($type === 'int32' && str_contains($exprType, 'float32')) {
                            $this->output .= "    fmov s0, w0                 // Pasar binario a FPU\n";
                            $this->output .= "    fcvtzs w0, s0               // Convertir Float a Int32 (Truncar)\n";
                        }
                    } else {
                        $this->output .= "    mov x0, xzr\n";
                    }
                    $this->output .= "    sub x9, x29, #{$offset}\n";
                    $this->output .= "    str x0, [x9]                // Almacenar en $name\n\n";
                }
            } catch (Exception $e) {
                $this->addError($e->getMessage(), $line, $col);
            }
        }
        return null;
    }

    // ──────────────────────────────────────────────
    // DECLARACIÓN DE CONSTANTES
    // ──────────────────────────────────────────────
    public function visitConstantDecl($ctx): mixed
    {
        $name = $ctx->ID()->getText();
        $type = $ctx->type()->getText();
        $line = $ctx->ID()->getSymbol()->getLine();
        $col  = $ctx->ID()->getSymbol()->getCharPositionInLine();

        $exprCtx = $ctx->expression();
        $visualValue = $exprCtx->getText();

        if ($visualValue === 'nil') {
            $this->addError("No se puede asignar 'nil' a una constante.", $line, $col);
            return null;
        }

        $this->visit($exprCtx); // El valor evaluado queda en x0

        try {
            $this->currentEnv->declare($name, "const_" . $type, 8, $line, $col, $visualValue);
            
            $offset = $this->currentEnv->getSymbol($name)['offset'];
            $this->output .= "    sub x9, x29, #{$offset}\n";
            $this->output .= "    str x0, [x9]                // Declarar constante $name\n";

        } catch (Exception $e) {
            $this->addError($e->getMessage(), $line, $col);
        }
        return null;
    }

    // ──────────────────────────────────────
    // DECLARACIÓN CORTA MÚLTIPLE (:=) 
    // ──────────────────────────────────────
    public function visitShortDecl($ctx): mixed
    {
        $ids = $ctx->ID(); 
        $exprs = $ctx->valores()->expression();
        $isMultiReturn = (count($exprs) === 1 && count($ids) > 1);

        if ($isMultiReturn) {
            $this->visit($exprs[0]); 
        } else {
            foreach ($exprs as $i => $expr) {
                $type = $this->getExprType($expr);
                if (!str_contains($type, '[')) {
                    $this->visit($expr);
                    $this->output .= "    str x0, [sp, #-16]!         // PUSH temp\n";
                }
            }
            for ($i = count($exprs) - 1; $i >= 0; $i--) {
                $type = $this->getExprType($exprs[$i]);
                if (!str_contains($type, '[')) {
                    $this->output .= "    ldr x{$i}, [sp], #16        // POP a x{$i}\n";
                }
            }
        }

        foreach ($ids as $i => $idNode) {
            $name = $idNode->getText();
            $line = $idNode->getSymbol()->getLine();
            $col  = $idNode->getSymbol()->getCharPositionInLine();
            
            try {
                $expr = $exprs[$i];
                $type = $this->getExprType($expr); 
                
                preg_match_all('/\[(\d+)\]/', $type, $matches);
                $isArray = !empty($matches[1]);
                $totalElements = 1;
                if ($isArray) {
                    foreach ($matches[1] as $dim) $totalElements *= (int)$dim;
                }
                $sizeInBytes = $isArray ? ($totalElements * 8) : 8;

                $this->currentEnv->declare($name, $type, $sizeInBytes, $line, $col, '...');
                $offset = $this->currentEnv->getSymbol($name)['offset'];
                
                if ($isArray) {
                    $textExpr = $expr->getText();
                    
                    if (str_starts_with($textExpr, '{') || str_starts_with($textExpr, '[')) {
                        $flatExprs = [];
                        $this->flattenArrayValues($expr, $flatExprs);
                        foreach ($flatExprs as $idx => $elemExpr) {
                            $this->visit($elemExpr); 
                            $elemOffset = $offset - ($idx * 8); 
                            $this->output .= "    sub x9, x29, #{$elemOffset}\n";
                            $this->output .= "    str x0, [x9]                // Init elem {$idx}\n";
                        }
                    } else {
                        $this->visit($expr); 
                        $lblCopy = $this->nextLabel('L_CPY_ARR_');
                        $lblDone = $this->nextLabel('L_CPY_DONE_');
                        
                        $this->output .= "    mov x1, x0                  // x1 = Direccion origen\n";
                        $this->output .= "    sub x2, x29, #{$offset}     // x2 = Direccion destino (base)\n";
                        $this->output .= "    ldr x3, ={$totalElements}   // x3 = Cantidad de elementos\n";
                        
                        $this->output .= "{$lblCopy}:\n";
                        $this->output .= "    cbz x3, {$lblDone}\n";
                        $this->output .= "    ldr x4, [x1], #8            // Leer de origen y avanzar\n";
                        $this->output .= "    str x4, [x2], #8            // Escribir en destino y avanzar\n";
                        $this->output .= "    sub x3, x3, #1\n";
                        $this->output .= "    b {$lblCopy}\n";
                        $this->output .= "{$lblDone}:\n";
                    }
                } else {
                    $this->output .= "    sub x9, x29, #{$offset}\n";
                    $this->output .= "    str x{$i}, [x9]             // Asignar x{$i} a $name\n";
                }
            } catch (Exception $e) {
                $this->addError($e->getMessage(), $line, $col);
            }
        }
        return null;
    }

    public function visitAssignSimple($ctx): mixed
    {
        $name = $ctx->ID(0)->getText();
        $line = $ctx->ID(0)->getSymbol()->getLine();
        
        $exprCtx = $ctx->valores()->expression(0);
        
        // Asignación de nil
        if ($exprCtx->getText() === 'nil') {
            $this->addError("Asignación inválida de 'nil' a la variable '$name'.", $line, 0);
            return null;
        }

        try {
            $sym = $this->currentEnv->getSymbol($name);
            
            // Reasignación de constante
            if (str_starts_with($sym['type'], 'const_')) {
                $this->addError("Reasignación de constante '$name' no permitida.", $line, 0);
                return null;
            }

            $this->visit($exprCtx); // Evaluar valor normal

            $exprType = $this->getExprType($exprCtx);
            $symType = $sym['type'];
            if ($symType === 'int32' && str_contains($exprType, 'float32')) {
                $this->output .= "    fmov s0, w0                 // Pasar binario a FPU\n";
                $this->output .= "    fcvtzs w0, s0               // Convertir Float a Int32 (Truncar)\n";
            }

            $offset = $sym['offset'];
            
            $this->output .= "    sub x9, x29, #{$offset}\n";
            
            if (str_starts_with($symType, '*')) {
                $this->output .= "    ldr x9, [x9]                // Obtener direccion original\n";
            }
            
            $this->output .= "    str x0, [x9]                // Asignar el valor\n";
        } catch (Exception $e) {
            $this->addError("Variable $name no declarada.", $line, 0);
        }
        return null;
    }

    public function visitAssignCompound($ctx): mixed
    {
        $name = $ctx->ID()->getText();
        $op   = $ctx->op->getText();
        $line = $ctx->ID()->getSymbol()->getLine();
        
        try {
            $offset = $this->currentEnv->getSymbol($name)['offset'];
            $type   = $this->currentEnv->getSymbol($name)['type'];

            $this->visit($ctx->expression());
            $this->output .= "    str x0, [sp, #-16]!         // PUSH operando derecho\n";
            
            $this->output .= "    sub x9, x29, #{$offset}     // Calcular direccion segura\n";
            $this->output .= "    ldr x0, [x9]                // Leer $name actual\n";
            $this->output .= "    ldr x1, [sp], #16           // POP operando derecho a x1\n";

            if ($type === 'string' && $op === '+=') {
                $lblCpy1  = $this->nextLabel('L_CPY1_');
                $lblDone1 = $this->nextLabel('L_CPY1_DONE_');
                $lblCpy2  = $this->nextLabel('L_CPY2_');
                $lblDone2 = $this->nextLabel('L_CPY2_DONE_');
                
                $this->output .= "    // --- Concatenar Strings (+=) ---\n";
                $this->output .= "    adrp x2, concat_buffer\n";
                $this->output .= "    add x2, x2, :lo12:concat_buffer\n";
                
                $this->output .= "{$lblCpy1}:\n";
                $this->output .= "    ldrb w3, [x0], #1           // Leer char actual\n";
                $this->output .= "    cbz w3, {$lblDone1}\n";
                $this->output .= "    strb w3, [x2], #1           // Mantener en buffer\n";
                $this->output .= "    b {$lblCpy1}\n";
                $this->output .= "{$lblDone1}:\n";
                
                $this->output .= "{$lblCpy2}:\n";
                $this->output .= "    ldrb w3, [x1], #1           // Leer char nuevo\n";
                $this->output .= "    cbz w3, {$lblDone2}\n";
                $this->output .= "    strb w3, [x2], #1           // Agregar al buffer\n";
                $this->output .= "    b {$lblCpy2}\n";
                $this->output .= "{$lblDone2}:\n";
                
                $this->output .= "    strb wzr, [x2]              // Nulo final\n";
                $this->output .= "    adrp x0, concat_buffer      // x0 apunta al resultado\n";
                $this->output .= "    add x0, x0, :lo12:concat_buffer\n";
            } else {
                $this->output .= "    // --- Operacion Asignacion ---\n";
                $type = $this->currentEnv->getSymbol($name)['type'];
                
                if ($type === 'string' && $op === '+=') {
                } elseif (str_contains($type, 'float32')) {
                    $this->output .= "    // --- Operacion Asignacion Flotante $op ---\n";
                    $this->output .= "    fmov s0, w0                 // Izquierdo a s0\n";
                    $this->output .= "    fmov s1, w1                 // Derecho a s1\n";
                    if ($op === '+=') $this->output .= "    fadd s0, s0, s1\n";
                    if ($op === '-=') $this->output .= "    fsub s0, s0, s1\n";
                    if ($op === '*=') $this->output .= "    fmul s0, s0, s1\n";
                    if ($op === '/=') $this->output .= "    fdiv s0, s0, s1\n";
                    $this->output .= "    fmov w0, s0                 // Resultado a x0\n";
                } else {
                    $this->output .= "    // --- Operacion Entera $op ---\n";
                    if ($op === '+=') $this->output .= "    add x0, x0, x1\n";
                    if ($op === '-=') $this->output .= "    sub x0, x0, x1\n";
                    if ($op === '*=') $this->output .= "    mul x0, x0, x1\n";
                    if ($op === '/=') $this->output .= "    sdiv x0, x0, x1\n";
                    if ($op === '%=') {
                        $this->output .= "    sdiv x2, x0, x1\n";
                        $this->output .= "    msub x0, x2, x1, x0\n";
                    }
                }
            }

            $this->output .= "    sub x9, x29, #{$offset}     // Calcular direccion segura\n";
            $this->output .= "    str x0, [x9]                // Guardar en $name\n\n";

        } catch (Exception $e) {
            $this->addError("Variable $name no declarada.", $line, 0);
        }
        return null;
    }

    // ──────────────────────────────────────────────
    // LECTURA DE VARIABLES
    // ──────────────────────────────────────────────
    public function visitExprId($ctx): mixed 
    {
        $name = $ctx->getText();
        try {
            $sym = $this->currentEnv->getSymbol($name);
            $offset = $sym['offset'];
            $type = $sym['type'];
            
            if (str_contains($type, '[')) {
                $this->output .= "    sub x9, x29, #{$offset}\n";
                if (str_starts_with($type, '*')) {
                    $this->output .= "    ldr x0, [x9]                // Leer direccion (parametro)\n";
                } else {
                    $this->output .= "    mov x0, x9                  // Devolver direccion base (local)\n";
                }
            } else {
                $this->output .= "    sub x9, x29, #{$offset}     // Calcular direccion\n";
                $this->output .= "    ldr x0, [x9]                // Leer valor a x0\n";
                
                if (str_starts_with($type, '*')) {
                    $lblSkip = $this->nextLabel('L_SKIP_DEREF_');
                    $this->output .= "    cbz x0, {$lblSkip}          // Evitar SegFault si es nil\n";
                    $this->output .= "    ldr x0, [x0]                // Leer el valor apuntado\n";
                    $this->output .= "{$lblSkip}:\n";
                }
            }
            
        } catch (\Exception $e) {
            $this->addError("Variable $name no declarada.");
        }
        return null;
    }

    public function visitLiteral($ctx): mixed
    {
        $text = $ctx->getText();

        if ($ctx->ENTERO()) {
            $this->output .= "    ldr x0, ={$text}            // Cargar entero\n";
        } elseif ($ctx->DECIMAL()) {
            $floatVal = floatval($text);
            $binary = pack('f', $floatVal);
            $intVal = unpack('V', $binary)[1];
            $this->output .= "    ldr x0, ={$intVal}          // Cargar flotante\n";
        } elseif ($ctx->BOOL_LIT()) {
            $val = ($text === 'true') ? 1 : 0;
            $this->output .= "    mov x0, #{$val}             // Cargar bool\n";
        } elseif ($ctx->RUNE_LITERAL()) {
            $char = substr($text, 1, -1);
            $ascii = ord($char);
            $this->output .= "    mov x0, #{$ascii}           // Cargar rune (ASCII)\n";
        } elseif ($ctx->STRING_LITERAL()) {
            $inner = substr($text, 1, -1);
            $inner = str_replace(["\r\n", "\n"], ['\n', '\n'], $inner);
            $lbl = "str_" . ($this->stringCount++);
            $this->dataOutput .= "{$lbl}:\n    .asciz \"{$inner}\"\n";
            $this->output .= "    adrp x0, {$lbl}\n";
            $this->output .= "    add x0, x0, :lo12:{$lbl}    // Puntero de string a x0\n";
        }
        return null;
    }

    public function visitExprLiteral($ctx): mixed { return $this->visitLiteral($ctx->literal()); }
    public function visitExprParenthesis($ctx): mixed { return $this->visit($ctx->expression()); }

    public function visitExprAddSub($ctx): mixed
    {

        $leftText = $ctx->expression(0)->getText();
        $rightText = $ctx->expression(1)->getText();
        
        if ($leftText === 'nil' || $rightText === 'nil') {
            $line = $ctx->start->getLine();
            $this->addError("Operación matemática inválida involucrando 'nil'.", $line, 0);
            return null; // Abortar generación de ensamblador 
        }

        $this->visit($ctx->expression(0)); 
        $this->output .= "    str x0, [sp, #-16]!         // PUSH operando izquierdo\n";
        
        $this->visit($ctx->expression(1)); 
        $this->output .= "    ldr x1, [sp], #16           // POP operando izquierdo a x1\n";
        
        $op = $ctx->getChild(1)->getText();
        $type = $this->getExprType($ctx);

        if (str_contains($type, 'float32')) {
            $this->output .= "    fmov s1, w1                 // Pasar op. izquierdo a FPU\n";
            $this->output .= "    fmov s0, w0                 // Pasar op. derecho a FPU\n";
            if ($op === '+') {
                $this->output .= "    fadd s0, s1, s0             // Suma flotante\n";
            } elseif ($op === '-') {
                $this->output .= "    fsub s0, s1, s0             // Resta flotante\n";
            }
            $this->output .= "    fmov w0, s0                 // Regresar resultado a x0\n";
        } elseif ($type === 'string' && $op === '+') {
            $lblCpy1 = $this->nextLabel('L_CPY1_');
            $lblDone1 = $this->nextLabel('L_CPY1_DONE_');
            $lblCpy2 = $this->nextLabel('L_CPY2_');
            $lblDone2 = $this->nextLabel('L_CPY2_DONE_');
            
            $this->output .= "    // --- Concatenar Strings ---\n";
            $this->output .= "    adrp x2, concat_buffer      // x2 = buffer temporal\n";
            $this->output .= "    add x2, x2, :lo12:concat_buffer\n";
            
            $this->output .= "{$lblCpy1}:\n";
            $this->output .= "    ldrb w3, [x1], #1           // Leer char str1\n";
            $this->output .= "    cbz w3, {$lblDone1}         // Terminar si es nulo\n";
            $this->output .= "    strb w3, [x2], #1           // Guardar y avanzar\n";
            $this->output .= "    b {$lblCpy1}\n";
            $this->output .= "{$lblDone1}:\n";
            
            $this->output .= "{$lblCpy2}:\n";
            $this->output .= "    ldrb w3, [x0], #1           // Leer char str2\n";
            $this->output .= "    cbz w3, {$lblDone2}         // Terminar si es nulo\n";
            $this->output .= "    strb w3, [x2], #1           // Guardar y avanzar\n";
            $this->output .= "    b {$lblCpy2}\n";
            $this->output .= "{$lblDone2}:\n";
            
            $this->output .= "    strb wzr, [x2]              // Caracter nulo final\n";
            $this->output .= "    adrp x0, concat_buffer      // x0 apunta al nuevo string\n";
            $this->output .= "    add x0, x0, :lo12:concat_buffer\n\n";

        } else {
            if ($op === '+') {
                $this->output .= "    add x0, x1, x0              // x0 = x1 + x0\n"; 
            } else {
                $this->output .= "    sub x0, x1, x0              // x0 = x1 - x0\n";
            }
        }
        return null;
    }

    public function visitExprMulDiv($ctx): mixed
    {

        $leftText = $ctx->expression(0)->getText();
        $rightText = $ctx->expression(1)->getText();
        
        if ($leftText === 'nil' || $rightText === 'nil') {
            $line = $ctx->start->getLine();
            $this->addError("Operación matemática inválida involucrando 'nil'.", $line, 0);
            return null; // Abortar generación de ensamblador 
        }

        $this->visit($ctx->expression(0));
        $this->output .= "    str x0, [sp, #-16]!\n";
        $this->visit($ctx->expression(1));
        $this->output .= "    ldr x1, [sp], #16\n";
        
        $op = $ctx->getChild(1)->getText();
        $type = $this->getExprType($ctx);

        if (str_contains($type, 'float32')) {
            $this->output .= "    fmov s1, w1                 // Pasar op. izquierdo a FPU\n";
            $this->output .= "    fmov s0, w0                 // Pasar op. derecho a FPU\n";
            if ($op === '*') {
                $this->output .= "    fmul s0, s1, s0             // Multiplicacion flotante\n";
            } elseif ($op === '/') {
                $this->output .= "    fdiv s0, s1, s0             // Division flotante\n";
            }
            $this->output .= "    fmov w0, s0                 // Regresar resultado a x0\n";
        } else {
            // Operaciones enteras
            if ($op === '*') {
                $this->output .= "    mul x0, x1, x0              // Multiplicar\n";
            } elseif ($op === '/') {
                $this->output .= "    sdiv x0, x1, x0             // Dividir\n";
            } elseif ($op === '%') {
                $this->output .= "    sdiv x2, x1, x0\n";
                $this->output .= "    msub x0, x2, x0, x1         // Modulo\n";
            }
        }
        return null;
    }

    public function visitExprRelational($ctx): mixed
    {
        $this->visit($ctx->expression(0));
        $this->output .= "    str x0, [sp, #-16]!\n";
        $this->visit($ctx->expression(1));
        $this->output .= "    ldr x1, [sp], #16\n";
        
        $type = $this->getExprType($ctx->expression(0));
        $op = $ctx->getChild(1)->getText();
        
        if (str_contains($type, 'float32')) {
            $this->output .= "    fmov s1, w1\n";
            $this->output .= "    fmov s0, w0\n";
            $this->output .= "    fcmp s1, s0                 // Comparar flotantes\n";
        } else {
            $this->output .= "    cmp x1, x0                  // Comparar enteros\n";
        }
        
        $cond = match($op) {
            '<' => 'lt', '<=' => 'le', '>' => 'gt', '>=' => 'ge'
        };
        $this->output .= "    cset x0, {$cond}\n"; 
        return null;
    }

    public function visitExprEquality($ctx): mixed
    {
        $this->visit($ctx->expression(0));
        $this->output .= "    str x0, [sp, #-16]!\n";
        $this->visit($ctx->expression(1));
        $this->output .= "    ldr x1, [sp], #16\n";
        
        $this->output .= "    cmp x1, x0\n";
        $op = $ctx->getChild(1)->getText();
        $cond = ($op === '==') ? 'eq' : 'ne';
        $this->output .= "    cset x0, {$cond}\n";
        return null;
    }

    // ──────────────────────────────────────────────
    // SENTENCIA IF / ELSE IF / ELSE
    // ──────────────────────────────────────────────
    public function visitIfStmt($ctx): mixed
    {
        $lblElse = $this->nextLabel('L_ELSE_');
        $lblEnd  = $this->nextLabel('L_ENDIF_');

        $this->visit($ctx->expression());
        $this->output .= "    cmp x0, #1                  // Evaluar condicion IF\n";
        $this->output .= "    b.ne {$lblElse}             // Si es falso, saltar al ELSE\n";

        $this->visit($ctx->block(0));
        $this->output .= "    b {$lblEnd}                 // Salir del IF\n";

        $this->output .= "{$lblElse}:\n";
        
        if ($ctx->ELSE()) {
            if ($ctx->ifStmt()) {
                $this->visit($ctx->ifStmt());
            } elseif ($ctx->block(1)) {
                $this->visit($ctx->block(1));
            }
        }

        $this->output .= "{$lblEnd}:\n";
        
        return null;
    }

    // ────────────────
    // CICLO FOR 
    // ────────────────
    public function visitForStmt($ctx): mixed
    {
        $lblStart = $this->nextLabel('L_FOR_START_');
        $lblInc   = $this->nextLabel('L_FOR_INC_');   
        $lblEnd   = $this->nextLabel('L_FOR_END_');
        
        array_push($this->loopStartLabels, $lblInc); 
        array_push($this->loopEndLabels, $lblEnd);

        $prevEnv = $this->currentEnv;
        $this->currentEnv = $this->currentEnv->createChild("for_" . $this->labelCount);

        if ($ctx->varDecl() ?? $ctx->shortDecl()) {
            $this->visit($ctx->varDecl() ?? $ctx->shortDecl()); 
        }

        $this->output .= "{$lblStart}:\n";

        if ($ctx->expression()) {
            $this->visit($ctx->expression());
            $this->output .= "    cmp x0, #1\n";
            $this->output .= "    b.ne {$lblEnd}              // Salir si false\n"; 
        }

        $this->visitBlock($ctx->block());

        $this->output .= "{$lblInc}:\n"; 

        if ($ctx->increment()) {
            $this->visit($ctx->increment());
        } elseif ($ctx->assignment()) {
            $this->visit($ctx->assignment());
        }

        $this->output .= "    b {$lblStart}               // Repetir bucle\n";
        $this->output .= "{$lblEnd}:\n";

        $this->currentEnv = $prevEnv; 

        array_pop($this->loopStartLabels);
        array_pop($this->loopEndLabels);
        return null;
    }

    public function visitStmtBreak($ctx): mixed
    {
        if (!empty($this->loopEndLabels)) {
            $endLabel = end($this->loopEndLabels);
            $this->output .= "    b {$endLabel}               // Break\n"; 
        } else {
            $this->addError("Break fuera de ciclo.");
        }
        return null;
    }

    public function visitStmtContinue($ctx): mixed
    {
        if (!empty($this->loopStartLabels)) {
            $startLabel = end($this->loopStartLabels);
            $this->output .= "    b {$startLabel}             // Continue\n";
        }
        return null;
    }

    public function visitIncDec($ctx): mixed
    {
        $name = $ctx->ID()->getText();
        $op   = $ctx->getChild(1)->getText();
        
        try {
            $offset = $this->currentEnv->getSymbol($name)['offset'];
            
            $this->output .= "    sub x9, x29, #{$offset}     // Calcular direccion segura\n";
            
            $this->output .= "    ldr x0, [x9]                // Cargar valor en x0\n";
            
            if ($op === '++') {
                $this->output .= "    add x0, x0, #1\n"; 
            } else {
                $this->output .= "    sub x0, x0, #1\n"; 
            }
            
            $this->output .= "    str x0, [x9]                // Guardar valor modificado\n";
            
        } catch (Exception $e) {}
        return null;
    }

   // ───────────────────────
    // FUNCIONES NATIVAS 
    // ──────────────────────
    public function visitPrintStmt($ctx): mixed
    {
        if ($ctx->valores()) {
            // Extraer todas las expresiones
            $exprs = $ctx->valores()->expression();
            $args = is_array($exprs) ? $exprs : [$exprs];
            $totalArgs = count($args);

            // Iterar sobre cada argumento enviado a fmt.Println
            foreach ($args as $index => $expr) {
                // Detectar y manejar nil especialmente
                $exprText = $expr->getText();
                if ($exprText === 'nil' || $exprText === 'nil==nil') {
                    $this->output .= "    // --- Imprimir nil ---\n";
                    $this->output .= "    mov w2, #60                 // '<'\n";
                    $this->output .= "    sub sp, sp, #16\n";
                    $this->output .= "    strb w2, [sp]\n";
                    $this->output .= "    mov w2, #110                // 'n'\n";
                    $this->output .= "    strb w2, [sp, #1]\n";
                    $this->output .= "    mov w2, #105                // 'i'\n";
                    $this->output .= "    strb w2, [sp, #2]\n";
                    $this->output .= "    mov w2, #108                // 'l'\n";
                    $this->output .= "    strb w2, [sp, #3]\n";
                    $this->output .= "    mov w2, #62                 // '>'\n";
                    $this->output .= "    strb w2, [sp, #4]\n";
                    $this->output .= "    mov x0, #1\n";
                    $this->output .= "    mov x1, sp\n";
                    $this->output .= "    mov x2, #5\n";
                    $this->output .= "    mov x8, #64\n";
                    $this->output .= "    svc #0\n";
                    $this->output .= "    add sp, sp, #16\n\n";
                    
                    if ($index < $totalArgs - 1) {
                        $this->output .= "    // --- Imprimir Espacio Separador ---\n";
                        $this->output .= "    mov w2, #32                 // ASCII del espacio\n";
                        $this->output .= "    sub sp, sp, #16\n";
                        $this->output .= "    strb w2, [sp]\n";
                        $this->output .= "    mov x0, #1\n";
                        $this->output .= "    mov x1, sp\n";
                        $this->output .= "    mov x2, #1\n";
                        $this->output .= "    mov x8, #64\n";
                        $this->output .= "    svc #0\n";
                        $this->output .= "    add sp, sp, #16\n\n";
                    }
                    continue;
                }
                
                $this->visit($expr); 
                $type = $this->getExprType($expr);

                if ($type === 'bool') {
                    $lblFalse = $this->nextLabel('L_BOOL_F_');
                    $lblEnd   = $this->nextLabel('L_BOOL_E_');
                    
                    $this->output .= "    cmp x0, #0\n";
                    $this->output .= "    b.eq {$lblFalse}\n";
                    // Imprimir 'true'
                    $this->output .= "    mov w2, #116\n    strb w2, [sp, #-16]! // 't'\n"; 
                    $this->output .= "    mov w2, #114\n    strb w2, [sp, #1]    // 'r'\n";
                    $this->output .= "    mov w2, #117\n    strb w2, [sp, #2]    // 'u'\n";
                    $this->output .= "    mov w2, #101\n    strb w2, [sp, #3]    // 'e'\n";
                    $this->output .= "    mov x0, #1\n    mov x1, sp\n    mov x2, #4\n    mov x8, #64\n    svc #0\n";
                    $this->output .= "    add sp, sp, #16\n";
                    $this->output .= "    b {$lblEnd}\n";
                    
                    $this->output .= "{$lblFalse}:\n";
                    // Imprimir 'false'
                    $this->output .= "    mov w2, #102\n    strb w2, [sp, #-16]! // 'f'\n"; 
                    $this->output .= "    mov w2, #97\n     strb w2, [sp, #1]    // 'a'\n";
                    $this->output .= "    mov w2, #108\n    strb w2, [sp, #2]    // 'l'\n";
                    $this->output .= "    mov w2, #115\n    strb w2, [sp, #3]    // 's'\n";
                    $this->output .= "    mov w2, #101\n    strb w2, [sp, #4]    // 'e'\n";
                    $this->output .= "    mov x0, #1\n    mov x1, sp\n    mov x2, #5\n    mov x8, #64\n    svc #0\n";
                    $this->output .= "    add sp, sp, #16\n";
                    $this->output .= "{$lblEnd}:\n";

                } elseif ($type === 'string') {
                    $lblLoop = $this->nextLabel('L_STRLEN_');
                    $lblDone = $this->nextLabel('L_STRLEN_DONE_');
                    
                    $this->output .= "    // --- Imprimir String ---\n";
                    $this->output .= "    mov x1, x0                  // Puntero al string\n";
                    $this->output .= "    mov x2, #0                  // Contador de longitud\n";
                    $this->output .= "    cbz x1, {$lblDone}          // Si es null, no imprimir nada\n";
                    $this->output .= "{$lblLoop}:\n";
                    $this->output .= "    ldrb w3, [x1, x2]           // Leer byte actual\n";
                    $this->output .= "    cbz w3, {$lblDone}          // Si es nulo, terminar\n";
                    $this->output .= "    add x2, x2, #1              // length++\n";
                    $this->output .= "    b {$lblLoop}\n";
                    $this->output .= "{$lblDone}:\n";
                    
                    $this->output .= "    mov x0, #1                  // stdout\n";
                    $this->output .= "    mov x8, #64                 // syscall write\n";
                    $this->output .= "    svc #0\n\n";

                } elseif (str_contains($type, 'float32')) {
                    $lblBase = $this->nextLabel('L_FTOA_');
                    $lblFracLoop = $this->nextLabel('L_FRAC_LOOP_');
                    $lblDone = $this->nextLabel('L_FRAC_DONE_');
                    
                    $this->output .= "    // --- Imprimir Float32 (Preciso) ---\n";
                    $this->output .= "    fmov s0, w0                 // Pasar bits crudos a la FPU\n";
                    
                    $this->output .= "    fcvtzs w0, s0               // Convertir a int con signo\n";
                    $this->output .= "    sxtw x0, w0                 // ¡MAGIA! Extender signo a 64 bits para negativos\n";
                    
                    $this->output .= "    sub sp, sp, #32\n";
                    $this->output .= "    mov x1, sp                  // Puntero al inicio del buffer\n";
                    $this->output .= "    add x1, x1, #31             // Apuntar al final (sin salto)\n";
                    
                    // Manejo del signo negativo
                    $this->output .= "    mov x7, #0                  // x7 = flag negativo\n";
                    $this->output .= "    cmp x0, #0\n";
                    $this->output .= "    b.ge {$lblBase}_POS\n";
                    $this->output .= "    neg x0, x0                  // Hacerlo positivo temporalmente\n";
                    $this->output .= "    mov x7, #1                  // Marcar flag negativo\n";
                    $this->output .= "{$lblBase}_POS:\n";

                    $this->output .= "    mov x2, x0                  // Copiar el numero a x2\n";
                    $this->output .= "    mov x3, #10                 // Divisor = 10\n";
                    $this->output .= "    mov x4, #0                  // Contador de digitos\n";

                    $this->output .= "    cbnz x2, {$lblBase}_NOT_ZERO\n";
                    $this->output .= "    mov w5, #48                 // '0'\n";
                    $this->output .= "    strb w5, [x1], #-1          // Guardar y retroceder puntero\n";
                    $this->output .= "    mov x4, #1\n";
                    $this->output .= "    b {$lblBase}_INT_PRINT\n";

                    $this->output .= "{$lblBase}_NOT_ZERO:\n";
                    $this->output .= "{$lblBase}_INT_LOOP:\n";
                    $this->output .= "    cbz x2, {$lblBase}_INT_SIGN // Si es 0, ir a poner el signo\n";
                    $this->output .= "    udiv x5, x2, x3             // x5 = x2 / 10\n";
                    $this->output .= "    msub x6, x5, x3, x2         // x6 = x2 - (x5 * 10)\n";
                    $this->output .= "    add w6, w6, #48             // Convertir a ASCII\n";
                    $this->output .= "    strb w6, [x1], #-1          // Guardar char y retroceder\n";
                    $this->output .= "    mov x2, x5                  // x2 = cociente\n";
                    $this->output .= "    add x4, x4, #1              // contador++\n";
                    $this->output .= "    b {$lblBase}_INT_LOOP\n";

                    $this->output .= "{$lblBase}_INT_SIGN:\n";
                    $this->output .= "    cmp x7, #1                  // ¿Era negativo?\n";
                    $this->output .= "    b.ne {$lblBase}_INT_PRINT\n";
                    $this->output .= "    mov w5, #45                 // ASCII del '-'\n";
                    $this->output .= "    strb w5, [x1], #-1\n";
                    $this->output .= "    add x4, x4, #1\n";

                    $this->output .= "{$lblBase}_INT_PRINT:\n";
                    $this->output .= "    add x1, x1, #1              // Ajustar el puntero\n";
                    $this->output .= "    mov x2, x4                  // Longitud = solo los digitos\n";
                    
                    $this->output .= "    mov x0, #1                  // stdout\n";
                    $this->output .= "    mov x8, #64                 // syscall write\n";
                    $this->output .= "    svc #0\n";
                    
                    $this->output .= "    add sp, sp, #32             // Liberar buffer del stack\n";
                    
                    $this->output .= "    // --- Calcular parte fraccionaria ---\n";
                    $this->output .= "    fcvtzs w0, s0               // Recuperar la parte entera\n";
                    $this->output .= "    scvtf s1, w0                // Convertir entero de vuelta a float\n";
                    $this->output .= "    fsub s2, s0, s1             // Restar para obtener solo la fraccion\n";
                    $this->output .= "    fabs s2, s2                 // Valor absoluto\n";
                    
                    $this->output .= "    ldr w1, =981668463          // Epsilon (Tolerancia)\n";
                    $this->output .= "    fmov s5, w1\n";
                    $this->output .= "    fcmp s2, s5\n";
                    $this->output .= "    b.lt {$lblDone}             // Si es < 0.00001, NO imprimir punto ni decimales\n";
                    
                    $this->output .= "    // --- Imprimir punto decimal ---\n";
                    $this->output .= "    mov w2, #46                 // ASCII del '.' \n";
                    $this->output .= "    strb w2, [sp, #-16]!\n";
                    $this->output .= "    mov x0, #1\n";
                    $this->output .= "    mov x1, sp\n";
                    $this->output .= "    mov x2, #1\n";
                    $this->output .= "    mov x8, #64\n";
                    $this->output .= "    svc #0\n";
                    $this->output .= "    add sp, sp, #16\n";

                    $this->output .= "    // --- Imprimir digitos fraccionarios ---\n";
                    $this->output .= "    mov x4, #5                  // Maximo de iteraciones (5 decimales)\n";
                    $this->output .= "    ldr w1, =1092616192         // Representacion de 10.0 en float32\n";
                    $this->output .= "    fmov s3, w1                 // Multiplicador (10.0)\n";
                    
                    $this->output .= "{$lblFracLoop}:\n";
                    $this->output .= "    cbz x4, {$lblDone}          // Break si llegamos al limite\n";
                    
                    $this->output .= "    fmul s2, s2, s3             // frac = frac * 10.0\n";
                    $this->output .= "    fcvtzs w0, s2               // Extraer el digito a entero (x0)\n";
                    
                    $this->output .= "    // ¡AQUÍ ESTÁ LA MAGIA! Restamos la fracción ANTES de imprimir\n";
                    $this->output .= "    scvtf s4, w0                // Digito a float\n";
                    $this->output .= "    fsub s2, s2, s4             // frac = frac - digito\n";
                    
                    $this->output .= "    // Ahora sí, imprimimos el dígito\n";
                    $this->output .= "    add w2, w0, #48             // Convertir a ASCII\n";
                    $this->output .= "    strb w2, [sp, #-16]!\n";
                    $this->output .= "    mov x0, #1\n";
                    $this->output .= "    mov x1, sp\n";
                    $this->output .= "    mov x2, #1\n";
                    $this->output .= "    mov x8, #64\n";
                    $this->output .= "    svc #0                      // ¡Esto destruye w0! Pero ya no nos importa.\n";
                    $this->output .= "    add sp, sp, #16\n";
                    
                    $this->output .= "    // Revisar si ya terminamos con los decimales reales\n";
                    $this->output .= "    fcmp s2, s5                 // Comparar remanente con Epsilon\n";
                    $this->output .= "    b.lt {$lblDone}             // Si es casi 0, romper el ciclo\n";
                    
                    $this->output .= "    sub x4, x4, #1              // contador--\n";
                    $this->output .= "    b {$lblFracLoop}\n";
                    
                    $this->output .= "{$lblDone}:\n";

                } else {
                    $lblBase = $this->nextLabel('L_ITOA_');

                    $this->output .= "    // --- Imprimir Entero ---\n";
                    $this->output .= "    sub sp, sp, #32\n";
                    $this->output .= "    mov x1, sp                  // Puntero al inicio del buffer\n";
                    $this->output .= "    add x1, x1, #31             // Apuntar al final (sin salto)\n";
                    
                    // Manejo del signo negativo
                    $this->output .= "    mov x7, #0                  // x7 = flag negativo\n";
                    $this->output .= "    cmp x0, #0\n";
                    $this->output .= "    b.ge {$lblBase}_POS\n";
                    $this->output .= "    neg x0, x0                  // Hacerlo positivo temporalmente\n";
                    $this->output .= "    mov x7, #1                  // Marcar flag negativo\n";
                    $this->output .= "{$lblBase}_POS:\n";

                    $this->output .= "    mov x2, x0                  // Copiar el numero a x2\n";
                    $this->output .= "    mov x3, #10                 // Divisor = 10\n";
                    $this->output .= "    mov x4, #0                  // Contador de digitos\n";

                    $this->output .= "    cbnz x2, {$lblBase}_NOT_ZERO\n";
                    $this->output .= "    mov w5, #48                 // '0'\n";
                    $this->output .= "    strb w5, [x1], #-1          // Guardar y retroceder puntero\n";
                    $this->output .= "    mov x4, #1\n";
                    $this->output .= "    b {$lblBase}_PRINT\n";

                    $this->output .= "{$lblBase}_NOT_ZERO:\n";
                    $this->output .= "{$lblBase}_LOOP:\n";
                    $this->output .= "    cbz x2, {$lblBase}_SIGN     // Si es 0, ir a poner el signo\n";
                    $this->output .= "    udiv x5, x2, x3             // x5 = x2 / 10\n";
                    $this->output .= "    msub x6, x5, x3, x2         // x6 = x2 - (x5 * 10)\n";
                    $this->output .= "    add w6, w6, #48             // Convertir a ASCII\n";
                    $this->output .= "    strb w6, [x1], #-1          // Guardar char y retroceder\n";
                    $this->output .= "    mov x2, x5                  // x2 = cociente\n";
                    $this->output .= "    add x4, x4, #1              // contador++\n";
                    $this->output .= "    b {$lblBase}_LOOP\n";

                    $this->output .= "{$lblBase}_SIGN:\n";
                    $this->output .= "    cmp x7, #1                  // ¿Era negativo?\n";
                    $this->output .= "    b.ne {$lblBase}_PRINT\n";
                    $this->output .= "    mov w5, #45                 // ASCII del '-'\n";
                    $this->output .= "    strb w5, [x1], #-1\n";
                    $this->output .= "    add x4, x4, #1\n";

                    $this->output .= "{$lblBase}_PRINT:\n";
                    $this->output .= "    add x1, x1, #1              // Ajustar el puntero\n";
                    $this->output .= "    mov x2, x4                  // Longitud = solo los digitos\n";
                    
                    $this->output .= "    mov x0, #1                  // stdout\n";
                    $this->output .= "    mov x8, #64                 // syscall write\n";
                    $this->output .= "    svc #0\n";
                    
                    $this->output .= "    add sp, sp, #32             // Liberar buffer del stack\n\n";
                }

                if ($index < $totalArgs - 1) {
                    $this->output .= "    // --- Imprimir Espacio Separador ---\n";
                    $this->output .= "    mov w2, #32                 // ASCII del espacio\n";
                    $this->output .= "    sub sp, sp, #16\n";
                    $this->output .= "    strb w2, [sp]\n";
                    $this->output .= "    mov x0, #1\n";
                    $this->output .= "    mov x1, sp\n";
                    $this->output .= "    mov x2, #1\n";
                    $this->output .= "    mov x8, #64\n";
                    $this->output .= "    svc #0\n";
                    $this->output .= "    add sp, sp, #16\n\n";
                }
            }
        }
        
        //Al finalizar de imprimir todo
        $this->output .= "    // --- Salto de linea final ---\n";
        $this->output .= "    adrp x1, newline\n";
        $this->output .= "    add x1, x1, :lo12:newline\n";
        $this->output .= "    mov x2, #1\n";
        $this->output .= "    mov x0, #1\n";
        $this->output .= "    mov x8, #64\n";
        $this->output .= "    svc #0\n\n";

        return null;
    }

    public function visitReturnStmt($ctx): mixed
    {
        if ($ctx->valores()) {
            $exprs = $ctx->valores()->expression();
            foreach ($exprs as $expr) {
                $this->visit($expr);
                $type = $this->getExprType($expr);
                
                // Si estamos retornando un arreglo, copiarlo al buffer seguro
                if (str_contains($type, '[')) {
                    $lblCpy = $this->nextLabel('L_RET_CPY_');
                    $lblDone = $this->nextLabel('L_RET_DONE_');
                    preg_match_all('/\[(\d+)\]/', $type, $matches);
                    $totElems = 1;
                    foreach ($matches[1] as $d) $totElems *= (int)$d;
                    
                    $this->output .= "    // --- Copiar arreglo a zona segura ---\n";
                    $this->output .= "    mov x1, x0                  // Origen (local)\n";
                    $this->output .= "    adrp x2, concat_buffer      // Usar tu buffer global como rescate\n";
                    $this->output .= "    add x2, x2, :lo12:concat_buffer\n";
                    $this->output .= "    ldr x3, ={$totElems}\n";
                    
                    $this->output .= "{$lblCpy}:\n";
                    $this->output .= "    cbz x3, {$lblDone}\n";
                    $this->output .= "    ldr x4, [x1], #8\n";
                    $this->output .= "    str x4, [x2], #8\n";
                    $this->output .= "    sub x3, x3, #1\n";
                    $this->output .= "    b {$lblCpy}\n";
                    $this->output .= "{$lblDone}:\n";
                    
                    // Devolver el puntero de la zona segura
                    $this->output .= "    adrp x0, concat_buffer\n";
                    $this->output .= "    add x0, x0, :lo12:concat_buffer\n";
                }
                
                $this->output .= "    str x0, [sp, #-16]!         // PUSH valor de retorno\n";
            }
            
            $count = count($exprs);
            for ($i = $count - 1; $i >= 0; $i--) {
                $this->output .= "    ldr x{$i}, [sp], #16        // POP a x{$i}\n";
            }
        }
        
        $this->output .= "    mov sp, x29\n";
        $this->output .= "    ldp x29, x30, [sp], #16\n";
        $this->output .= "    ret\n\n";
        return null;
    }

    // ──────────────────────────────────────────────
    // LLAMADAS A FUNCIONES
    // ──────────────────────────────────────────────
    public function visitExprCall($ctx): mixed 
    {
        $funcName = $ctx->expression()->getText();
        
        if ($ctx->valores()) {
            $exprs = $ctx->valores()->expression();
            $args = is_array($exprs) ? $exprs : [$exprs];
            $argCount = count($args);
            
            foreach ($args as $argCtx) {
                $this->visit($argCtx); // El resultado queda en x0
                $this->output .= "    str x0, [sp, #-16]!         // PUSH arg temporal\n";
            }
            
            for ($i = $argCount - 1; $i >= 0; $i--) {
                $this->output .= "    ldr x{$i}, [sp], #16        // POP arg a x{$i}\n";
            }
        }
        
        $this->output .= "    bl {$funcName}              // LLAMAR A {$funcName}\n\n";
        return null;
    }

    // ──────────────────────────────────────────────
    // PUNTEROS 
    // ──────────────────────────────────────────────
    
    public function visitExprAddr($ctx): mixed 
    {
        $name = $ctx->ID()->getText();
        try {
            $offset = $this->currentEnv->getSymbol($name)['offset'];
            $this->output .= "    sub x0, x29, #{$offset}     // x0 = &{$name}\n";
        } catch (Exception $e) {
            $this->addError("Variable $name no declarada.");
        }
        return null;
    }

    // Leer el valor apuntado por un puntero 
    public function visitExprDeref($ctx): mixed 
    {
        $this->visit($ctx->expression());
        
        $this->output .= "    ldr x0, [x0]                // Leer valor apuntado (*deref)\n";
        return null;
    }

    public function visitStmtPtrAssign($ctx): mixed 
    {
        $name = $ctx->ID()->getText(); 
        $line = $ctx->ID()->getSymbol()->getLine();
        
        $this->visit($ctx->expression());
        $this->output .= "    str x0, [sp, #-16]!         // PUSH valor a asignar\n";
        
        try {
            $offset = $this->currentEnv->getSymbol($name)['offset'];
            $this->output .= "    ldr x1, [x29, #-{$offset}]  // x1 = direccion guardada en {$name}\n";
            
            $this->output .= "    ldr x0, [sp], #16           // POP valor\n";
            $this->output .= "    str x0, [x1]                // *{$name} = valor\n\n";
            
        } catch (Exception $e) {
            $this->addError("Puntero $name no declarado.", $line, 0);
        }
        return null;
    }

    // ──────────────────────────────────────────────
    // FUNCIONES NATIVAS (Built-ins)
    // ──────────────────────────────────────────────
    public function visitExprBuiltIn($ctx): mixed
    {
        $funcName = $ctx->getChild(0)->getText(); 
        
        if ($funcName === 'len') {
            $expr = $ctx->valores()->expression(0);
            $exprText = $expr->getText();
            $type = '';
            
            try {
                $sym = $this->currentEnv->getSymbol($exprText);
                $type = $sym['type'];
            } catch (\Exception $e) {
                $type = $this->getExprType($expr);
            }
            
            // Si es un arreglo 
            if (str_contains($type, '[')) {
                preg_match('/\[(\d+)\]/', $type, $matches);
                $len = isset($matches[1]) ? $matches[1] : 0;
                $this->output .= "    ldr x0, ={$len}             // len(arreglo)\n";
            } else {
                // Longitud de string en memoria
                $this->visit($expr); 
                $lblLoop = $this->nextLabel('L_LEN_LOOP_');
                $lblDone = $this->nextLabel('L_LEN_DONE_');
                
                $this->output .= "    // --- Built-in: len(string) ---\n";
                $this->output .= "    mov x1, x0\n";
                $this->output .= "    mov x0, #0\n";
                $this->output .= "{$lblLoop}:\n";
                $this->output .= "    ldrb w2, [x1, x0]\n";
                $this->output .= "    cbz w2, {$lblDone}\n";
                $this->output .= "    add x0, x0, #1\n";
                $this->output .= "    b {$lblLoop}\n";
                $this->output .= "{$lblDone}:\n\n"; 
            }
            
        } elseif ($funcName === 'now') {
            $this->output .= "    // --- Built-in: now() ---\n";
            $timeStr = date('Y-m-d H:i:s'); 
            $lbl = "str_" . ($this->stringCount++);
            $this->dataOutput .= "{$lbl}:\n    .asciz \"{$timeStr}\"\n";
            $this->output .= "    adrp x0, {$lbl}\n";
            $this->output .= "    add x0, x0, :lo12:{$lbl}\n";
            
        } elseif ($funcName === 'typeOf') {
            $this->output .= "    // --- Built-in: typeOf() ---\n";
            $expr = $ctx->valores()->expression(0);
            $type = $this->getExprType($expr); // Inferencia de PHP
            
            $lbl = "str_" . ($this->stringCount++);
            $this->dataOutput .= "{$lbl}:\n    .asciz \"{$type}\"\n";
            $this->output .= "    adrp x0, {$lbl}\n";
            $this->output .= "    add x0, x0, :lo12:{$lbl}\n";
            
        } elseif ($funcName === 'substr') {
            $this->visit($ctx->valores()->expression(0)); 
            $this->output .= "    str x0, [sp, #-16]!\n";
            $this->visit($ctx->valores()->expression(1)); 
            $this->output .= "    str x0, [sp, #-16]!\n";
            $this->visit($ctx->valores()->expression(2)); 
            
            $this->output .= "    mov x2, x0                  // length a x2\n";
            $this->output .= "    ldr x1, [sp], #16           // start a x1\n";
            $this->output .= "    ldr x0, [sp], #16           // string a x0\n";
            
            $lblCpy = $this->nextLabel('L_SUB_CPY_');
            $lblDone = $this->nextLabel('L_SUB_DONE_');
            
            $this->output .= "    // --- Built-in: substr() ---\n";
            $this->output .= "    adrp x3, concat_buffer\n";
            $this->output .= "    add x3, x3, :lo12:concat_buffer\n";
            $this->output .= "    add x0, x0, x1\n";
            $this->output .= "    mov x4, #0\n";
            
            $this->output .= "{$lblCpy}:\n";
            $this->output .= "    cmp x4, x2\n";
            $this->output .= "    b.ge {$lblDone}\n";
            $this->output .= "    ldrb w5, [x0], #1\n";
            $this->output .= "    cbz w5, {$lblDone}\n";
            $this->output .= "    strb w5, [x3], #1\n";
            $this->output .= "    add x4, x4, #1\n";
            $this->output .= "    b {$lblCpy}\n";
            $this->output .= "{$lblDone}:\n";
            $this->output .= "    strb wzr, [x3]\n";
            $this->output .= "    adrp x0, concat_buffer\n";
            $this->output .= "    add x0, x0, :lo12:concat_buffer\n\n";
        }
        return null;
    }

    // ──────────────────────────────────────────────
    // OPERADORES LÓGICOS 
    // ──────────────────────────────────────────────
    public function visitExprAnd($ctx): mixed
    {
        $lblFalse = $this->nextLabel('L_AND_FALSE_');
        $lblEnd   = $this->nextLabel('L_AND_END_');

        $this->visit($ctx->expression(0)); // Evaluar lado izquierdo
        $this->output .= "    cmp x0, #0\n";
        $this->output .= "    b.eq {$lblFalse}            // ¡Cortocircuito! Si es false, saltar\n";

        $this->visit($ctx->expression(1)); // Evaluar lado derecho
        $this->output .= "    cmp x0, #0\n";
        $this->output .= "    b.eq {$lblFalse}\n";

        $this->output .= "    mov x0, #1                  // Todo fue true\n";
        $this->output .= "    b {$lblEnd}\n";

        $this->output .= "{$lblFalse}:\n";
        $this->output .= "    mov x0, #0\n";
        $this->output .= "{$lblEnd}:\n";
        
        return null;
    }

    public function visitExprOr($ctx): mixed
    {
        $lblTrue = $this->nextLabel('L_OR_TRUE_');
        $lblEnd  = $this->nextLabel('L_OR_END_');

        $this->visit($ctx->expression(0)); // Evaluar lado izquierdo
        $this->output .= "    cmp x0, #1\n";
        $this->output .= "    b.eq {$lblTrue}             // ¡Cortocircuito! Si es true, saltar\n";

        $this->visit($ctx->expression(1)); // Evaluar lado derecho
        $this->output .= "    cmp x0, #1\n";
        $this->output .= "    b.eq {$lblTrue}\n";

        $this->output .= "    mov x0, #0                  // Todo fue false\n";
        $this->output .= "    b {$lblEnd}\n";

        $this->output .= "{$lblTrue}:\n";
        $this->output .= "    mov x0, #1\n";
        $this->output .= "{$lblEnd}:\n";
        
        return null;
    }

    public function visitExprTernary($ctx): mixed
    {
        $lblFalse = $this->nextLabel('L_TERN_F_');
        $lblEnd   = $this->nextLabel('L_TERN_E_');

        $this->output .= "    // --- Inicio Operador Ternario ---\n";
        
        $this->visit($ctx->expression(0)); 
        $this->output .= "    cmp x0, #0                  // ¿La condicion es false/0?\n";
        $this->output .= "    b.eq {$lblFalse}            // Si es falso, saltar a evaluar la opcion 2\n";

        $this->output .= "    // --- Lado True ---\n";
        $this->visit($ctx->expression(1)); 
        $this->output .= "    b {$lblEnd}                 // Cortocircuito: saltar al final\n";

        $this->output .= "{$lblFalse}:\n";
        $this->output .= "    // --- Lado False ---\n";
        $this->visit($ctx->expression(2)); 

        $this->output .= "{$lblEnd}:\n";
        $this->output .= "    // --- Fin Operador Ternario ---\n";
        
        return null;
    }

    // ──────────────────────────────────────────────
    // OPERADORES UNARIOS (! y -)
    // ──────────────────────────────────────────────
    public function visitExprNot($ctx): mixed
    {
        $this->visit($ctx->expression()); 
        $this->output .= "    cmp x0, #0                  // Operador NOT (!)\n";
        $this->output .= "    cset x0, eq                 // Si era 0 (false), ahora es 1. Si era 1, ahora es 0.\n";
        return null;
    }

    public function visitExprNegate($ctx): mixed
    {
        $this->visit($ctx->expression());
        $this->output .= "    neg x0, x0                  // Operador Unario Minus (-)\n";
        return null;
    }

    // ──────────────────────────────────────────────
    // SWITCH - CASE
    // ──────────────────────────────────────────────
    public function visitSwitchStmt($ctx): mixed
    {
        $lblEnd = $this->nextLabel('L_SWITCH_END_');
        
        $this->visit($ctx->expression());
        $this->output .= "    str x0, [sp, #-16]!         // PUSH valor del switch\n";
        
        $switchBlock = $ctx->switchBlock();
        $cases = $switchBlock->caseStmt();
        $nextCaseLbl = $this->nextLabel('L_CASE_');
        
        foreach ($cases as $case) {
            $this->output .= "{$nextCaseLbl}:\n";
            $nextCaseLbl = $this->nextLabel('L_CASE_'); 
            
            $exprs = $case->valores()->expression();
            $exprs = is_array($exprs) ? $exprs : [$exprs];
            $lblMatch = $this->nextLabel('L_CASE_MATCH_');
            
            $this->output .= "    // --- Evaluar Case ---\n";
            foreach ($exprs as $expr) {
                $this->visit($expr); 
                $this->output .= "    ldr x1, [sp]                // PEEK valor del switch a x1\n";
                $this->output .= "    cmp x1, x0\n";
                $this->output .= "    b.eq {$lblMatch}\n";
            }
            $this->output .= "    b {$nextCaseLbl}            // Fallo, ir al siguiente caso\n";
            
            $this->output .= "{$lblMatch}:\n";
            foreach ($case->statement() as $stmt) {
                $this->visit($stmt);
            }
            $this->output .= "    b {$lblEnd}                 // Break automático\n\n";
        }
        
        $this->output .= "{$nextCaseLbl}:\n"; 
        if ($switchBlock->defaultStmt()) {
            foreach ($switchBlock->defaultStmt()->statement() as $stmt) {
                $this->visit($stmt);
            }
        }
        
        $this->output .= "{$lblEnd}:\n";
        $this->output .= "    add sp, sp, #16             // POP valor del switch\n\n";
        return null;
    }

    public function visitExprPipe($ctx): mixed 
    { 
        $this->output .= "    // --- Inicio Operador Pipe (|>) ---\n";
        $this->visit($ctx->expression(0)); 
        $this->visit($ctx->expression(1));
        return null;
    }

    public function visitCaseStmt($ctx): mixed { return null; }
    public function visitDefaultStmt($ctx): mixed { return null; }
    public function visitSwitchBlock($ctx): mixed { return null; }
}