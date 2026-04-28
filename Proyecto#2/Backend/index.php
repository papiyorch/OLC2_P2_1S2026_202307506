<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Autoload: Composer + clases propias
// ──────────────────────────────────────────────
require_once __DIR__ . '/vendor/autoload.php';

// Cargar archivos generados por ANTLR4
require_once __DIR__ . '/antlr/GolampiLexer.php';
require_once __DIR__ . '/antlr/GolampiParser.php';
require_once __DIR__ . '/antlr/GolampiVisitor.php';
require_once __DIR__ . '/antlr/GolampiBaseVisitor.php';

require_once __DIR__ . '/interpreter/Environment.php';
require_once __DIR__ . '/interpreter/GolampiCompilerError.php';
require_once __DIR__ . '/interpreter/GolampiCompiler.php';

use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\InputStream;

// Leer input
// ──────────────────────────────────────────────
$body = json_decode(file_get_contents('php://input'), true);
$sourceCode = $body['code'] ?? '';

if (trim($sourceCode) === '') {
    echo json_encode([
        'output'  => '',
        'errors'  => [],
        'symbols' => [],
    ]);
    exit();
}

// Análisis léxico y sintáctico
// ──────────────────────────────────────────────
$errorCollector = new GolampiErrorCollector();

$input  = InputStream::fromString($sourceCode);
$lexer  = new GolampiLexer($input);
$lexer->removeErrorListeners();
$lexer->addErrorListener($errorCollector);

$tokens = new CommonTokenStream($lexer);
$parser = new GolampiParser($tokens);
$parser->removeErrorListeners();
$parser->addErrorListener($errorCollector);

$tree = $parser->start();

// Fase de Compilación a ARM64
// ──────────────────────────────────────────────
$output      = '';
$symbolTable = [];
$allErrors   = [];

if (!$errorCollector->hasFatalError()) {
    $compiler = new GolampiCompiler();
    
    try {
        $compiler->visitStart($tree);
    } catch (\Throwable $e) {
        $errorCollector->addSemanticError("Error interno: " . $e->getMessage());
    }
    
    $symbolTable = $compiler->getSymbolTable();
    $allErrors   = array_merge($errorCollector->getErrors(), $compiler->getSemanticErrors());
    
    if (count($allErrors) > 0) {
        // Si hay errores, mostrar resumen y no el ARM64
        $output = "COMPILACIÓN FALLIDA.\n";
        $output .= "Se detectaron " . count($allErrors) . " error(es) en el código.\n";
        $output .= "Revise la pestaña 'Errores' para más detalles.";
    } else {
        //Compilación exitosa, mostrar ensamblador completo
        $output = $compiler->getFinalAssembly();
    }
} else {
    $allErrors = $errorCollector->getErrors();
    $output    = "COMPILACIÓN ABORTADA.\nErrores Léxicos/Sintácticos graves detectados.\nRevise la pestaña 'Errores'.";
}

// Respuesta JSON
// ──────────────────────────────────────────────
echo json_encode([
    'output'  => $output,  
    'errors'  => $allErrors,
    'symbols' => $symbolTable,
]);