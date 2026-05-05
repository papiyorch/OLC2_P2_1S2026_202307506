<?php

/*
 * Generated from Golampi.g4 by ANTLR 4.13.1
 */

namespace {
	use Antlr\Antlr4\Runtime\Atn\ATN;
	use Antlr\Antlr4\Runtime\Atn\ATNDeserializer;
	use Antlr\Antlr4\Runtime\Atn\ParserATNSimulator;
	use Antlr\Antlr4\Runtime\Dfa\DFA;
	use Antlr\Antlr4\Runtime\Error\Exceptions\FailedPredicateException;
	use Antlr\Antlr4\Runtime\Error\Exceptions\NoViableAltException;
	use Antlr\Antlr4\Runtime\PredictionContexts\PredictionContextCache;
	use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
	use Antlr\Antlr4\Runtime\RuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\TokenStream;
	use Antlr\Antlr4\Runtime\Vocabulary;
	use Antlr\Antlr4\Runtime\VocabularyImpl;
	use Antlr\Antlr4\Runtime\RuntimeMetaData;
	use Antlr\Antlr4\Runtime\Parser;

	final class GolampiParser extends Parser
	{
		public const FUNC = 1, VAR = 2, CONST = 3, IF = 4, ELSE = 5, SWITCH = 6, 
               CASE = 7, DEFAULT = 8, FOR = 9, BREAK = 10, CONTIN = 11, 
               RETURN = 12, NIL = 13, PRINT = 14, PRINTLN = 15, INT32 = 16, 
               FLOAT32 = 17, BOOL = 18, RUNE = 19, STRING = 20, BOOL_LIT = 21, 
               FMT_PRINTLN = 22, LEN = 23, NOW = 24, SUBSTR = 25, TYPEOF = 26, 
               ASSIGN = 27, DECL_ASSIGN = 28, PLUS_ASSIGN = 29, MINUS_ASSIGN = 30, 
               MUL_ASSIGN = 31, DIV_ASSIGN = 32, MOD_ASSIGN = 33, INC = 34, 
               DEC = 35, PLUS = 36, MINUS = 37, MUL = 38, DIV = 39, MOD = 40, 
               EQ = 41, NEQ = 42, LT = 43, LE = 44, GT = 45, GE = 46, AND = 47, 
               OR = 48, NOT = 49, AMP = 50, PIPE = 51, LPAREN = 52, RPAREN = 53, 
               LBRACE = 54, RBRACE = 55, LBRACK = 56, RBRACK = 57, SEMI = 58, 
               COLON = 59, COMMA = 60, DOT = 61, QUESTION = 62, ID = 63, 
               ENTERO = 64, DECIMAL = 65, STRING_LITERAL = 66, RUNE_LITERAL = 67, 
               COMMENT_SINGLE = 68, COMMENT_MULTI = 69, WS = 70, ERR_CHAR = 71;

		public const RULE_start = 0, RULE_topDecl = 1, RULE_functionDecl = 2, 
               RULE_returnTypes = 3, RULE_paramList = 4, RULE_parametro = 5, 
               RULE_block = 6, RULE_statement = 7, RULE_varDecl = 8, RULE_constantDecl = 9, 
               RULE_shortDecl = 10, RULE_assignment = 11, RULE_increment = 12, 
               RULE_printStmt = 13, RULE_ifStmt = 14, RULE_switchStmt = 15, 
               RULE_switchBlock = 16, RULE_caseStmt = 17, RULE_defaultStmt = 18, 
               RULE_forStmt = 19, RULE_breakStmt = 20, RULE_continueStmt = 21, 
               RULE_returnStmt = 22, RULE_arrayAssignment = 23, RULE_expression = 24, 
               RULE_valores = 25, RULE_type = 26, RULE_literal = 27, RULE_arrayLiteral = 28;

		/**
		 * @var array<string>
		 */
		public const RULE_NAMES = [
			'start', 'topDecl', 'functionDecl', 'returnTypes', 'paramList', 'parametro', 
			'block', 'statement', 'varDecl', 'constantDecl', 'shortDecl', 'assignment', 
			'increment', 'printStmt', 'ifStmt', 'switchStmt', 'switchBlock', 'caseStmt', 
			'defaultStmt', 'forStmt', 'breakStmt', 'continueStmt', 'returnStmt', 
			'arrayAssignment', 'expression', 'valores', 'type', 'literal', 'arrayLiteral'
		];

		/**
		 * @var array<string|null>
		 */
		private const LITERAL_NAMES = [
		    null, "'func'", "'var'", "'const'", "'if'", "'else'", "'switch'", 
		    "'case'", "'default'", "'for'", "'break'", "'continue'", "'return'", 
		    "'nil'", "'print'", "'println'", "'int32'", "'float32'", "'bool'", 
		    "'rune'", "'string'", null, "'fmt.Println'", "'len'", "'now'", "'substr'", 
		    "'typeOf'", "'='", "':='", "'+='", "'-='", "'*='", "'/='", "'%='", 
		    "'++'", "'--'", "'+'", "'-'", "'*'", "'/'", "'%'", "'=='", "'!='", 
		    "'<'", "'<='", "'>'", "'>='", "'&&'", "'||'", "'!'", "'&'", "'|>'", 
		    "'('", "')'", "'{'", "'}'", "'['", "']'", "';'", "':'", "','", "'.'", 
		    "'?'"
		];

		/**
		 * @var array<string>
		 */
		private const SYMBOLIC_NAMES = [
		    null, "FUNC", "VAR", "CONST", "IF", "ELSE", "SWITCH", "CASE", "DEFAULT", 
		    "FOR", "BREAK", "CONTIN", "RETURN", "NIL", "PRINT", "PRINTLN", "INT32", 
		    "FLOAT32", "BOOL", "RUNE", "STRING", "BOOL_LIT", "FMT_PRINTLN", "LEN", 
		    "NOW", "SUBSTR", "TYPEOF", "ASSIGN", "DECL_ASSIGN", "PLUS_ASSIGN", 
		    "MINUS_ASSIGN", "MUL_ASSIGN", "DIV_ASSIGN", "MOD_ASSIGN", "INC", "DEC", 
		    "PLUS", "MINUS", "MUL", "DIV", "MOD", "EQ", "NEQ", "LT", "LE", "GT", 
		    "GE", "AND", "OR", "NOT", "AMP", "PIPE", "LPAREN", "RPAREN", "LBRACE", 
		    "RBRACE", "LBRACK", "RBRACK", "SEMI", "COLON", "COMMA", "DOT", "QUESTION", 
		    "ID", "ENTERO", "DECIMAL", "STRING_LITERAL", "RUNE_LITERAL", "COMMENT_SINGLE", 
		    "COMMENT_MULTI", "WS", "ERR_CHAR"
		];

