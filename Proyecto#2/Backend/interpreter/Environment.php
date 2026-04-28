<?php

class Environment
{
    /** @var Environment|null */
    private ?Environment $parent;

    /** @var string Nombre del scope (global, main, func_xxx, if, for, ...) */
    private string $scopeName;

    /** @var array<string, array> Mapa de identificador → [type, offset, isGlobal, line, col] */
    private array $symbols = [];

    /** @var array Registro global de todos los símbolos (para el reporte final) */
    private static array $allSymbols = [];

    /** @var int Control del tamaño de la pila (Stack) en este entorno */
    private int $currentOffset;

    public function __construct(string $scopeName = 'global', ?Environment $parent = null)
    {
        $this->scopeName = $scopeName;
        $this->parent    = $parent;
        
        // Las funciones reinician el offset de la pila local. Los bloques if/for lo heredan.
        if ($parent !== null && !str_starts_with($scopeName, 'func_')) {
            $this->currentOffset = $parent->getCurrentOffset();
        } else {
            $this->currentOffset = 0;
        }
    }

    // ──────────────────────────────────────────────
    // Declarar una variable
    // ──────────────────────────────────────────────
    public function declare(string $id, string $type, int $sizeInBytes, int $line, int $col, mixed $visualValue = '—'): void
    {
        // Validaciones
        if (isset($this->symbols[$id])) {
            throw new GolampiCompilerError("La variable '$id' ya está declarada en este ámbito.");
        }

        // Cálculo del offset de memoria 
        $this->currentOffset += $sizeInBytes;

        // Guardar el símbolo 
        $symbol = [
            'id'       => $id,
            'type'     => $type,
            'offset'   => $this->currentOffset,
            'value'    => $visualValue,     
            'line'     => $line,
            'column'   => $col,
            'scope'    => $this->scopeName,
            'isGlobal' => $this->scopeName === 'global'
        ];

        $this->symbols[$id] = $symbol;
        self::$allSymbols[] = $symbol; 
    }

    // ──────────────────────────────────────────────
    // Obtener un Símbolo 
    // ──────────────────────────────────────────────
    public function getSymbol(string $id, int $line = 0, int $col = 0): array
    {
        if (array_key_exists($id, $this->symbols)) {
            return $this->symbols[$id];
        }
        if ($this->parent !== null) {
            return $this->parent->getSymbol($id, $line, $col);
        }
        throw new GolampiCompilerError("Variable '$id' no declarada en el ámbito actual.");
    }

    // ──────────────────────────────────────────────
    // Utilidades para la generación de código
    // ──────────────────────────────────────────────
    public function getCurrentOffset(): int
    {
        return $this->currentOffset;
    }

    public function existsLocal(string $id): bool
    {
        return array_key_exists($id, $this->symbols);
    }

    public function createChild(string $scopeName): Environment
    {
        return new Environment($scopeName, $this);
    }

    public static function getAllSymbols(): array
    {
        return self::$allSymbols;
    }

    public static function resetSymbols(): void
    {
        self::$allSymbols = [];
    }
}