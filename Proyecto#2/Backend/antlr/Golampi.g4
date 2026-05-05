grammar Golampi;

start:   topDecl * EOF ;

topDecl
    :   functionDecl    # DeclFunction
    |   varDecl         # DeclGlobalVar
    |   constantDecl    # DeclGlobalConst
    ;

functionDecl
    :   FUNC ID LPAREN paramList? RPAREN returnTypes? block
    ;

returnTypes
    :   type 
    |   LPAREN type (COMMA type) * RPAREN
    ;

paramList
    : parametro (COMMA parametro)*
    ;

parametro
    : ID type
    ;

block
    :   LBRACE statement* RBRACE
    ;

statement
    :   varDecl ';'?                    # StmtVar
    |   constantDecl ';'?               # StmtConst
    |   shortDecl ';'?                  # StmtShortDecl
    |   assignment ';'?                 # StmtAssign
    |   increment ';'?                  # StmIncrement
    |   printStmt ';'?                  # StmtPrint
    |   ifStmt ';'?                     # StmtIf
    |   switchStmt ';'?                 # StmtSwitch
    |   forStmt ';'?                    # StmtFor
    |   breakStmt ';'?                  # StmtBreak
    |   continueStmt ';'?               # StmtContinue
    |   block ';'?                      # StmtBlock
    |   returnStmt ';'?                 # StmtReturn
    |   arrayAssignment ';'?            # StmtArrayAssign
    |   expression ';'?                 # StmtExpr
    |   ';'                             # StmtEmpty
    |   '*' + ID '=' expression ';'     # StmtPtrAssign
    ;

varDecl
    :   VAR ID (COMMA ID)* type (ASSIGN valores)?
    ;

constantDecl
    :   CONST ID type ASSIGN expression 
    ;

shortDecl 
    :   ID (COMMA ID)* DECL_ASSIGN valores
    ;

assignment
    :   ID (COMMA ID)* ASSIGN valores                                                            # AssignSimple   
    |   ID op=(PLUS_ASSIGN | MINUS_ASSIGN | MUL_ASSIGN | DIV_ASSIGN | MOD_ASSIGN) expression     # AssignCompound
    ;

increment
    :   ID (INC | DEC)                                                                           # IncDec
    ;

printStmt
    :   ( PRINT | PRINTLN | FMT_PRINTLN) LPAREN valores? RPAREN
    ;

ifStmt
    :   IF expression block (ELSE (ifStmt | block))?
    ;


switchStmt
    :   SWITCH  expression  LBRACE switchBlock RBRACE
    ;

switchBlock
    :   caseStmt* defaultStmt?
    ;

caseStmt
    :   CASE  valores COLON statement*
    ;

defaultStmt
    :   DEFAULT COLON statement*
    ;

forStmt
    :   FOR ( expression 
            | (varDecl | shortDecl) SEMI expression SEMI (assignment | increment)
        )?  block
    ;

breakStmt
    :   BREAK 
    ;

continueStmt
    :   CONTIN
    ;

returnStmt
    :   RETURN valores?
    ;

arrayAssignment
    :   ID (LBRACK expression RBRACK)+ ASSIGN expression
    ;

expression
    :   LPAREN expression RPAREN                                # ExprParenthesis
    |   NOT expression                                          # ExprNot
    |   MINUS expression                                        # ExprNegate
    |   arrayLiteral                                            # ExprArrayLit
    |   LBRACE (valores COMMA?)? RBRACE                         # ExprInlineArray
    |   '&' ID                                                  # ExprAddr
    |   '*' expression                                          # ExprDeref
    |   expression LBRACK expression RBRACK                     # ExprArrayAccess
    |   expression LPAREN valores? RPAREN                       # ExprCall
    |   expression (MUL | DIV | MOD) expression                 # ExprMulDiv
    |   expression (PLUS |  MINUS)  expression                  # ExprAddSub
    |   expression (LT | GT | LE | GE) expression               # ExprRelational
    |   expression (EQ | NEQ) expression                        # ExprEquality
    |   expression AND expression                               # ExprAnd
    |   expression OR expression                                # ExprOr
    |   expression PIPE expression                              # ExprPipe
    |   expression QUESTION expression COLON expression         # ExprTernary
    |   (LEN | NOW | SUBSTR | TYPEOF) LPAREN valores? RPAREN    # ExprBuiltIn
    |   ID                                                      # ExprId
    |   literal                                                 # ExprLiteral
    ;

