<?php

use Antlr\Antlr4\Runtime\Error\Listeners\BaseErrorListener;
use Antlr\Antlr4\Runtime\Recognizer;
use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;

// ──────────────────────────────────────────────
// Excepción de errores semánticos del Compilador
// ──────────────────────────────────────────────
class GolampiCompilerError extends RuntimeException
{
    private int $errorLine;
    private int $errorColumn;

    public function __construct(string $message, int $line = 0, int $column = 0)
    {
        parent::__construct($message);
        $this->errorLine   = $line;
        $this->errorColumn = $column;
    }

    public function getErrorLine(): int { return $this->errorLine; }
    public function getColumn(): int    { return $this->errorColumn; }
}

// ──────────────────────────────────────────────
// Colector de errores léxicos/sintácticos/semánticos
// ──────────────────────────────────────────────
class GolampiErrorCollector extends BaseErrorListener
{
    /** @var array<int, array> */
    private array $errors     = [];
    private bool  $fatalError = false;

    // Llamado por ANTLR al detectar un error léxico/sintáctico
    public function syntaxError(
        Recognizer $recognizer,
        ?object    $offendingSymbol,
        int        $line,
        int        $charPositionInLine,
        string     $msg,
        ?RecognitionException $e
    ): void {
        // Si el símbolo ofensor es ERR_CHAR (tipo 69), es un error léxico
        $isErrChar = $offendingSymbol !== null && $offendingSymbol->getType() === 69;
        $type = ($recognizer instanceof \GolampiLexer || $isErrChar) ? 'Léxico' : 'Sintáctico';

        // Para errores léxicos de ERR_CHAR, simplificar el mensaje
        if ($isErrChar) {
            $char = $offendingSymbol->getText();
            $msg  = "Símbolo no reconocido: '$char'";
        }

        $this->errors[] = [
            'type'    => $type,
            'desc'    => $msg,
            'line'    => $line,
            'column'  => $charPositionInLine + 1,
        ];

        if ($type === 'Sintáctico') {
            $this->fatalError = true;
        }
    }

    public function addSemanticError(string $desc, int $line = 0, int $col = 0): void
    {
        $this->errors[] = [
            'type'   => 'Semántico',
            'desc'   => $desc,
            'line'   => $line,
            'column' => $col,
        ];
    }

    public function hasFatalError(): bool  { return $this->fatalError; }
    public function getErrors(): array     { return $this->errors;     }
}