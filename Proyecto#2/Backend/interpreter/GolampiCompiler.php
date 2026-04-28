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
        
        if (is_array($exprCtx)) {
            $exprCtx = $exprCtx[0];
        }
        
        $text = $exprCtx->getText();
        
        if (str_starts_with($text, 'len(')) return 'int32';
        if (str_starts_with($text, 'substr(')) return 'string';
        if (str_starts_with($text, 'now(')) return 'string';
        if (str_starts_with($text, 'typeOf(')) return 'string';
        
        if (str_contains($text, '"')) return 'string';
        if (str_contains($text, '.')) return 'float32';
        
        preg_match_all('/[a-zA-Z_][a-zA-Z_0-9]*/', $text, $matches);
        if (!empty($matches[0])) {
            foreach ($matches[0] as $word) {
                // Evitar palabras clave de tipos
                if (in_array($word, ['int32', 'float32', 'string', 'bool', 'rune'])) continue;
                
                try {
                    $sym = $this->currentEnv->getSymbol($word);
                    if (str_contains($sym['type'], 'float32')) return 'float32';
                    if (str_contains($sym['type'], 'string')) return 'string';
                } catch (\Exception $e) {
                }
            }
        }
        
        return 'int32'; // Por defecto
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
        $this->output .= "    sub sp, sp, #256            // Reservar memoria estatica para variables\n\n"; 

        $params = $funcDecl->paramList() ? $funcDecl->paramList()->parametro() : [];
        foreach ($params as $i => $param) {
            $pName = $param->ID()->getText();
            $pType = $param->type()->getText();
            $this->currentEnv->declare($pName, $pType, 8, $line, $col); 
            
            $offset = $this->currentEnv->getSymbol($pName)['offset'];
            if ($i < 8) {
                $this->output .= "    str x{$i}, [x29, #-{$offset}]  // Guardar param $pName\n";
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

    public function visitBlock($ctx): mixed
    {
        foreach ($ctx->statement() as $stmt) {
            $this->visit($stmt);
        }
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

        preg_match_all('/\[(\d+)\]/', $type, $matches);
        $dims = $matches[1];

        if (count($indices) === 1) {
            $this->visit($indices[0]); 
        } elseif (count($indices) === 2) {
            $cols = $dims[1];
            $this->visit($indices[0]); 
            $this->output .= "    mov x1, #{$cols}\n";
            $this->output .= "    mul x0, x0, x1\n";
            $this->output .= "    str x0, [sp, #-16]!\n";
            $this->visit($indices[1]); 
            $this->output .= "    ldr x1, [sp], #16\n";
            $this->output .= "    add x0, x1, x0\n";
        }

        $this->output .= "    mov x1, #8\n";
        $this->output .= "    mul x0, x0, x1              // x0 = byte offset\n";

        if (str_starts_with($type, '*')) {
            $this->output .= "    ldr x1, [x29, #-{$baseOffset}] // Base = direccion apuntada\n";
        } else {
            $this->output .= "    sub x1, x29, #{$baseOffset}    // Base = memoria local\n"; 
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
        preg_match_all('/\[(\d+)\]/', $type, $matches);
        $dims = $matches[1];

        if (count($indices) === 1) {
            $this->visit($indices[0]); 
        } elseif (count($indices) === 2) {
            $cols = $dims[1];
            $this->visit($indices[0]); 
            $this->output .= "    mov x1, #{$cols}\n";
            $this->output .= "    mul x0, x0, x1\n";
            $this->output .= "    str x0, [sp, #-16]!\n";
            $this->visit($indices[1]); 
            $this->output .= "    ldr x1, [sp], #16\n";
            $this->output .= "    add x0, x1, x0\n";
        }

        $this->output .= "    mov x1, #8\n";
        $this->output .= "    mul x0, x0, x1              // x0 = byte offset\n";

        // Soporte para arreglos normales y pasados por puntero
        if (str_starts_with($type, '*')) {
            $this->output .= "    ldr x1, [x29, #-{$baseOffset}]\n";
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
                            $this->output .= "    str x0, [x29, #-{$elemOffset}]  // Init array $name elem {$idx}\n";
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
                    $this->output .= "    str x0, [x29, #-{$offset}]  // Almacenar en $name\n\n";
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
            $this->output .= "    str x0, [x29, #-{$offset}]  // Declarar constante $name\n\n";

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
            foreach ($exprs as $expr) {
                $this->visit($expr);
                $this->output .= "    str x0, [sp, #-16]!         // PUSH temp\n";
            }
            for ($i = count($exprs) - 1; $i >= 0; $i--) {
                $this->output .= "    ldr x{$i}, [sp], #16        // POP a x{$i}\n";
            }
        }

        foreach ($ids as $i => $idNode) {
            $name = $idNode->getText();
            $line = $idNode->getSymbol()->getLine();
            $col  = $idNode->getSymbol()->getCharPositionInLine();
            
            try {
                $type = (str_contains($name, 'exito') || str_contains($name, 'flag')) ? 'bool' : 'int32'; 
                $this->currentEnv->declare($name, $type, 8, $line, $col, '...');
                $offset = $this->currentEnv->getSymbol($name)['offset'];
                
                $this->output .= "    str x{$i}, [x29, #-{$offset}]  // Asignar x{$i} a $name\n";
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
            $this->output .= "    str x0, [x29, #-{$offset}]  // Asignar a $name\n";
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
            
            $this->output .= "    ldr x0, [x29, #-{$offset}]  // Leer $name actual\n";
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
                $this->output .= "    // --- Operacion $op ---\n";
                if ($op === '+=') $this->output .= "    add x0, x0, x1\n";
                if ($op === '-=') $this->output .= "    sub x0, x0, x1\n";
                if ($op === '*=') $this->output .= "    mul x0, x0, x1\n";
                if ($op === '/=') $this->output .= "    sdiv x0, x0, x1\n";
                if ($op === '%=') {
                    $this->output .= "    sdiv x2, x0, x1\n";
                    $this->output .= "    msub x0, x2, x1, x0\n";
                }
            }

            $this->output .= "    str x0, [x29, #-{$offset}]  // Guardar en $name\n\n";

        } catch (Exception $e) {
            $this->addError("Variable $name no declarada.", $line, 0);
        }
        return null;
    }

    public function visitExprId($ctx): mixed
    {
        $name = $ctx->ID()->getText();
        try {
            $offset = $this->currentEnv->getSymbol($name)['offset'];
            $this->output .= "    ldr x0, [x29, #-{$offset}]  // Leer $name\n"; 
        } catch (Exception $e) {
            $this->addError("Variable $name no declarada.");
        }
        return null;
    }

    public function visitLiteral($ctx): mixed
    {
        $text = $ctx->getText();

        if ($ctx->ENTERO()) {
            $this->output .= "    ldr x0, ={$text}            // Cargar entero\n";
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
            return null; // Abortar generación de ensamblador para esta suma
        }

        $this->visit($ctx->expression(0)); 
        $this->output .= "    str x0, [sp, #-16]!         // PUSH operando izquierdo\n";
        
        $this->visit($ctx->expression(1)); 
        $this->output .= "    ldr x1, [sp], #16           // POP operando izquierdo a x1\n";
        
        $op = $ctx->getChild(1)->getText();
        $type = $this->getExprType($ctx);

        if ($type === 'string' && $op === '+') {
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
        if ($op === '*') {
            $this->output .= "    mul x0, x1, x0              // Multiplicar\n"; 
        } elseif ($op === '/') {
            $this->output .= "    sdiv x0, x1, x0             // Dividir\n"; 
        } elseif ($op === '%') {
            $this->output .= "    sdiv x2, x1, x0\n"; 
            $this->output .= "    msub x0, x2, x0, x1         // Modulo\n"; 
        }
        return null;
    }

    public function visitExprRelational($ctx): mixed
    {
        $this->visit($ctx->expression(0));
        $this->output .= "    str x0, [sp, #-16]!\n";
        $this->visit($ctx->expression(1));
        $this->output .= "    ldr x1, [sp], #16\n";
        
        $this->output .= "    cmp x1, x0                  // Comparar x1 y x0\n";
        
        $op = $ctx->getChild(1)->getText();
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

    public function visitIfStmt($ctx): mixed
    {
        $lblElse = $this->nextLabel('L_ELSE_');
        $lblEnd  = $this->nextLabel('L_ENDIF_');

        $this->visit($ctx->expression()); 
        $this->output .= "    cmp x0, #1                  // Verificar if (true)\n";
        $this->output .= "    b.ne {$lblElse}             // Si es falso, ir a else\n"; 
        
        $this->visitBlock($ctx->block(0)); 
        $this->output .= "    b {$lblEnd}                 // Terminar if\n";
        
        $this->output .= "{$lblElse}:\n";
        if ($ctx->ifStmt()) {
            $this->visitIfStmt($ctx->ifStmt()); 
        } elseif ($ctx->block(1)) {
            $this->visitBlock($ctx->block(1));  
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
            $this->output .= "    ldr x0, [x29, #-{$offset}]\n";
            if ($op === '++') {
                $this->output .= "    add x0, x0, #1\n"; 
            } else {
                $this->output .= "    sub x0, x0, #1\n"; 
            }
            $this->output .= "    str x0, [x29, #-{$offset}]\n";
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
                $this->visit($expr); 
                $type = $this->getExprType($expr);

                if ($type === 'string') {
                    $lblLoop = $this->nextLabel('L_STRLEN_');
                    $lblDone = $this->nextLabel('L_STRLEN_DONE_');
                    
                    $this->output .= "    // --- Imprimir String ---\n";
                    $this->output .= "    mov x1, x0                  // Puntero al string\n";
                    $this->output .= "    mov x2, #0                  // Contador de longitud\n";
                    $this->output .= "{$lblLoop}:\n";
                    $this->output .= "    ldrb w3, [x1, x2]           // Leer byte actual\n";
                    $this->output .= "    cbz w3, {$lblDone}          // Si es nulo, terminar\n";
                    $this->output .= "    add x2, x2, #1              // length++\n";
                    $this->output .= "    b {$lblLoop}\n";
                    $this->output .= "{$lblDone}:\n";
                    
                    $this->output .= "    mov x0, #1                  // stdout\n";
                    $this->output .= "    mov x8, #64                 // syscall write\n";
                    $this->output .= "    svc #0\n\n";

                } else {
                    $lblConvLoop = $this->nextLabel('L_ITOA_LOOP_');
                    $lblPrint    = $this->nextLabel('L_ITOA_PRINT_');

                    $this->output .= "    // --- Imprimir Entero ---\n";
                    $this->output .= "    sub sp, sp, #32\n";
                    $this->output .= "    mov x1, sp                  // Puntero al inicio del buffer\n";
                    $this->output .= "    add x1, x1, #31             // Apuntar al final (sin salto)\n";
                    
                    $this->output .= "    mov x2, x0                  // Copiar el numero a x2\n";
                    $this->output .= "    mov x3, #10                 // Divisor = 10\n";
                    $this->output .= "    mov x4, #0                  // Contador de digitos\n";

                    $lblNotZero = $this->nextLabel('L_NOT_ZERO_');
                    $this->output .= "    cbnz x2, {$lblNotZero}\n";
                    $this->output .= "    mov w5, #48                 // '0'\n";
                    $this->output .= "    strb w5, [x1], #-1          // Guardar y retroceder puntero\n";
                    $this->output .= "    mov x4, #1\n";
                    $this->output .= "    b {$lblPrint}\n";

                    $this->output .= "{$lblNotZero}:\n";
                    $this->output .= "{$lblConvLoop}:\n";
                    $this->output .= "    cbz x2, {$lblPrint}         // Terminar si el cociente es 0\n";
                    $this->output .= "    udiv x5, x2, x3             // x5 = x2 / 10\n";
                    $this->output .= "    msub x6, x5, x3, x2         // x6 = x2 - (x5 * 10)\n";
                    $this->output .= "    add w6, w6, #48             // Convertir a ASCII\n";
                    $this->output .= "    strb w6, [x1], #-1          // Guardar char y retroceder\n";
                    $this->output .= "    mov x2, x5                  // x2 = cociente\n";
                    $this->output .= "    add x4, x4, #1              // contador++\n";
                    $this->output .= "    b {$lblConvLoop}\n";

                    $this->output .= "{$lblPrint}:\n";
                    $this->output .= "    add x1, x1, #1              // Ajustar el puntero\n";
                    $this->output .= "    mov x2, x4                  // Longitud = solo los digitos\n";
                    
                    $this->output .= "    mov x0, #1                  // stdout\n";
                    $this->output .= "    mov x8, #64                 // syscall write\n";
                    $this->output .= "    svc #0\n";
                    
                    $this->output .= "    add sp, sp, #32             // Liberar buffer del stack\n\n";
                }

                // Imprimir espacio en blanco si no es el último argumento
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
        
        //Al finalizar de imprimir todo, siempre agregamos un salto de línea 
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

    // Leer el valor apuntado por un puntero (*precio)
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
    // FUNCIONES BUILT-IN 
    // ──────────────────────────────────────────────
    public function visitExprBuiltIn($ctx): mixed
    {
        $funcName = $ctx->getChild(0)->getText(); 
        
        if ($funcName === 'len') {
            $expr = $ctx->valores()->expression(0);
            $type = $this->getExprType($expr);
            
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

    public function visitCaseStmt($ctx): mixed { return null; }
    public function visitDefaultStmt($ctx): mixed { return null; }
    public function visitSwitchBlock($ctx): mixed { return null; }
}