valores
    :   expression (COMMA expression)*
    ;

type
    :   INT32
    |   FLOAT32
    |   BOOL
    |   RUNE
    |   STRING
    |   '*' type
    |   LBRACK expression RBRACK type
    |   LBRACK RBRACK type
    |   ID
    ;

literal
    :   ENTERO
    |   DECIMAL
    |   RUNE_LITERAL
    |   STRING_LITERAL
    |   BOOL_LIT
    |   NIL
    ;

arrayLiteral
    :   type LBRACE (valores COMMA?)? RBRACE
    ;

// PALABRAS RESERVADAS
// ======================================================================

FUNC    :   'func';
VAR     :   'var';
CONST   :   'const';
IF      :   'if';
ELSE    :   'else';
SWITCH  :   'switch';
CASE    :   'case'; 
DEFAULT :   'default';
FOR     :   'for';
BREAK   :   'break';
CONTIN  :   'continue';
RETURN  :   'return';
NIL     :   'nil';
PRINT   :   'print';
PRINTLN :   'println';

// TIPOS
// ======================================================================

INT32   : 'int32';
FLOAT32 : 'float32';
BOOL    : 'bool';
RUNE    : 'rune';
STRING  : 'string';

// BOOLEANOS
// ======================================================================

BOOL_LIT    :   'true'  | 'false';

// FUNCIONES EMBEIDAS   

FMT_PRINTLN :   'fmt.Println';
LEN         :   'len';
NOW         :   'now';
SUBSTR      :   'substr';
TYPEOF      :   'typeOf';

// OPERADORES Y PUNTUACIÓN
// ======================================================================

ASSIGN      :   '='     ;
DECL_ASSIGN :   ':='    ;
PLUS_ASSIGN :   '+='    ;
MINUS_ASSIGN:   '-='    ;
MUL_ASSIGN :   '*='    ;
DIV_ASSIGN  :   '/='    ;
MOD_ASSIGN  :   '%='    ;
INC         :   '++'    ;
DEC         :   '--'    ;

PLUS        :   '+'     ;
MINUS       :   '-'     ;
MUL         :   '*'     ;
DIV         :   '/'     ;
MOD         :   '%'     ;

EQ          :   '=='    ;
NEQ         :   '!='    ;
LT          :   '<'     ;
LE          :   '<='    ;
GT          :   '>'     ;
GE          :   '>='    ;

AND         :   '&&'    ;
OR          :   '||'    ;
NOT         :   '!'     ;
AMP         :   '&'     ;
PIPE        :   '|>'    ;

LPAREN      :   '('     ;
RPAREN      :   ')'     ;
LBRACE      :   '{'     ;
RBRACE      :   '}'     ;
LBRACK      :   '['     ;
RBRACK      :   ']'     ;
SEMI        :   ';'     ;
COLON       :   ':'     ;
COMMA       :   ','     ;
DOT         :   '.'     ;
QUESTION    :   '?'     ;

ID
    :   [a-zA-Z_] [a-zA-Z_0-9]*
    ;

ENTERO
    :   [0-9]+;

DECIMAL
    :   [0-9]+ '.' [0-9]+
    |   '.' [0-9]+
    ;

STRING_LITERAL  : '"' (~["\r\n\\] | '\\' .)* '"';

RUNE_LITERAL    : '\'' (~['\r\n\\] | '\\' .) '\'';

COMMENT_SINGLE  : '//' ~[\r\n]* -> skip;
COMMENT_MULTI   : '/*' .*? '*/' -> skip;
WS              : [ \t\r\n]+ -> skip;

ERR_CHAR        : .;