		private const SERIALIZED_ATN =
			[4, 1, 71, 439, 2, 0, 7, 0, 2, 1, 7, 1, 2, 2, 7, 2, 2, 3, 7, 3, 2, 4, 
		    7, 4, 2, 5, 7, 5, 2, 6, 7, 6, 2, 7, 7, 7, 2, 8, 7, 8, 2, 9, 7, 9, 
		    2, 10, 7, 10, 2, 11, 7, 11, 2, 12, 7, 12, 2, 13, 7, 13, 2, 14, 7, 
		    14, 2, 15, 7, 15, 2, 16, 7, 16, 2, 17, 7, 17, 2, 18, 7, 18, 2, 19, 
		    7, 19, 2, 20, 7, 20, 2, 21, 7, 21, 2, 22, 7, 22, 2, 23, 7, 23, 2, 
		    24, 7, 24, 2, 25, 7, 25, 2, 26, 7, 26, 2, 27, 7, 27, 2, 28, 7, 28, 
		    1, 0, 5, 0, 60, 8, 0, 10, 0, 12, 0, 63, 9, 0, 1, 0, 1, 0, 1, 1, 1, 
		    1, 1, 1, 3, 1, 70, 8, 1, 1, 2, 1, 2, 1, 2, 1, 2, 3, 2, 76, 8, 2, 1, 
		    2, 1, 2, 3, 2, 80, 8, 2, 1, 2, 1, 2, 1, 3, 1, 3, 1, 3, 1, 3, 1, 3, 
		    5, 3, 89, 8, 3, 10, 3, 12, 3, 92, 9, 3, 1, 3, 1, 3, 3, 3, 96, 8, 3, 
		    1, 4, 1, 4, 1, 4, 5, 4, 101, 8, 4, 10, 4, 12, 4, 104, 9, 4, 1, 5, 
		    1, 5, 1, 5, 1, 6, 1, 6, 5, 6, 111, 8, 6, 10, 6, 12, 6, 114, 9, 6, 
		    1, 6, 1, 6, 1, 7, 1, 7, 3, 7, 120, 8, 7, 1, 7, 1, 7, 3, 7, 124, 8, 
		    7, 1, 7, 1, 7, 3, 7, 128, 8, 7, 1, 7, 1, 7, 3, 7, 132, 8, 7, 1, 7, 
		    1, 7, 3, 7, 136, 8, 7, 1, 7, 1, 7, 3, 7, 140, 8, 7, 1, 7, 1, 7, 3, 
		    7, 144, 8, 7, 1, 7, 1, 7, 3, 7, 148, 8, 7, 1, 7, 1, 7, 3, 7, 152, 
		    8, 7, 1, 7, 1, 7, 3, 7, 156, 8, 7, 1, 7, 1, 7, 3, 7, 160, 8, 7, 1, 
		    7, 1, 7, 3, 7, 164, 8, 7, 1, 7, 1, 7, 3, 7, 168, 8, 7, 1, 7, 1, 7, 
		    3, 7, 172, 8, 7, 1, 7, 1, 7, 3, 7, 176, 8, 7, 1, 7, 1, 7, 4, 7, 180, 
		    8, 7, 11, 7, 12, 7, 181, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 3, 7, 189, 
		    8, 7, 1, 8, 1, 8, 1, 8, 1, 8, 5, 8, 195, 8, 8, 10, 8, 12, 8, 198, 
		    9, 8, 1, 8, 1, 8, 1, 8, 3, 8, 203, 8, 8, 1, 9, 1, 9, 1, 9, 1, 9, 1, 
		    9, 1, 9, 1, 10, 1, 10, 1, 10, 5, 10, 214, 8, 10, 10, 10, 12, 10, 217, 
		    9, 10, 1, 10, 1, 10, 1, 10, 1, 11, 1, 11, 1, 11, 5, 11, 225, 8, 11, 
		    10, 11, 12, 11, 228, 9, 11, 1, 11, 1, 11, 1, 11, 1, 11, 1, 11, 3, 
		    11, 235, 8, 11, 1, 12, 1, 12, 1, 12, 1, 13, 1, 13, 1, 13, 3, 13, 243, 
		    8, 13, 1, 13, 1, 13, 1, 14, 1, 14, 1, 14, 1, 14, 1, 14, 1, 14, 3, 
		    14, 253, 8, 14, 3, 14, 255, 8, 14, 1, 15, 1, 15, 1, 15, 1, 15, 1, 
		    15, 1, 15, 1, 16, 5, 16, 264, 8, 16, 10, 16, 12, 16, 267, 9, 16, 1, 
		    16, 3, 16, 270, 8, 16, 1, 17, 1, 17, 1, 17, 1, 17, 5, 17, 276, 8, 
		    17, 10, 17, 12, 17, 279, 9, 17, 1, 18, 1, 18, 1, 18, 5, 18, 284, 8, 
		    18, 10, 18, 12, 18, 287, 9, 18, 1, 19, 1, 19, 1, 19, 1, 19, 3, 19, 
		    293, 8, 19, 1, 19, 1, 19, 1, 19, 1, 19, 1, 19, 3, 19, 300, 8, 19, 
		    3, 19, 302, 8, 19, 1, 19, 1, 19, 1, 20, 1, 20, 1, 21, 1, 21, 1, 22, 
		    1, 22, 3, 22, 312, 8, 22, 1, 23, 1, 23, 1, 23, 1, 23, 1, 23, 4, 23, 
		    319, 8, 23, 11, 23, 12, 23, 320, 1, 23, 1, 23, 1, 23, 1, 24, 1, 24, 
		    1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 
		    24, 1, 24, 3, 24, 339, 8, 24, 3, 24, 341, 8, 24, 1, 24, 1, 24, 1, 
		    24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 3, 24, 351, 8, 24, 1, 24, 1, 
		    24, 1, 24, 3, 24, 356, 8, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 
		    24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 
		    1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 
		    24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 
		    1, 24, 3, 24, 393, 8, 24, 1, 24, 5, 24, 396, 8, 24, 10, 24, 12, 24, 
		    399, 9, 24, 1, 25, 1, 25, 1, 25, 5, 25, 404, 8, 25, 10, 25, 12, 25, 
		    407, 9, 25, 1, 26, 1, 26, 1, 26, 1, 26, 1, 26, 1, 26, 1, 26, 1, 26, 
		    1, 26, 1, 26, 1, 26, 1, 26, 1, 26, 1, 26, 1, 26, 1, 26, 3, 26, 425, 
		    8, 26, 1, 27, 1, 27, 1, 28, 1, 28, 1, 28, 1, 28, 3, 28, 433, 8, 28, 
		    3, 28, 435, 8, 28, 1, 28, 1, 28, 1, 28, 0, 1, 48, 29, 0, 2, 4, 6, 
		    8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36, 38, 40, 
		    42, 44, 46, 48, 50, 52, 54, 56, 0, 9, 1, 0, 29, 33, 1, 0, 34, 35, 
		    2, 0, 14, 15, 22, 22, 1, 0, 23, 26, 1, 0, 38, 40, 1, 0, 36, 37, 1, 
		    0, 43, 46, 1, 0, 41, 42, 3, 0, 13, 13, 21, 21, 64, 67, 502, 0, 61, 
		    1, 0, 0, 0, 2, 69, 1, 0, 0, 0, 4, 71, 1, 0, 0, 0, 6, 95, 1, 0, 0, 
		    0, 8, 97, 1, 0, 0, 0, 10, 105, 1, 0, 0, 0, 12, 108, 1, 0, 0, 0, 14, 
		    188, 1, 0, 0, 0, 16, 190, 1, 0, 0, 0, 18, 204, 1, 0, 0, 0, 20, 210, 
		    1, 0, 0, 0, 22, 234, 1, 0, 0, 0, 24, 236, 1, 0, 0, 0, 26, 239, 1, 
		    0, 0, 0, 28, 246, 1, 0, 0, 0, 30, 256, 1, 0, 0, 0, 32, 265, 1, 0, 
		    0, 0, 34, 271, 1, 0, 0, 0, 36, 280, 1, 0, 0, 0, 38, 288, 1, 0, 0, 
		    0, 40, 305, 1, 0, 0, 0, 42, 307, 1, 0, 0, 0, 44, 309, 1, 0, 0, 0, 
		    46, 313, 1, 0, 0, 0, 48, 355, 1, 0, 0, 0, 50, 400, 1, 0, 0, 0, 52, 
		    424, 1, 0, 0, 0, 54, 426, 1, 0, 0, 0, 56, 428, 1, 0, 0, 0, 58, 60, 
		    3, 2, 1, 0, 59, 58, 1, 0, 0, 0, 60, 63, 1, 0, 0, 0, 61, 59, 1, 0, 
		    0, 0, 61, 62, 1, 0, 0, 0, 62, 64, 1, 0, 0, 0, 63, 61, 1, 0, 0, 0, 
		    64, 65, 5, 0, 0, 1, 65, 1, 1, 0, 0, 0, 66, 70, 3, 4, 2, 0, 67, 70, 
		    3, 16, 8, 0, 68, 70, 3, 18, 9, 0, 69, 66, 1, 0, 0, 0, 69, 67, 1, 0, 
		    0, 0, 69, 68, 1, 0, 0, 0, 70, 3, 1, 0, 0, 0, 71, 72, 5, 1, 0, 0, 72, 
		    73, 5, 63, 0, 0, 73, 75, 5, 52, 0, 0, 74, 76, 3, 8, 4, 0, 75, 74, 
		    1, 0, 0, 0, 75, 76, 1, 0, 0, 0, 76, 77, 1, 0, 0, 0, 77, 79, 5, 53, 
		    0, 0, 78, 80, 3, 6, 3, 0, 79, 78, 1, 0, 0, 0, 79, 80, 1, 0, 0, 0, 
		    80, 81, 1, 0, 0, 0, 81, 82, 3, 12, 6, 0, 82, 5, 1, 0, 0, 0, 83, 96, 
		    3, 52, 26, 0, 84, 85, 5, 52, 0, 0, 85, 90, 3, 52, 26, 0, 86, 87, 5, 
		    60, 0, 0, 87, 89, 3, 52, 26, 0, 88, 86, 1, 0, 0, 0, 89, 92, 1, 0, 
		    0, 0, 90, 88, 1, 0, 0, 0, 90, 91, 1, 0, 0, 0, 91, 93, 1, 0, 0, 0, 
		    92, 90, 1, 0, 0, 0, 93, 94, 5, 53, 0, 0, 94, 96, 1, 0, 0, 0, 95, 83, 
		    1, 0, 0, 0, 95, 84, 1, 0, 0, 0, 96, 7, 1, 0, 0, 0, 97, 102, 3, 10, 
		    5, 0, 98, 99, 5, 60, 0, 0, 99, 101, 3, 10, 5, 0, 100, 98, 1, 0, 0, 
		    0, 101, 104, 1, 0, 0, 0, 102, 100, 1, 0, 0, 0, 102, 103, 1, 0, 0, 
		    0, 103, 9, 1, 0, 0, 0, 104, 102, 1, 0, 0, 0, 105, 106, 5, 63, 0, 0, 
		    106, 107, 3, 52, 26, 0, 107, 11, 1, 0, 0, 0, 108, 112, 5, 54, 0, 0, 
		    109, 111, 3, 14, 7, 0, 110, 109, 1, 0, 0, 0, 111, 114, 1, 0, 0, 0, 
		    112, 110, 1, 0, 0, 0, 112, 113, 1, 0, 0, 0, 113, 115, 1, 0, 0, 0, 
		    114, 112, 1, 0, 0, 0, 115, 116, 5, 55, 0, 0, 116, 13, 1, 0, 0, 0, 
		    117, 119, 3, 16, 8, 0, 118, 120, 5, 58, 0, 0, 119, 118, 1, 0, 0, 0, 
		    119, 120, 1, 0, 0, 0, 120, 189, 1, 0, 0, 0, 121, 123, 3, 18, 9, 0, 
		    122, 124, 5, 58, 0, 0, 123, 122, 1, 0, 0, 0, 123, 124, 1, 0, 0, 0, 
		    124, 189, 1, 0, 0, 0, 125, 127, 3, 20, 10, 0, 126, 128, 5, 58, 0, 
		    0, 127, 126, 1, 0, 0, 0, 127, 128, 1, 0, 0, 0, 128, 189, 1, 0, 0, 
		    0, 129, 131, 3, 22, 11, 0, 130, 132, 5, 58, 0, 0, 131, 130, 1, 0, 
		    0, 0, 131, 132, 1, 0, 0, 0, 132, 189, 1, 0, 0, 0, 133, 135, 3, 24, 
		    12, 0, 134, 136, 5, 58, 0, 0, 135, 134, 1, 0, 0, 0, 135, 136, 1, 0, 
		    0, 0, 136, 189, 1, 0, 0, 0, 137, 139, 3, 26, 13, 0, 138, 140, 5, 58, 
		    0, 0, 139, 138, 1, 0, 0, 0, 139, 140, 1, 0, 0, 0, 140, 189, 1, 0, 
		    0, 0, 141, 143, 3, 28, 14, 0, 142, 144, 5, 58, 0, 0, 143, 142, 1, 
		    0, 0, 0, 143, 144, 1, 0, 0, 0, 144, 189, 1, 0, 0, 0, 145, 147, 3, 
		    30, 15, 0, 146, 148, 5, 58, 0, 0, 147, 146, 1, 0, 0, 0, 147, 148, 
		    1, 0, 0, 0, 148, 189, 1, 0, 0, 0, 149, 151, 3, 38, 19, 0, 150, 152, 
		    5, 58, 0, 0, 151, 150, 1, 0, 0, 0, 151, 152, 1, 0, 0, 0, 152, 189, 
		    1, 0, 0, 0, 153, 155, 3, 40, 20, 0, 154, 156, 5, 58, 0, 0, 155, 154, 
		    1, 0, 0, 0, 155, 156, 1, 0, 0, 0, 156, 189, 1, 0, 0, 0, 157, 159, 
		    3, 42, 21, 0, 158, 160, 5, 58, 0, 0, 159, 158, 1, 0, 0, 0, 159, 160, 
		    1, 0, 0, 0, 160, 189, 1, 0, 0, 0, 161, 163, 3, 12, 6, 0, 162, 164, 
		    5, 58, 0, 0, 163, 162, 1, 0, 0, 0, 163, 164, 1, 0, 0, 0, 164, 189, 
		    1, 0, 0, 0, 165, 167, 3, 44, 22, 0, 166, 168, 5, 58, 0, 0, 167, 166, 
		    1, 0, 0, 0, 167, 168, 1, 0, 0, 0, 168, 189, 1, 0, 0, 0, 169, 171, 
		    3, 46, 23, 0, 170, 172, 5, 58, 0, 0, 171, 170, 1, 0, 0, 0, 171, 172, 
		    1, 0, 0, 0, 172, 189, 1, 0, 0, 0, 173, 175, 3, 48, 24, 0, 174, 176, 
		    5, 58, 0, 0, 175, 174, 1, 0, 0, 0, 175, 176, 1, 0, 0, 0, 176, 189, 
		    1, 0, 0, 0, 177, 189, 5, 58, 0, 0, 178, 180, 5, 38, 0, 0, 179, 178, 
		    1, 0, 0, 0, 180, 181, 1, 0, 0, 0, 181, 179, 1, 0, 0, 0, 181, 182, 
		    1, 0, 0, 0, 182, 183, 1, 0, 0, 0, 183, 184, 5, 63, 0, 0, 184, 185, 
		    5, 27, 0, 0, 185, 186, 3, 48, 24, 0, 186, 187, 5, 58, 0, 0, 187, 189, 
		    1, 0, 0, 0, 188, 117, 1, 0, 0, 0, 188, 121, 1, 0, 0, 0, 188, 125, 
		    1, 0, 0, 0, 188, 129, 1, 0, 0, 0, 188, 133, 1, 0, 0, 0, 188, 137, 
		    1, 0, 0, 0, 188, 141, 1, 0, 0, 0, 188, 145, 1, 0, 0, 0, 188, 149, 
		    1, 0, 0, 0, 188, 153, 1, 0, 0, 0, 188, 157, 1, 0, 0, 0, 188, 161, 
		    1, 0, 0, 0, 188, 165, 1, 0, 0, 0, 188, 169, 1, 0, 0, 0, 188, 173, 
		    1, 0, 0, 0, 188, 177, 1, 0, 0, 0, 188, 179, 1, 0, 0, 0, 189, 15, 1, 
		    0, 0, 0, 190, 191, 5, 2, 0, 0, 191, 196, 5, 63, 0, 0, 192, 193, 5, 
		    60, 0, 0, 193, 195, 5, 63, 0, 0, 194, 192, 1, 0, 0, 0, 195, 198, 1, 
		    0, 0, 0, 196, 194, 1, 0, 0, 0, 196, 197, 1, 0, 0, 0, 197, 199, 1, 
		    0, 0, 0, 198, 196, 1, 0, 0, 0, 199, 202, 3, 52, 26, 0, 200, 201, 5, 
		    27, 0, 0, 201, 203, 3, 50, 25, 0, 202, 200, 1, 0, 0, 0, 202, 203, 
		    1, 0, 0, 0, 203, 17, 1, 0, 0, 0, 204, 205, 5, 3, 0, 0, 205, 206, 5, 
		    63, 0, 0, 206, 207, 3, 52, 26, 0, 207, 208, 5, 27, 0, 0, 208, 209, 
		    3, 48, 24, 0, 209, 19, 1, 0, 0, 0, 210, 215, 5, 63, 0, 0, 211, 212, 
		    5, 60, 0, 0, 212, 214, 5, 63, 0, 0, 213, 211, 1, 0, 0, 0, 214, 217, 
		    1, 0, 0, 0, 215, 213, 1, 0, 0, 0, 215, 216, 1, 0, 0, 0, 216, 218, 
		    1, 0, 0, 0, 217, 215, 1, 0, 0, 0, 218, 219, 5, 28, 0, 0, 219, 220, 
		    3, 50, 25, 0, 220, 21, 1, 0, 0, 0, 221, 226, 5, 63, 0, 0, 222, 223, 
		    5, 60, 0, 0, 223, 225, 5, 63, 0, 0, 224, 222, 1, 0, 0, 0, 225, 228, 
		    1, 0, 0, 0, 226, 224, 1, 0, 0, 0, 226, 227, 1, 0, 0, 0, 227, 229, 
		    1, 0, 0, 0, 228, 226, 1, 0, 0, 0, 229, 230, 5, 27, 0, 0, 230, 235, 
		    3, 50, 25, 0, 231, 232, 5, 63, 0, 0, 232, 233, 7, 0, 0, 0, 233, 235, 
		    3, 48, 24, 0, 234, 221, 1, 0, 0, 0, 234, 231, 1, 0, 0, 0, 235, 23, 
		    1, 0, 0, 0, 236, 237, 5, 63, 0, 0, 237, 238, 7, 1, 0, 0, 238, 25, 
		    1, 0, 0, 0, 239, 240, 7, 2, 0, 0, 240, 242, 5, 52, 0, 0, 241, 243, 
		    3, 50, 25, 0, 242, 241, 1, 0, 0, 0, 242, 243, 1, 0, 0, 0, 243, 244, 
		    1, 0, 0, 0, 244, 245, 5, 53, 0, 0, 245, 27, 1, 0, 0, 0, 246, 247, 
		    5, 4, 0, 0, 247, 248, 3, 48, 24, 0, 248, 254, 3, 12, 6, 0, 249, 252, 
		    5, 5, 0, 0, 250, 253, 3, 28, 14, 0, 251, 253, 3, 12, 6, 0, 252, 250, 
		    1, 0, 0, 0, 252, 251, 1, 0, 0, 0, 253, 255, 1, 0, 0, 0, 254, 249, 
		    1, 0, 0, 0, 254, 255, 1, 0, 0, 0, 255, 29, 1, 0, 0, 0, 256, 257, 5, 
		    6, 0, 0, 257, 258, 3, 48, 24, 0, 258, 259, 5, 54, 0, 0, 259, 260, 
		    3, 32, 16, 0, 260, 261, 5, 55, 0, 0, 261, 31, 1, 0, 0, 0, 262, 264, 
		    3, 34, 17, 0, 263, 262, 1, 0, 0, 0, 264, 267, 1, 0, 0, 0, 265, 263, 
		    1, 0, 0, 0, 265, 266, 1, 0, 0, 0, 266, 269, 1, 0, 0, 0, 267, 265, 
		    1, 0, 0, 0, 268, 270, 3, 36, 18, 0, 269, 268, 1, 0, 0, 0, 269, 270, 
		    1, 0, 0, 0, 270, 33, 1, 0, 0, 0, 271, 272, 5, 7, 0, 0, 272, 273, 3, 
		    50, 25, 0, 273, 277, 5, 59, 0, 0, 274, 276, 3, 14, 7, 0, 275, 274, 
		    1, 0, 0, 0, 276, 279, 1, 0, 0, 0, 277, 275, 1, 0, 0, 0, 277, 278, 
		    1, 0, 0, 0, 278, 35, 1, 0, 0, 0, 279, 277, 1, 0, 0, 0, 280, 281, 5, 
		    8, 0, 0, 281, 285, 5, 59, 0, 0, 282, 284, 3, 14, 7, 0, 283, 282, 1, 
		    0, 0, 0, 284, 287, 1, 0, 0, 0, 285, 283, 1, 0, 0, 0, 285, 286, 1, 
		    0, 0, 0, 286, 37, 1, 0, 0, 0, 287, 285, 1, 0, 0, 0, 288, 301, 5, 9, 
		    0, 0, 289, 302, 3, 48, 24, 0, 290, 293, 3, 16, 8, 0, 291, 293, 3, 
		    20, 10, 0, 292, 290, 1, 0, 0, 0, 292, 291, 1, 0, 0, 0, 293, 294, 1, 
		    0, 0, 0, 294, 295, 5, 58, 0, 0, 295, 296, 3, 48, 24, 0, 296, 299, 
		    5, 58, 0, 0, 297, 300, 3, 22, 11, 0, 298, 300, 3, 24, 12, 0, 299, 
		    297, 1, 0, 0, 0, 299, 298, 1, 0, 0, 0, 300, 302, 1, 0, 0, 0, 301, 
		    289, 1, 0, 0, 0, 301, 292, 1, 0, 0, 0, 301, 302, 1, 0, 0, 0, 302, 
		    303, 1, 0, 0, 0, 303, 304, 3, 12, 6, 0, 304, 39, 1, 0, 0, 0, 305, 
		    306, 5, 10, 0, 0, 306, 41, 1, 0, 0, 0, 307, 308, 5, 11, 0, 0, 308, 
		    43, 1, 0, 0, 0, 309, 311, 5, 12, 0, 0, 310, 312, 3, 50, 25, 0, 311, 
		    310, 1, 0, 0, 0, 311, 312, 1, 0, 0, 0, 312, 45, 1, 0, 0, 0, 313, 318, 
		    5, 63, 0, 0, 314, 315, 5, 56, 0, 0, 315, 316, 3, 48, 24, 0, 316, 317, 
		    5, 57, 0, 0, 317, 319, 1, 0, 0, 0, 318, 314, 1, 0, 0, 0, 319, 320, 
		    1, 0, 0, 0, 320, 318, 1, 0, 0, 0, 320, 321, 1, 0, 0, 0, 321, 322, 
		    1, 0, 0, 0, 322, 323, 5, 27, 0, 0, 323, 324, 3, 48, 24, 0, 324, 47, 
		    1, 0, 0, 0, 325, 326, 6, 24, -1, 0, 326, 327, 5, 52, 0, 0, 327, 328, 
		    3, 48, 24, 0, 328, 329, 5, 53, 0, 0, 329, 356, 1, 0, 0, 0, 330, 331, 
		    5, 49, 0, 0, 331, 356, 3, 48, 24, 19, 332, 333, 5, 37, 0, 0, 333, 
		    356, 3, 48, 24, 18, 334, 356, 3, 56, 28, 0, 335, 340, 5, 54, 0, 0, 
		    336, 338, 3, 50, 25, 0, 337, 339, 5, 60, 0, 0, 338, 337, 1, 0, 0, 
		    0, 338, 339, 1, 0, 0, 0, 339, 341, 1, 0, 0, 0, 340, 336, 1, 0, 0, 
		    0, 340, 341, 1, 0, 0, 0, 341, 342, 1, 0, 0, 0, 342, 356, 5, 55, 0, 
		    0, 343, 344, 5, 50, 0, 0, 344, 356, 5, 63, 0, 0, 345, 346, 5, 38, 
		    0, 0, 346, 356, 3, 48, 24, 14, 347, 348, 7, 3, 0, 0, 348, 350, 5, 
		    52, 0, 0, 349, 351, 3, 50, 25, 0, 350, 349, 1, 0, 0, 0, 350, 351, 
		    1, 0, 0, 0, 351, 352, 1, 0, 0, 0, 352, 356, 5, 53, 0, 0, 353, 356, 
		    5, 63, 0, 0, 354, 356, 3, 54, 27, 0, 355, 325, 1, 0, 0, 0, 355, 330, 
		    1, 0, 0, 0, 355, 332, 1, 0, 0, 0, 355, 334, 1, 0, 0, 0, 355, 335, 
		    1, 0, 0, 0, 355, 343, 1, 0, 0, 0, 355, 345, 1, 0, 0, 0, 355, 347, 
		    1, 0, 0, 0, 355, 353, 1, 0, 0, 0, 355, 354, 1, 0, 0, 0, 356, 397, 
		    1, 0, 0, 0, 357, 358, 10, 11, 0, 0, 358, 359, 7, 4, 0, 0, 359, 396, 
		    3, 48, 24, 12, 360, 361, 10, 10, 0, 0, 361, 362, 7, 5, 0, 0, 362, 
		    396, 3, 48, 24, 11, 363, 364, 10, 9, 0, 0, 364, 365, 7, 6, 0, 0, 365, 
		    396, 3, 48, 24, 10, 366, 367, 10, 8, 0, 0, 367, 368, 7, 7, 0, 0, 368, 
		    396, 3, 48, 24, 9, 369, 370, 10, 7, 0, 0, 370, 371, 5, 47, 0, 0, 371, 
		    396, 3, 48, 24, 8, 372, 373, 10, 6, 0, 0, 373, 374, 5, 48, 0, 0, 374, 
		    396, 3, 48, 24, 7, 375, 376, 10, 5, 0, 0, 376, 377, 5, 51, 0, 0, 377, 
		    396, 3, 48, 24, 6, 378, 379, 10, 4, 0, 0, 379, 380, 5, 62, 0, 0, 380, 
		    381, 3, 48, 24, 0, 381, 382, 5, 59, 0, 0, 382, 383, 3, 48, 24, 5, 
		    383, 396, 1, 0, 0, 0, 384, 385, 10, 13, 0, 0, 385, 386, 5, 56, 0, 
		    0, 386, 387, 3, 48, 24, 0, 387, 388, 5, 57, 0, 0, 388, 396, 1, 0, 
		    0, 0, 389, 390, 10, 12, 0, 0, 390, 392, 5, 52, 0, 0, 391, 393, 3, 
		    50, 25, 0, 392, 391, 1, 0, 0, 0, 392, 393, 1, 0, 0, 0, 393, 394, 1, 
		    0, 0, 0, 394, 396, 5, 53, 0, 0, 395, 357, 1, 0, 0, 0, 395, 360, 1, 
		    0, 0, 0, 395, 363, 1, 0, 0, 0, 395, 366, 1, 0, 0, 0, 395, 369, 1, 
		    0, 0, 0, 395, 372, 1, 0, 0, 0, 395, 375, 1, 0, 0, 0, 395, 378, 1, 
		    0, 0, 0, 395, 384, 1, 0, 0, 0, 395, 389, 1, 0, 0, 0, 396, 399, 1, 
		    0, 0, 0, 397, 395, 1, 0, 0, 0, 397, 398, 1, 0, 0, 0, 398, 49, 1, 0, 
		    0, 0, 399, 397, 1, 0, 0, 0, 400, 405, 3, 48, 24, 0, 401, 402, 5, 60, 
		    0, 0, 402, 404, 3, 48, 24, 0, 403, 401, 1, 0, 0, 0, 404, 407, 1, 0, 
		    0, 0, 405, 403, 1, 0, 0, 0, 405, 406, 1, 0, 0, 0, 406, 51, 1, 0, 0, 
		    0, 407, 405, 1, 0, 0, 0, 408, 425, 5, 16, 0, 0, 409, 425, 5, 17, 0, 
		    0, 410, 425, 5, 18, 0, 0, 411, 425, 5, 19, 0, 0, 412, 425, 5, 20, 
		    0, 0, 413, 414, 5, 38, 0, 0, 414, 425, 3, 52, 26, 0, 415, 416, 5, 
		    56, 0, 0, 416, 417, 3, 48, 24, 0, 417, 418, 5, 57, 0, 0, 418, 419, 
		    3, 52, 26, 0, 419, 425, 1, 0, 0, 0, 420, 421, 5, 56, 0, 0, 421, 422, 
		    5, 57, 0, 0, 422, 425, 3, 52, 26, 0, 423, 425, 5, 63, 0, 0, 424, 408, 
		    1, 0, 0, 0, 424, 409, 1, 0, 0, 0, 424, 410, 1, 0, 0, 0, 424, 411, 
		    1, 0, 0, 0, 424, 412, 1, 0, 0, 0, 424, 413, 1, 0, 0, 0, 424, 415, 
		    1, 0, 0, 0, 424, 420, 1, 0, 0, 0, 424, 423, 1, 0, 0, 0, 425, 53, 1, 
		    0, 0, 0, 426, 427, 7, 8, 0, 0, 427, 55, 1, 0, 0, 0, 428, 429, 3, 52, 
		    26, 0, 429, 434, 5, 54, 0, 0, 430, 432, 3, 50, 25, 0, 431, 433, 5, 
		    60, 0, 0, 432, 431, 1, 0, 0, 0, 432, 433, 1, 0, 0, 0, 433, 435, 1, 
		    0, 0, 0, 434, 430, 1, 0, 0, 0, 434, 435, 1, 0, 0, 0, 435, 436, 1, 
		    0, 0, 0, 436, 437, 5, 55, 0, 0, 437, 57, 1, 0, 0, 0, 53, 61, 69, 75, 
		    79, 90, 95, 102, 112, 119, 123, 127, 131, 135, 139, 143, 147, 151, 
		    155, 159, 163, 167, 171, 175, 181, 188, 196, 202, 215, 226, 234, 242, 
		    252, 254, 265, 269, 277, 285, 292, 299, 301, 311, 320, 338, 340, 350, 
		    355, 392, 395, 397, 405, 424, 432, 434];
		protected static $atn;
		protected static $decisionToDFA;
		protected static $sharedContextCache;

		public function __construct(TokenStream $input)
		{
			parent::__construct($input);

			self::initialize();

			$this->interp = new ParserATNSimulator($this, self::$atn, self::$decisionToDFA, self::$sharedContextCache);
		}

		private static function initialize(): void
		{
			if (self::$atn !== null) {
				return;
			}

			RuntimeMetaData::checkVersion('4.13.1', RuntimeMetaData::VERSION);

			$atn = (new ATNDeserializer())->deserialize(self::SERIALIZED_ATN);

			$decisionToDFA = [];
			for ($i = 0, $count = $atn->getNumberOfDecisions(); $i < $count; $i++) {
				$decisionToDFA[] = new DFA($atn->getDecisionState($i), $i);
			}

			self::$atn = $atn;
			self::$decisionToDFA = $decisionToDFA;
			self::$sharedContextCache = new PredictionContextCache();
		}

		public function getGrammarFileName(): string
		{
			return "Golampi.g4";
		}

		public function getRuleNames(): array
		{
			return self::RULE_NAMES;
		}

		public function getSerializedATN(): array
		{
			return self::SERIALIZED_ATN;
		}

		public function getATN(): ATN
		{
			return self::$atn;
		}

		public function getVocabulary(): Vocabulary
        {
            static $vocabulary;

			return $vocabulary = $vocabulary ?? new VocabularyImpl(self::LITERAL_NAMES, self::SYMBOLIC_NAMES);
        }

		/**
		 * @throws RecognitionException
		 */
		public function start(): Context\StartContext
		{
		    $localContext = new Context\StartContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 0, self::RULE_start);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(61);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 14) !== 0)) {
		        	$this->setState(58);
		        	$this->topDecl();
		        	$this->setState(63);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(64);
		        $this->match(self::EOF);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function topDecl(): Context\TopDeclContext
		{
		    $localContext = new Context\TopDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 2, self::RULE_topDecl);

		    try {
		        $this->setState(69);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::FUNC:
		            	$localContext = new Context\DeclFunctionContext($localContext);
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(66);
		            	$this->functionDecl();
		            	break;

		            case self::VAR:
		            	$localContext = new Context\DeclGlobalVarContext($localContext);
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(67);
		            	$this->varDecl();
		            	break;

		            case self::CONST:
		            	$localContext = new Context\DeclGlobalConstContext($localContext);
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(68);
		            	$this->constantDecl();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function functionDecl(): Context\FunctionDeclContext
		{
		    $localContext = new Context\FunctionDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 4, self::RULE_functionDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(71);
		        $this->match(self::FUNC);
		        $this->setState(72);
		        $this->match(self::ID);
		        $this->setState(73);
		        $this->match(self::LPAREN);
		        $this->setState(75);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ID) {
		        	$this->setState(74);
		        	$this->paramList();
		        }
		        $this->setState(77);
		        $this->match(self::RPAREN);
		        $this->setState(79);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & -9146810568309538816) !== 0)) {
		        	$this->setState(78);
		        	$this->returnTypes();
		        }
		        $this->setState(81);
		        $this->block();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function returnTypes(): Context\ReturnTypesContext
		{
		    $localContext = new Context\ReturnTypesContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 6, self::RULE_returnTypes);

		    try {
		        $this->setState(95);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::INT32:
		            case self::FLOAT32:
		            case self::BOOL:
		            case self::RUNE:
		            case self::STRING:
		            case self::MUL:
		            case self::LBRACK:
		            case self::ID:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(83);
		            	$this->type();
		            	break;

		            case self::LPAREN:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(84);
		            	$this->match(self::LPAREN);
		            	$this->setState(85);
		            	$this->type();
		            	$this->setState(90);
		            	$this->errorHandler->sync($this);

		            	$_la = $this->input->LA(1);
		            	while ($_la === self::COMMA) {
		            		$this->setState(86);
		            		$this->match(self::COMMA);
		            		$this->setState(87);
		            		$this->type();
		            		$this->setState(92);
		            		$this->errorHandler->sync($this);
		            		$_la = $this->input->LA(1);
		            	}
		            	$this->setState(93);
		            	$this->match(self::RPAREN);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function paramList(): Context\ParamListContext
		{
		    $localContext = new Context\ParamListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 8, self::RULE_paramList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(97);
		        $this->parametro();
		        $this->setState(102);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMMA) {
		        	$this->setState(98);
		        	$this->match(self::COMMA);
		        	$this->setState(99);
		        	$this->parametro();
		        	$this->setState(104);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function parametro(): Context\ParametroContext
		{
		    $localContext = new Context\ParametroContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 10, self::RULE_parametro);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(105);
		        $this->match(self::ID);
		        $this->setState(106);
		        $this->type();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function block(): Context\BlockContext
		{
		    $localContext = new Context\BlockContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 12, self::RULE_block);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(108);
		        $this->match(self::LBRACE);
		        $this->setState(112);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & -8838876806216941988) !== 0) || (((($_la - 64)) & ~0x3f) === 0 && ((1 << ($_la - 64)) & 15) !== 0)) {
		        	$this->setState(109);
		        	$this->statement();
		        	$this->setState(114);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(115);
		        $this->match(self::RBRACE);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function statement(): Context\StatementContext
		{
		    $localContext = new Context\StatementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 14, self::RULE_statement);

		    try {
		        $this->setState(188);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 24, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\StmtVarContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(117);
		        	    $this->varDecl();
		        	    $this->setState(119);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 8, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(118);
		        	    	    $this->match(self::SEMI);
		        	    	break;
		        	    }
		        	break;

		        	case 2:
		        	    $localContext = new Context\StmtConstContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(121);
		        	    $this->constantDecl();
		        	    $this->setState(123);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 9, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(122);
		        	    	    $this->match(self::SEMI);
		        	    	break;
		        	    }
		        	break;

		        	case 3:
		        	    $localContext = new Context\StmtShortDeclContext($localContext);
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(125);
		        	    $this->shortDecl();
		        	    $this->setState(127);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 10, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(126);
		        	    	    $this->match(self::SEMI);
		        	    	break;
		        	    }
		        	break;

		        	case 4:
		        	    $localContext = new Context\StmtAssignContext($localContext);
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(129);
		        	    $this->assignment();
		        	    $this->setState(131);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 11, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(130);
		        	    	    $this->match(self::SEMI);
		        	    	break;
		        	    }
		        	break;

		        	case 5:
		        	    $localContext = new Context\StmIncrementContext($localContext);
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(133);
		        	    $this->increment();
		        	    $this->setState(135);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 12, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(134);
		        	    	    $this->match(self::SEMI);
		        	    	break;
		        	    }
		        	break;

		        	case 6:
		        	    $localContext = new Context\StmtPrintContext($localContext);
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(137);
		        	    $this->printStmt();
		        	    $this->setState(139);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 13, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(138);
		        	    	    $this->match(self::SEMI);
		        	    	break;
		        	    }
		        	break;

		        	case 7:
		        	    $localContext = new Context\StmtIfContext($localContext);
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(141);
		        	    $this->ifStmt();
		        	    $this->setState(143);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 14, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(142);
		        	    	    $this->match(self::SEMI);
		        	    	break;
		        	    }
		        	break;

		        	case 8:
		        	    $localContext = new Context\StmtSwitchContext($localContext);
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(145);
		        	    $this->switchStmt();
		        	    $this->setState(147);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 15, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(146);
		        	    	    $this->match(self::SEMI);
		        	    	break;
		        	    }
		        	break;

		        	case 9:
		        	    $localContext = new Context\StmtForContext($localContext);
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(149);
		        	    $this->forStmt();
		        	    $this->setState(151);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 16, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(150);
		        	    	    $this->match(self::SEMI);
		        	    	break;
		        	    }
		        	break;

		        	case 10:
		        	    $localContext = new Context\StmtBreakContext($localContext);
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(153);
		        	    $this->breakStmt();
		        	    $this->setState(155);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 17, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(154);
		        	    	    $this->match(self::SEMI);
		        	    	break;
		        	    }
		        	break;

		        	case 11:
		        	    $localContext = new Context\StmtContinueContext($localContext);
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(157);
		        	    $this->continueStmt();
		        	    $this->setState(159);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 18, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(158);
		        	    	    $this->match(self::SEMI);
		        	    	break;
		        	    }
		        	break;

		        	case 12:
		        	    $localContext = new Context\StmtBlockContext($localContext);
		        	    $this->enterOuterAlt($localContext, 12);
		        	    $this->setState(161);
		        	    $this->block();
		        	    $this->setState(163);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 19, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(162);
		        	    	    $this->match(self::SEMI);
		        	    	break;
		        	    }
		        	break;

		        	case 13:
		        	    $localContext = new Context\StmtReturnContext($localContext);
		        	    $this->enterOuterAlt($localContext, 13);
		        	    $this->setState(165);
		        	    $this->returnStmt();
		        	    $this->setState(167);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 20, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(166);
		        	    	    $this->match(self::SEMI);
		        	    	break;
		        	    }
		        	break;

		        	case 14:
		        	    $localContext = new Context\StmtArrayAssignContext($localContext);
		        	    $this->enterOuterAlt($localContext, 14);
		        	    $this->setState(169);
		        	    $this->arrayAssignment();
		        	    $this->setState(171);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 21, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(170);
		        	    	    $this->match(self::SEMI);
		        	    	break;
		        	    }
		        	break;

		        	case 15:
		        	    $localContext = new Context\StmtExprContext($localContext);
		        	    $this->enterOuterAlt($localContext, 15);
		        	    $this->setState(173);
		        	    $this->recursiveExpression(0);
		        	    $this->setState(175);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 22, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(174);
		        	    	    $this->match(self::SEMI);
		        	    	break;
		        	    }
		        	break;

		        	case 16:
		        	    $localContext = new Context\StmtEmptyContext($localContext);
		        	    $this->enterOuterAlt($localContext, 16);
		        	    $this->setState(177);
		        	    $this->match(self::SEMI);
		        	break;

		        	case 17:
		        	    $localContext = new Context\StmtPtrAssignContext($localContext);
		        	    $this->enterOuterAlt($localContext, 17);
		        	    $this->setState(179); 
		        	    $this->errorHandler->sync($this);

		        	    $_la = $this->input->LA(1);
		        	    do {
		        	    	$this->setState(178);
		        	    	$this->match(self::MUL);
		        	    	$this->setState(181); 
		        	    	$this->errorHandler->sync($this);
		        	    	$_la = $this->input->LA(1);
		        	    } while ($_la === self::MUL);
		        	    $this->setState(183);
		        	    $this->match(self::ID);
		        	    $this->setState(184);
		        	    $this->match(self::ASSIGN);
		        	    $this->setState(185);
		        	    $this->recursiveExpression(0);
		        	    $this->setState(186);
		        	    $this->match(self::SEMI);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function varDecl(): Context\VarDeclContext
		{
		    $localContext = new Context\VarDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 16, self::RULE_varDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(190);
		        $this->match(self::VAR);
		        $this->setState(191);
		        $this->match(self::ID);
		        $this->setState(196);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMMA) {
		        	$this->setState(192);
		        	$this->match(self::COMMA);
		        	$this->setState(193);
		        	$this->match(self::ID);
		        	$this->setState(198);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(199);
		        $this->type();
		        $this->setState(202);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ASSIGN) {
		        	$this->setState(200);
		        	$this->match(self::ASSIGN);
		        	$this->setState(201);
		        	$this->valores();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function constantDecl(): Context\ConstantDeclContext
		{
		    $localContext = new Context\ConstantDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 18, self::RULE_constantDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(204);
		        $this->match(self::CONST);
		        $this->setState(205);
		        $this->match(self::ID);
		        $this->setState(206);
		        $this->type();
		        $this->setState(207);
		        $this->match(self::ASSIGN);
		        $this->setState(208);
		        $this->recursiveExpression(0);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function shortDecl(): Context\ShortDeclContext
		{
		    $localContext = new Context\ShortDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 20, self::RULE_shortDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(210);
		        $this->match(self::ID);
		        $this->setState(215);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMMA) {
		        	$this->setState(211);
		        	$this->match(self::COMMA);
		        	$this->setState(212);
		        	$this->match(self::ID);
		        	$this->setState(217);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(218);
		        $this->match(self::DECL_ASSIGN);
		        $this->setState(219);
		        $this->valores();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function assignment(): Context\AssignmentContext
		{
		    $localContext = new Context\AssignmentContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 22, self::RULE_assignment);

		    try {
		        $this->setState(234);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 29, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\AssignSimpleContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(221);
		        	    $this->match(self::ID);
		        	    $this->setState(226);
		        	    $this->errorHandler->sync($this);

		        	    $_la = $this->input->LA(1);
		        	    while ($_la === self::COMMA) {
		        	    	$this->setState(222);
		        	    	$this->match(self::COMMA);
		        	    	$this->setState(223);
		        	    	$this->match(self::ID);
		        	    	$this->setState(228);
		        	    	$this->errorHandler->sync($this);
		        	    	$_la = $this->input->LA(1);
		        	    }
		        	    $this->setState(229);
		        	    $this->match(self::ASSIGN);
		        	    $this->setState(230);
		        	    $this->valores();
		        	break;

		        	case 2:
		        	    $localContext = new Context\AssignCompoundContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(231);
		        	    $this->match(self::ID);
		        	    $this->setState(232);

		        	    $localContext->op = $this->input->LT(1);
		        	    $_la = $this->input->LA(1);

		        	    if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 16642998272) !== 0))) {
		        	    	    $localContext->op = $this->errorHandler->recoverInline($this);
		        	    } else {
		        	    	if ($this->input->LA(1) === Token::EOF) {
		        	    	    $this->matchedEOF = true;
		        	        }

		        	    	$this->errorHandler->reportMatch($this);
		        	    	$this->consume();
		        	    }
		        	    $this->setState(233);
		        	    $this->recursiveExpression(0);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function increment(): Context\IncrementContext
		{
		    $localContext = new Context\IncrementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 24, self::RULE_increment);

		    try {
		        $localContext = new Context\IncDecContext($localContext);
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(236);
		        $this->match(self::ID);
		        $this->setState(237);

		        $_la = $this->input->LA(1);

		        if (!($_la === self::INC || $_la === self::DEC)) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function printStmt(): Context\PrintStmtContext
		{
		    $localContext = new Context\PrintStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 26, self::RULE_printStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(239);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 4243456) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		        $this->setState(240);
		        $this->match(self::LPAREN);
		        $this->setState(242);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ((((($_la - 13)) & ~0x3f) === 0 && ((1 << ($_la - 13)) & 34914648192990713) !== 0)) {
		        	$this->setState(241);
		        	$this->valores();
		        }
		        $this->setState(244);
		        $this->match(self::RPAREN);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function ifStmt(): Context\IfStmtContext
		{
		    $localContext = new Context\IfStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 28, self::RULE_ifStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(246);
		        $this->match(self::IF);
		        $this->setState(247);
		        $this->recursiveExpression(0);
		        $this->setState(248);
		        $this->block();
		        $this->setState(254);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ELSE) {
		        	$this->setState(249);
		        	$this->match(self::ELSE);
		        	$this->setState(252);
		        	$this->errorHandler->sync($this);

		        	switch ($this->input->LA(1)) {
		        	    case self::IF:
		        	    	$this->setState(250);
		        	    	$this->ifStmt();
		        	    	break;

		        	    case self::LBRACE:
		        	    	$this->setState(251);
		        	    	$this->block();
		        	    	break;

		        	default:
		        		throw new NoViableAltException($this);
		        	}
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function switchStmt(): Context\SwitchStmtContext
		{
		    $localContext = new Context\SwitchStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 30, self::RULE_switchStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(256);
		        $this->match(self::SWITCH);
		        $this->setState(257);
		        $this->recursiveExpression(0);
		        $this->setState(258);
		        $this->match(self::LBRACE);
		        $this->setState(259);
		        $this->switchBlock();
		        $this->setState(260);
		        $this->match(self::RBRACE);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function switchBlock(): Context\SwitchBlockContext
		{
		    $localContext = new Context\SwitchBlockContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 32, self::RULE_switchBlock);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(265);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::CASE) {
		        	$this->setState(262);
		        	$this->caseStmt();
		        	$this->setState(267);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(269);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::DEFAULT) {
		        	$this->setState(268);
		        	$this->defaultStmt();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function caseStmt(): Context\CaseStmtContext
		{
		    $localContext = new Context\CaseStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 34, self::RULE_caseStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(271);
		        $this->match(self::CASE);
		        $this->setState(272);
		        $this->valores();
		        $this->setState(273);
		        $this->match(self::COLON);
		        $this->setState(277);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & -8838876806216941988) !== 0) || (((($_la - 64)) & ~0x3f) === 0 && ((1 << ($_la - 64)) & 15) !== 0)) {
		        	$this->setState(274);
		        	$this->statement();
		        	$this->setState(279);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function defaultStmt(): Context\DefaultStmtContext
		{
		    $localContext = new Context\DefaultStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 36, self::RULE_defaultStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(280);
		        $this->match(self::DEFAULT);
		        $this->setState(281);
		        $this->match(self::COLON);
		        $this->setState(285);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & -8838876806216941988) !== 0) || (((($_la - 64)) & ~0x3f) === 0 && ((1 << ($_la - 64)) & 15) !== 0)) {
		        	$this->setState(282);
		        	$this->statement();
		        	$this->setState(287);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forStmt(): Context\ForStmtContext
		{
		    $localContext = new Context\ForStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 38, self::RULE_forStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(288);
		        $this->match(self::FOR);
		        $this->setState(301);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 39, $this->ctx)) {
		            case 1:
		        	    $this->setState(289);
		        	    $this->recursiveExpression(0);
		        	break;

		            case 2:
		        	    $this->setState(292);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->input->LA(1)) {
		        	        case self::VAR:
		        	        	$this->setState(290);
		        	        	$this->varDecl();
		        	        	break;

		        	        case self::ID:
		        	        	$this->setState(291);
		        	        	$this->shortDecl();
		        	        	break;

		        	    default:
		        	    	throw new NoViableAltException($this);
		        	    }
		        	    $this->setState(294);
		        	    $this->match(self::SEMI);
		        	    $this->setState(295);
		        	    $this->recursiveExpression(0);
		        	    $this->setState(296);
		        	    $this->match(self::SEMI);
		        	    $this->setState(299);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 38, $this->ctx)) {
		        	    	case 1:
		        	    	    $this->setState(297);
		        	    	    $this->assignment();
		        	    	break;

		        	    	case 2:
		        	    	    $this->setState(298);
		        	    	    $this->increment();
		        	    	break;
		        	    }
		        	break;
		        }
		        $this->setState(303);
		        $this->block();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function breakStmt(): Context\BreakStmtContext
		{
		    $localContext = new Context\BreakStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 40, self::RULE_breakStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(305);
		        $this->match(self::BREAK);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function continueStmt(): Context\ContinueStmtContext
		{
		    $localContext = new Context\ContinueStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 42, self::RULE_continueStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(307);
		        $this->match(self::CONTIN);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function returnStmt(): Context\ReturnStmtContext
		{
		    $localContext = new Context\ReturnStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 44, self::RULE_returnStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(309);
		        $this->match(self::RETURN);
		        $this->setState(311);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 40, $this->ctx)) {
		            case 1:
		        	    $this->setState(310);
		        	    $this->valores();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayAssignment(): Context\ArrayAssignmentContext
		{
		    $localContext = new Context\ArrayAssignmentContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 46, self::RULE_arrayAssignment);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(313);
		        $this->match(self::ID);
		        $this->setState(318); 
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        do {
		        	$this->setState(314);
		        	$this->match(self::LBRACK);
		        	$this->setState(315);
		        	$this->recursiveExpression(0);
		        	$this->setState(316);
		        	$this->match(self::RBRACK);
		        	$this->setState(320); 
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        } while ($_la === self::LBRACK);
		        $this->setState(322);
		        $this->match(self::ASSIGN);
		        $this->setState(323);
		        $this->recursiveExpression(0);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expression(): Context\ExpressionContext
		{
			return $this->recursiveExpression(0);
		}

		/**
		 * @throws RecognitionException
		 */
		private function recursiveExpression(int $precedence): Context\ExpressionContext
		{
			$parentContext = $this->ctx;
			$parentState = $this->getState();
			$localContext = new Context\ExpressionContext($this->ctx, $parentState);
			$previousContext = $localContext;
			$startState = 48;
			$this->enterRecursionRule($localContext, 48, self::RULE_expression, $precedence);

			try {
				$this->enterOuterAlt($localContext, 1);
				$this->setState(355);
				$this->errorHandler->sync($this);

				switch ($this->getInterpreter()->adaptivePredict($this->input, 45, $this->ctx)) {
					case 1:
					    $localContext = new Context\ExprParenthesisContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;

					    $this->setState(326);
					    $this->match(self::LPAREN);
					    $this->setState(327);
					    $this->recursiveExpression(0);
					    $this->setState(328);
					    $this->match(self::RPAREN);
					break;

					case 2:
					    $localContext = new Context\ExprNotContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(330);
					    $this->match(self::NOT);
					    $this->setState(331);
					    $this->recursiveExpression(19);
					break;

					case 3:
					    $localContext = new Context\ExprNegateContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(332);
					    $this->match(self::MINUS);
					    $this->setState(333);
					    $this->recursiveExpression(18);
					break;

					case 4:
					    $localContext = new Context\ExprArrayLitContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(334);
					    $this->arrayLiteral();
					break;

					case 5:
					    $localContext = new Context\ExprInlineArrayContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(335);
					    $this->match(self::LBRACE);
					    $this->setState(340);
					    $this->errorHandler->sync($this);
					    $_la = $this->input->LA(1);

					    if ((((($_la - 13)) & ~0x3f) === 0 && ((1 << ($_la - 13)) & 34914648192990713) !== 0)) {
					    	$this->setState(336);
					    	$this->valores();
					    	$this->setState(338);
					    	$this->errorHandler->sync($this);
					    	$_la = $this->input->LA(1);

					    	if ($_la === self::COMMA) {
					    		$this->setState(337);
					    		$this->match(self::COMMA);
					    	}
					    }
					    $this->setState(342);
					    $this->match(self::RBRACE);
					break;

					case 6:
					    $localContext = new Context\ExprAddrContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(343);
					    $this->match(self::AMP);
					    $this->setState(344);
					    $this->match(self::ID);
					break;

					case 7:
					    $localContext = new Context\ExprDerefContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(345);
					    $this->match(self::MUL);
					    $this->setState(346);
					    $this->recursiveExpression(14);
					break;

					case 8:
					    $localContext = new Context\ExprBuiltInContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(347);

					    $_la = $this->input->LA(1);

					    if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 125829120) !== 0))) {
					    $this->errorHandler->recoverInline($this);
					    } else {
					    	if ($this->input->LA(1) === Token::EOF) {
					    	    $this->matchedEOF = true;
					        }

					    	$this->errorHandler->reportMatch($this);
					    	$this->consume();
					    }
					    $this->setState(348);
					    $this->match(self::LPAREN);
					    $this->setState(350);
					    $this->errorHandler->sync($this);
					    $_la = $this->input->LA(1);

					    if ((((($_la - 13)) & ~0x3f) === 0 && ((1 << ($_la - 13)) & 34914648192990713) !== 0)) {
					    	$this->setState(349);
					    	$this->valores();
					    }
					    $this->setState(352);
					    $this->match(self::RPAREN);
					break;

					case 9:
					    $localContext = new Context\ExprIdContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(353);
					    $this->match(self::ID);
					break;

					case 10:
					    $localContext = new Context\ExprLiteralContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(354);
					    $this->literal();
					break;
				}
				$this->ctx->stop = $this->input->LT(-1);
				$this->setState(397);
				$this->errorHandler->sync($this);

				$alt = $this->getInterpreter()->adaptivePredict($this->input, 48, $this->ctx);

				while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
					if ($alt === 1) {
						if ($this->getParseListeners() !== null) {
						    $this->triggerExitRuleEvent();
						}

						$previousContext = $localContext;
						$this->setState(395);
						$this->errorHandler->sync($this);

						switch ($this->getInterpreter()->adaptivePredict($this->input, 47, $this->ctx)) {
							case 1:
							    $localContext = new Context\ExprMulDivContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(357);

							    if (!($this->precpred($this->ctx, 11))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 11)");
							    }
							    $this->setState(358);

							    $_la = $this->input->LA(1);

							    if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1924145348608) !== 0))) {
							    $this->errorHandler->recoverInline($this);
							    } else {
							    	if ($this->input->LA(1) === Token::EOF) {
							    	    $this->matchedEOF = true;
							        }

							    	$this->errorHandler->reportMatch($this);
							    	$this->consume();
							    }
							    $this->setState(359);
							    $this->recursiveExpression(12);
							break;

							case 2:
							    $localContext = new Context\ExprAddSubContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(360);

							    if (!($this->precpred($this->ctx, 10))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 10)");
							    }
							    $this->setState(361);

							    $_la = $this->input->LA(1);

							    if (!($_la === self::PLUS || $_la === self::MINUS)) {
							    $this->errorHandler->recoverInline($this);
							    } else {
							    	if ($this->input->LA(1) === Token::EOF) {
							    	    $this->matchedEOF = true;
							        }

							    	$this->errorHandler->reportMatch($this);
							    	$this->consume();
							    }
							    $this->setState(362);
							    $this->recursiveExpression(11);
							break;

							case 3:
							    $localContext = new Context\ExprRelationalContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(363);

							    if (!($this->precpred($this->ctx, 9))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 9)");
							    }
							    $this->setState(364);

							    $_la = $this->input->LA(1);

							    if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 131941395333120) !== 0))) {
							    $this->errorHandler->recoverInline($this);
							    } else {
							    	if ($this->input->LA(1) === Token::EOF) {
							    	    $this->matchedEOF = true;
							        }

							    	$this->errorHandler->reportMatch($this);
							    	$this->consume();
							    }
							    $this->setState(365);
							    $this->recursiveExpression(10);
							break;

							case 4:
							    $localContext = new Context\ExprEqualityContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(366);

							    if (!($this->precpred($this->ctx, 8))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 8)");
							    }
							    $this->setState(367);

							    $_la = $this->input->LA(1);

							    if (!($_la === self::EQ || $_la === self::NEQ)) {
							    $this->errorHandler->recoverInline($this);
							    } else {
							    	if ($this->input->LA(1) === Token::EOF) {
							    	    $this->matchedEOF = true;
							        }

							    	$this->errorHandler->reportMatch($this);
							    	$this->consume();
							    }
							    $this->setState(368);
							    $this->recursiveExpression(9);
							break;

							case 5:
							    $localContext = new Context\ExprAndContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(369);

							    if (!($this->precpred($this->ctx, 7))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 7)");
							    }
							    $this->setState(370);
							    $this->match(self::AND);
							    $this->setState(371);
							    $this->recursiveExpression(8);
							break;

							case 6:
							    $localContext = new Context\ExprOrContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(372);

							    if (!($this->precpred($this->ctx, 6))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 6)");
							    }
							    $this->setState(373);
							    $this->match(self::OR);
							    $this->setState(374);
							    $this->recursiveExpression(7);
							break;

							case 7:
							    $localContext = new Context\ExprPipeContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(375);

							    if (!($this->precpred($this->ctx, 5))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 5)");
							    }
							    $this->setState(376);
							    $this->match(self::PIPE);
							    $this->setState(377);
							    $this->recursiveExpression(6);
							break;

							case 8:
							    $localContext = new Context\ExprTernaryContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(378);

							    if (!($this->precpred($this->ctx, 4))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 4)");
							    }
							    $this->setState(379);
							    $this->match(self::QUESTION);
							    $this->setState(380);
							    $this->recursiveExpression(0);
							    $this->setState(381);
							    $this->match(self::COLON);
							    $this->setState(382);
							    $this->recursiveExpression(5);
							break;

							case 9:
							    $localContext = new Context\ExprArrayAccessContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(384);

							    if (!($this->precpred($this->ctx, 13))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 13)");
							    }
							    $this->setState(385);
							    $this->match(self::LBRACK);
							    $this->setState(386);
							    $this->recursiveExpression(0);
							    $this->setState(387);
							    $this->match(self::RBRACK);
							break;

							case 10:
							    $localContext = new Context\ExprCallContext(new Context\ExpressionContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expression);
							    $this->setState(389);

							    if (!($this->precpred($this->ctx, 12))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 12)");
							    }
							    $this->setState(390);
							    $this->match(self::LPAREN);
							    $this->setState(392);
							    $this->errorHandler->sync($this);
							    $_la = $this->input->LA(1);

							    if ((((($_la - 13)) & ~0x3f) === 0 && ((1 << ($_la - 13)) & 34914648192990713) !== 0)) {
							    	$this->setState(391);
							    	$this->valores();
							    }
							    $this->setState(394);
							    $this->match(self::RPAREN);
							break;
						} 
					}

					$this->setState(399);
					$this->errorHandler->sync($this);

					$alt = $this->getInterpreter()->adaptivePredict($this->input, 48, $this->ctx);
				}
			} catch (RecognitionException $exception) {
				$localContext->exception = $exception;
				$this->errorHandler->reportError($this, $exception);
				$this->errorHandler->recover($this, $exception);
			} finally {
				$this->unrollRecursionContexts($parentContext);
			}

			return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function valores(): Context\ValoresContext
		{
		    $localContext = new Context\ValoresContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 50, self::RULE_valores);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(400);
		        $this->recursiveExpression(0);
		        $this->setState(405);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 49, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(401);
		        		$this->match(self::COMMA);
		        		$this->setState(402);
		        		$this->recursiveExpression(0); 
		        	}

		        	$this->setState(407);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 49, $this->ctx);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function type(): Context\TypeContext
		{
		    $localContext = new Context\TypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 52, self::RULE_type);

		    try {
		        $this->setState(424);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 50, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(408);
		        	    $this->match(self::INT32);
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(409);
		        	    $this->match(self::FLOAT32);
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(410);
		        	    $this->match(self::BOOL);
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(411);
		        	    $this->match(self::RUNE);
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(412);
		        	    $this->match(self::STRING);
		        	break;

		        	case 6:
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(413);
		        	    $this->match(self::MUL);
		        	    $this->setState(414);
		        	    $this->type();
		        	break;

		        	case 7:
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(415);
		        	    $this->match(self::LBRACK);
		        	    $this->setState(416);
		        	    $this->recursiveExpression(0);
		        	    $this->setState(417);
		        	    $this->match(self::RBRACK);
		        	    $this->setState(418);
		        	    $this->type();
		        	break;

		        	case 8:
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(420);
		        	    $this->match(self::LBRACK);
		        	    $this->setState(421);
		        	    $this->match(self::RBRACK);
		        	    $this->setState(422);
		        	    $this->type();
		        	break;

		        	case 9:
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(423);
		        	    $this->match(self::ID);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function literal(): Context\LiteralContext
		{
		    $localContext = new Context\LiteralContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 54, self::RULE_literal);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(426);

		        $_la = $this->input->LA(1);

		        if (!((((($_la - 13)) & ~0x3f) === 0 && ((1 << ($_la - 13)) & 33776997205278977) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function arrayLiteral(): Context\ArrayLiteralContext
		{
		    $localContext = new Context\ArrayLiteralContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 56, self::RULE_arrayLiteral);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(428);
		        $this->type();
		        $this->setState(429);
		        $this->match(self::LBRACE);
		        $this->setState(434);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ((((($_la - 13)) & ~0x3f) === 0 && ((1 << ($_la - 13)) & 34914648192990713) !== 0)) {
		        	$this->setState(430);
		        	$this->valores();
		        	$this->setState(432);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);

		        	if ($_la === self::COMMA) {
		        		$this->setState(431);
		        		$this->match(self::COMMA);
		        	}
		        }
		        $this->setState(436);
		        $this->match(self::RBRACE);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		public function sempred(?RuleContext $localContext, int $ruleIndex, int $predicateIndex): bool
		{
			switch ($ruleIndex) {
					case 24:
						return $this->sempredExpression($localContext, $predicateIndex);

				default:
					return true;
				}
		}

		private function sempredExpression(?Context\ExpressionContext $localContext, int $predicateIndex): bool
		{
			switch ($predicateIndex) {
			    case 0:
			        return $this->precpred($this->ctx, 11);

			    case 1:
			        return $this->precpred($this->ctx, 10);

			    case 2:
			        return $this->precpred($this->ctx, 9);

			    case 3:
			        return $this->precpred($this->ctx, 8);

			    case 4:
			        return $this->precpred($this->ctx, 7);

			    case 5:
			        return $this->precpred($this->ctx, 6);

			    case 6:
			        return $this->precpred($this->ctx, 5);

			    case 7:
			        return $this->precpred($this->ctx, 4);

			    case 8:
			        return $this->precpred($this->ctx, 13);

			    case 9:
			        return $this->precpred($this->ctx, 12);
			}

			return true;
		}
	}
}

namespace Context {
	use Antlr\Antlr4\Runtime\ParserRuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;
	use Antlr\Antlr4\Runtime\Tree\TerminalNode;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
	use GolampiParser;
	use GolampiVisitor;
	use GolampiListener;

	class StartContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_start;
	    }

	    public function EOF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::EOF, 0);
	    }

	    /**
	     * @return array<TopDeclContext>|TopDeclContext|null
	     */
	    public function topDecl(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(TopDeclContext::class);
	    	}

	        return $this->getTypedRuleContext(TopDeclContext::class, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStart($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStart($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStart($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class TopDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_topDecl;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class DeclGlobalVarContext extends TopDeclContext
	{
		public function __construct(TopDeclContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function varDecl(): ?VarDeclContext
	    {
	    	return $this->getTypedRuleContext(VarDeclContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterDeclGlobalVar($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitDeclGlobalVar($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDeclGlobalVar($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class DeclFunctionContext extends TopDeclContext
	{
		public function __construct(TopDeclContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function functionDecl(): ?FunctionDeclContext
	    {
	    	return $this->getTypedRuleContext(FunctionDeclContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterDeclFunction($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitDeclFunction($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDeclFunction($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class DeclGlobalConstContext extends TopDeclContext
	{
		public function __construct(TopDeclContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function constantDecl(): ?ConstantDeclContext
	    {
	    	return $this->getTypedRuleContext(ConstantDeclContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterDeclGlobalConst($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitDeclGlobalConst($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDeclGlobalConst($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FunctionDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_functionDecl;
	    }

	    public function FUNC(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FUNC, 0);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LPAREN, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RPAREN, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function paramList(): ?ParamListContext
	    {
	    	return $this->getTypedRuleContext(ParamListContext::class, 0);
	    }

	    public function returnTypes(): ?ReturnTypesContext
	    {
	    	return $this->getTypedRuleContext(ReturnTypesContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterFunctionDecl($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitFunctionDecl($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitFunctionDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ReturnTypesContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_returnTypes;
	    }

	    /**
	     * @return array<TypeContext>|TypeContext|null
	     */
	    public function type(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(TypeContext::class);
	    	}

	        return $this->getTypedRuleContext(TypeContext::class, $index);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LPAREN, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RPAREN, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterReturnTypes($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitReturnTypes($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitReturnTypes($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParamListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_paramList;
	    }

	    /**
	     * @return array<ParametroContext>|ParametroContext|null
	     */
	    public function parametro(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ParametroContext::class);
	    	}

	        return $this->getTypedRuleContext(ParametroContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterParamList($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitParamList($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitParamList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParametroContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_parametro;
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterParametro($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitParametro($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitParametro($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BlockContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_block;
	    }

	    public function LBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LBRACE, 0);
	    }

	    public function RBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RBRACE, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterBlock($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitBlock($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBlock($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class StatementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_statement;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class StmtReturnContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function returnStmt(): ?ReturnStmtContext
	    {
	    	return $this->getTypedRuleContext(ReturnStmtContext::class, 0);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmtReturn($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmtReturn($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmtReturn($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StmtContinueContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function continueStmt(): ?ContinueStmtContext
	    {
	    	return $this->getTypedRuleContext(ContinueStmtContext::class, 0);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmtContinue($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmtContinue($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmtContinue($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StmtBlockContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmtBlock($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmtBlock($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmtBlock($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StmtArrayAssignContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function arrayAssignment(): ?ArrayAssignmentContext
	    {
	    	return $this->getTypedRuleContext(ArrayAssignmentContext::class, 0);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmtArrayAssign($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmtArrayAssign($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmtArrayAssign($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StmtExprContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmtExpr($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmtExpr($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmtExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StmtPrintContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function printStmt(): ?PrintStmtContext
	    {
	    	return $this->getTypedRuleContext(PrintStmtContext::class, 0);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmtPrint($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmtPrint($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmtPrint($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StmtForContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function forStmt(): ?ForStmtContext
	    {
	    	return $this->getTypedRuleContext(ForStmtContext::class, 0);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmtFor($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmtFor($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmtFor($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StmtAssignContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function assignment(): ?AssignmentContext
	    {
	    	return $this->getTypedRuleContext(AssignmentContext::class, 0);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmtAssign($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmtAssign($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmtAssign($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StmtConstContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function constantDecl(): ?ConstantDeclContext
	    {
	    	return $this->getTypedRuleContext(ConstantDeclContext::class, 0);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmtConst($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmtConst($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmtConst($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StmtVarContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function varDecl(): ?VarDeclContext
	    {
	    	return $this->getTypedRuleContext(VarDeclContext::class, 0);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmtVar($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmtVar($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmtVar($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StmtShortDeclContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function shortDecl(): ?ShortDeclContext
	    {
	    	return $this->getTypedRuleContext(ShortDeclContext::class, 0);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmtShortDecl($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmtShortDecl($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmtShortDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StmIncrementContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function increment(): ?IncrementContext
	    {
	    	return $this->getTypedRuleContext(IncrementContext::class, 0);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmIncrement($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmIncrement($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmIncrement($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StmtEmptyContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmtEmpty($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmtEmpty($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmtEmpty($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StmtSwitchContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function switchStmt(): ?SwitchStmtContext
	    {
	    	return $this->getTypedRuleContext(SwitchStmtContext::class, 0);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmtSwitch($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmtSwitch($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmtSwitch($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StmtIfContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmtIf($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmtIf($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmtIf($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StmtPtrAssignContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ASSIGN, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function MUL(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::MUL);
	    	}

	        return $this->getToken(GolampiParser::MUL, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmtPtrAssign($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmtPtrAssign($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmtPtrAssign($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StmtBreakContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function breakStmt(): ?BreakStmtContext
	    {
	    	return $this->getTypedRuleContext(BreakStmtContext::class, 0);
	    }

	    public function SEMI(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SEMI, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterStmtBreak($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitStmtBreak($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitStmtBreak($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class VarDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_varDecl;
	    }

	    public function VAR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::VAR, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ID(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::ID);
	    	}

	        return $this->getToken(GolampiParser::ID, $index);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

	    public function ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ASSIGN, 0);
	    }

	    public function valores(): ?ValoresContext
	    {
	    	return $this->getTypedRuleContext(ValoresContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterVarDecl($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitVarDecl($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitVarDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ConstantDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_constantDecl;
	    }

	    public function CONST(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CONST, 0);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ASSIGN, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterConstantDecl($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitConstantDecl($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitConstantDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ShortDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_shortDecl;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ID(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::ID);
	    	}

	        return $this->getToken(GolampiParser::ID, $index);
	    }

	    public function DECL_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DECL_ASSIGN, 0);
	    }

	    public function valores(): ?ValoresContext
	    {
	    	return $this->getTypedRuleContext(ValoresContext::class, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterShortDecl($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitShortDecl($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitShortDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AssignmentContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_assignment;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class AssignCompoundContext extends AssignmentContext
	{
		/**
		 * @var Token|null $op
		 */
		public $op;

		public function __construct(AssignmentContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function PLUS_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PLUS_ASSIGN, 0);
	    }

	    public function MINUS_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MINUS_ASSIGN, 0);
	    }

	    public function MUL_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MUL_ASSIGN, 0);
	    }

	    public function DIV_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DIV_ASSIGN, 0);
	    }

	    public function MOD_ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MOD_ASSIGN, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterAssignCompound($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitAssignCompound($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitAssignCompound($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class AssignSimpleContext extends AssignmentContext
	{
		public function __construct(AssignmentContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ID(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::ID);
	    	}

	        return $this->getToken(GolampiParser::ID, $index);
	    }

	    public function ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ASSIGN, 0);
	    }

	    public function valores(): ?ValoresContext
	    {
	    	return $this->getTypedRuleContext(ValoresContext::class, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterAssignSimple($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitAssignSimple($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitAssignSimple($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IncrementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_increment;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class IncDecContext extends IncrementContext
	{
		public function __construct(IncrementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function INC(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::INC, 0);
	    }

	    public function DEC(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DEC, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterIncDec($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitIncDec($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIncDec($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class PrintStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_printStmt;
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LPAREN, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RPAREN, 0);
	    }

	    public function PRINT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PRINT, 0);
	    }

	    public function PRINTLN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PRINTLN, 0);
	    }

	    public function FMT_PRINTLN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FMT_PRINTLN, 0);
	    }

	    public function valores(): ?ValoresContext
	    {
	    	return $this->getTypedRuleContext(ValoresContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterPrintStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitPrintStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitPrintStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IfStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_ifStmt;
	    }

	    public function IF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IF, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    /**
	     * @return array<BlockContext>|BlockContext|null
	     */
	    public function block(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(BlockContext::class);
	    	}

	        return $this->getTypedRuleContext(BlockContext::class, $index);
	    }

	    public function ELSE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ELSE, 0);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterIfStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitIfStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIfStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SwitchStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_switchStmt;
	    }

	    public function SWITCH(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SWITCH, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function LBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LBRACE, 0);
	    }

	    public function switchBlock(): ?SwitchBlockContext
	    {
	    	return $this->getTypedRuleContext(SwitchBlockContext::class, 0);
	    }

	    public function RBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RBRACE, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterSwitchStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitSwitchStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitSwitchStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SwitchBlockContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_switchBlock;
	    }

	    /**
	     * @return array<CaseStmtContext>|CaseStmtContext|null
	     */
	    public function caseStmt(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(CaseStmtContext::class);
	    	}

	        return $this->getTypedRuleContext(CaseStmtContext::class, $index);
	    }

	    public function defaultStmt(): ?DefaultStmtContext
	    {
	    	return $this->getTypedRuleContext(DefaultStmtContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterSwitchBlock($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitSwitchBlock($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitSwitchBlock($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class CaseStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_caseStmt;
	    }

	    public function CASE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CASE, 0);
	    }

	    public function valores(): ?ValoresContext
	    {
	    	return $this->getTypedRuleContext(ValoresContext::class, 0);
	    }

	    public function COLON(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::COLON, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterCaseStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitCaseStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitCaseStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DefaultStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_defaultStmt;
	    }

	    public function DEFAULT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DEFAULT, 0);
	    }

	    public function COLON(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::COLON, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterDefaultStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitDefaultStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDefaultStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_forStmt;
	    }

	    public function FOR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FOR, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function SEMI(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::SEMI);
	    	}

	        return $this->getToken(GolampiParser::SEMI, $index);
	    }

	    public function varDecl(): ?VarDeclContext
	    {
	    	return $this->getTypedRuleContext(VarDeclContext::class, 0);
	    }

	    public function shortDecl(): ?ShortDeclContext
	    {
	    	return $this->getTypedRuleContext(ShortDeclContext::class, 0);
	    }

	    public function assignment(): ?AssignmentContext
	    {
	    	return $this->getTypedRuleContext(AssignmentContext::class, 0);
	    }

	    public function increment(): ?IncrementContext
	    {
	    	return $this->getTypedRuleContext(IncrementContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterForStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitForStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitForStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BreakStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_breakStmt;
	    }

	    public function BREAK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::BREAK, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterBreakStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitBreakStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBreakStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ContinueStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_continueStmt;
	    }

	    public function CONTIN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CONTIN, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterContinueStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitContinueStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitContinueStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ReturnStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_returnStmt;
	    }

	    public function RETURN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RETURN, 0);
	    }

	    public function valores(): ?ValoresContext
	    {
	    	return $this->getTypedRuleContext(ValoresContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterReturnStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitReturnStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitReturnStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayAssignmentContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_arrayAssignment;
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

	    public function ASSIGN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ASSIGN, 0);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function LBRACK(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::LBRACK);
	    	}

	        return $this->getToken(GolampiParser::LBRACK, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function RBRACK(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::RBRACK);
	    	}

	        return $this->getToken(GolampiParser::RBRACK, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterArrayAssignment($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitArrayAssignment($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArrayAssignment($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpressionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_expression;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class ExprTernaryContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function QUESTION(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::QUESTION, 0);
	    }

	    public function COLON(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::COLON, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprTernary($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprTernary($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprTernary($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprAddrContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function AMP(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::AMP, 0);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprAddr($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprAddr($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprAddr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprArrayLitContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function arrayLiteral(): ?ArrayLiteralContext
	    {
	    	return $this->getTypedRuleContext(ArrayLiteralContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprArrayLit($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprArrayLit($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprArrayLit($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprBuiltInContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LPAREN, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RPAREN, 0);
	    }

	    public function LEN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LEN, 0);
	    }

	    public function NOW(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NOW, 0);
	    }

	    public function SUBSTR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SUBSTR, 0);
	    }

	    public function TYPEOF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::TYPEOF, 0);
	    }

	    public function valores(): ?ValoresContext
	    {
	    	return $this->getTypedRuleContext(ValoresContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprBuiltIn($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprBuiltIn($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprBuiltIn($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprPipeContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function PIPE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PIPE, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprPipe($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprPipe($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprPipe($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprParenthesisContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LPAREN, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RPAREN, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprParenthesis($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprParenthesis($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprParenthesis($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprNotContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function NOT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NOT, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprNot($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprNot($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprNot($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprRelationalContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function LT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LT, 0);
	    }

	    public function GT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::GT, 0);
	    }

	    public function LE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LE, 0);
	    }

	    public function GE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::GE, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprRelational($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprRelational($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprRelational($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprAddSubContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function PLUS(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PLUS, 0);
	    }

	    public function MINUS(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MINUS, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprAddSub($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprAddSub($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprAddSub($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprAndContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function AND(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::AND, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprAnd($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprAnd($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprAnd($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprArrayAccessContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function LBRACK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LBRACK, 0);
	    }

	    public function RBRACK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RBRACK, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprArrayAccess($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprArrayAccess($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprArrayAccess($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprCallContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LPAREN, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RPAREN, 0);
	    }

	    public function valores(): ?ValoresContext
	    {
	    	return $this->getTypedRuleContext(ValoresContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprCall($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprCall($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprCall($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprDerefContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function MUL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MUL, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprDeref($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprDeref($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprDeref($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprInlineArrayContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function LBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LBRACE, 0);
	    }

	    public function RBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RBRACE, 0);
	    }

	    public function valores(): ?ValoresContext
	    {
	    	return $this->getTypedRuleContext(ValoresContext::class, 0);
	    }

	    public function COMMA(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::COMMA, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprInlineArray($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprInlineArray($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprInlineArray($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprMulDivContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function MUL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MUL, 0);
	    }

	    public function DIV(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DIV, 0);
	    }

	    public function MOD(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MOD, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprMulDiv($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprMulDiv($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprMulDiv($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprNegateContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function MINUS(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MINUS, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprNegate($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprNegate($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprNegate($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprOrContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function OR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::OR, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprOr($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprOr($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprOr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprLiteralContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function literal(): ?LiteralContext
	    {
	    	return $this->getTypedRuleContext(LiteralContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprLiteral($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprLiteral($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprEqualityContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    public function EQ(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::EQ, 0);
	    }

	    public function NEQ(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NEQ, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprEquality($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprEquality($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprEquality($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprIdContext extends ExpressionContext
	{
		public function __construct(ExpressionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExprId($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExprId($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExprId($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ValoresContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_valores;
	    }

	    /**
	     * @return array<ExpressionContext>|ExpressionContext|null
	     */
	    public function expression(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpressionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpressionContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMMA);
	    	}

	        return $this->getToken(GolampiParser::COMMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterValores($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitValores($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitValores($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class TypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_type;
	    }

	    public function INT32(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::INT32, 0);
	    }

	    public function FLOAT32(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FLOAT32, 0);
	    }

	    public function BOOL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::BOOL, 0);
	    }

	    public function RUNE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RUNE, 0);
	    }

	    public function STRING(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::STRING, 0);
	    }

	    public function MUL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MUL, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function LBRACK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LBRACK, 0);
	    }

	    public function expression(): ?ExpressionContext
	    {
	    	return $this->getTypedRuleContext(ExpressionContext::class, 0);
	    }

	    public function RBRACK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RBRACK, 0);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ID, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterType($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitType($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class LiteralContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_literal;
	    }

	    public function ENTERO(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ENTERO, 0);
	    }

	    public function DECIMAL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DECIMAL, 0);
	    }

	    public function RUNE_LITERAL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RUNE_LITERAL, 0);
	    }

	    public function STRING_LITERAL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::STRING_LITERAL, 0);
	    }

	    public function BOOL_LIT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::BOOL_LIT, 0);
	    }

	    public function NIL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NIL, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterLiteral($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitLiteral($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArrayLiteralContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_arrayLiteral;
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function LBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LBRACE, 0);
	    }

	    public function RBRACE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RBRACE, 0);
	    }

	    public function valores(): ?ValoresContext
	    {
	    	return $this->getTypedRuleContext(ValoresContext::class, 0);
	    }

	    public function COMMA(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::COMMA, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterArrayLiteral($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitArrayLiteral($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArrayLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 
}