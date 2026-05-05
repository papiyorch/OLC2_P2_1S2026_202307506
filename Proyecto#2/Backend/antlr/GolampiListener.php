<?php

/*
 * Generated from Golampi.g4 by ANTLR 4.13.1
 */

use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;

/**
 * This interface defines a complete listener for a parse tree produced by
 * {@see GolampiParser}.
 */
interface GolampiListener extends ParseTreeListener {
	/**
	 * Enter a parse tree produced by {@see GolampiParser::start()}.
	 * @param $context The parse tree.
	 */
	public function enterStart(Context\StartContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::start()}.
	 * @param $context The parse tree.
	 */
	public function exitStart(Context\StartContext $context): void;
	/**
	 * Enter a parse tree produced by the `DeclFunction`
	 * labeled alternative in {@see GolampiParser::topDecl()}.
	 * @param $context The parse tree.
	 */
	public function enterDeclFunction(Context\DeclFunctionContext $context): void;
	/**
	 * Exit a parse tree produced by the `DeclFunction` labeled alternative
	 * in {@see GolampiParser::topDecl()}.
	 * @param $context The parse tree.
	 */
	public function exitDeclFunction(Context\DeclFunctionContext $context): void;
	/**
	 * Enter a parse tree produced by the `DeclGlobalVar`
	 * labeled alternative in {@see GolampiParser::topDecl()}.
	 * @param $context The parse tree.
	 */
	public function enterDeclGlobalVar(Context\DeclGlobalVarContext $context): void;
	/**
	 * Exit a parse tree produced by the `DeclGlobalVar` labeled alternative
	 * in {@see GolampiParser::topDecl()}.
	 * @param $context The parse tree.
	 */
	public function exitDeclGlobalVar(Context\DeclGlobalVarContext $context): void;
	/**
	 * Enter a parse tree produced by the `DeclGlobalConst`
	 * labeled alternative in {@see GolampiParser::topDecl()}.
	 * @param $context The parse tree.
	 */
	public function enterDeclGlobalConst(Context\DeclGlobalConstContext $context): void;
	/**
	 * Exit a parse tree produced by the `DeclGlobalConst` labeled alternative
	 * in {@see GolampiParser::topDecl()}.
	 * @param $context The parse tree.
	 */
	public function exitDeclGlobalConst(Context\DeclGlobalConstContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::functionDecl()}.
	 * @param $context The parse tree.
	 */
	public function enterFunctionDecl(Context\FunctionDeclContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::functionDecl()}.
	 * @param $context The parse tree.
	 */
	public function exitFunctionDecl(Context\FunctionDeclContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::returnTypes()}.
	 * @param $context The parse tree.
	 */
	public function enterReturnTypes(Context\ReturnTypesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::returnTypes()}.
	 * @param $context The parse tree.
	 */
	public function exitReturnTypes(Context\ReturnTypesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::paramList()}.
	 * @param $context The parse tree.
	 */
	public function enterParamList(Context\ParamListContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::paramList()}.
	 * @param $context The parse tree.
	 */
	public function exitParamList(Context\ParamListContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::parametro()}.
	 * @param $context The parse tree.
	 */
	public function enterParametro(Context\ParametroContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::parametro()}.
	 * @param $context The parse tree.
	 */
	public function exitParametro(Context\ParametroContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::block()}.
	 * @param $context The parse tree.
	 */
	public function enterBlock(Context\BlockContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::block()}.
	 * @param $context The parse tree.
	 */
	public function exitBlock(Context\BlockContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmtVar`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmtVar(Context\StmtVarContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmtVar` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmtVar(Context\StmtVarContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmtConst`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmtConst(Context\StmtConstContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmtConst` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmtConst(Context\StmtConstContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmtShortDecl`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmtShortDecl(Context\StmtShortDeclContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmtShortDecl` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmtShortDecl(Context\StmtShortDeclContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmtAssign`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmtAssign(Context\StmtAssignContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmtAssign` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmtAssign(Context\StmtAssignContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmIncrement`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmIncrement(Context\StmIncrementContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmIncrement` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmIncrement(Context\StmIncrementContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmtPrint`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmtPrint(Context\StmtPrintContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmtPrint` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmtPrint(Context\StmtPrintContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmtIf`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmtIf(Context\StmtIfContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmtIf` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmtIf(Context\StmtIfContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmtSwitch`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmtSwitch(Context\StmtSwitchContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmtSwitch` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmtSwitch(Context\StmtSwitchContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmtFor`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmtFor(Context\StmtForContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmtFor` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmtFor(Context\StmtForContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmtBreak`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmtBreak(Context\StmtBreakContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmtBreak` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmtBreak(Context\StmtBreakContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmtContinue`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmtContinue(Context\StmtContinueContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmtContinue` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmtContinue(Context\StmtContinueContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmtBlock`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmtBlock(Context\StmtBlockContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmtBlock` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmtBlock(Context\StmtBlockContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmtReturn`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmtReturn(Context\StmtReturnContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmtReturn` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmtReturn(Context\StmtReturnContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmtArrayAssign`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmtArrayAssign(Context\StmtArrayAssignContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmtArrayAssign` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmtArrayAssign(Context\StmtArrayAssignContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmtExpr`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmtExpr(Context\StmtExprContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmtExpr` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmtExpr(Context\StmtExprContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmtEmpty`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmtEmpty(Context\StmtEmptyContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmtEmpty` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmtEmpty(Context\StmtEmptyContext $context): void;
	/**
	 * Enter a parse tree produced by the `StmtPtrAssign`
	 * labeled alternative in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function enterStmtPtrAssign(Context\StmtPtrAssignContext $context): void;
	/**
	 * Exit a parse tree produced by the `StmtPtrAssign` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 * @param $context The parse tree.
	 */
	public function exitStmtPtrAssign(Context\StmtPtrAssignContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::varDecl()}.
	 * @param $context The parse tree.
	 */
	public function enterVarDecl(Context\VarDeclContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::varDecl()}.
	 * @param $context The parse tree.
	 */
	public function exitVarDecl(Context\VarDeclContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::constantDecl()}.
	 * @param $context The parse tree.
	 */
	public function enterConstantDecl(Context\ConstantDeclContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::constantDecl()}.
	 * @param $context The parse tree.
	 */
	public function exitConstantDecl(Context\ConstantDeclContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::shortDecl()}.
	 * @param $context The parse tree.
	 */
	public function enterShortDecl(Context\ShortDeclContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::shortDecl()}.
	 * @param $context The parse tree.
	 */
	public function exitShortDecl(Context\ShortDeclContext $context): void;
	/**
	 * Enter a parse tree produced by the `AssignSimple`
	 * labeled alternative in {@see GolampiParser::assignment()}.
	 * @param $context The parse tree.
	 */
	public function enterAssignSimple(Context\AssignSimpleContext $context): void;
	/**
	 * Exit a parse tree produced by the `AssignSimple` labeled alternative
	 * in {@see GolampiParser::assignment()}.
	 * @param $context The parse tree.
	 */
	public function exitAssignSimple(Context\AssignSimpleContext $context): void;
	/**
	 * Enter a parse tree produced by the `AssignCompound`
	 * labeled alternative in {@see GolampiParser::assignment()}.
	 * @param $context The parse tree.
	 */
	public function enterAssignCompound(Context\AssignCompoundContext $context): void;
	/**
	 * Exit a parse tree produced by the `AssignCompound` labeled alternative
	 * in {@see GolampiParser::assignment()}.
	 * @param $context The parse tree.
	 */
	public function exitAssignCompound(Context\AssignCompoundContext $context): void;
	/**
	 * Enter a parse tree produced by the `IncDec`
	 * labeled alternative in {@see GolampiParser::increment()}.
	 * @param $context The parse tree.
	 */
	public function enterIncDec(Context\IncDecContext $context): void;
	/**
	 * Exit a parse tree produced by the `IncDec` labeled alternative
	 * in {@see GolampiParser::increment()}.
	 * @param $context The parse tree.
	 */
	public function exitIncDec(Context\IncDecContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::printStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterPrintStmt(Context\PrintStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::printStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitPrintStmt(Context\PrintStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::ifStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterIfStmt(Context\IfStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::ifStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitIfStmt(Context\IfStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::switchStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterSwitchStmt(Context\SwitchStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::switchStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitSwitchStmt(Context\SwitchStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::switchBlock()}.
	 * @param $context The parse tree.
	 */
	public function enterSwitchBlock(Context\SwitchBlockContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::switchBlock()}.
	 * @param $context The parse tree.
	 */
	public function exitSwitchBlock(Context\SwitchBlockContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::caseStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterCaseStmt(Context\CaseStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::caseStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitCaseStmt(Context\CaseStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::defaultStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterDefaultStmt(Context\DefaultStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::defaultStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitDefaultStmt(Context\DefaultStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::forStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterForStmt(Context\ForStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::forStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitForStmt(Context\ForStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::breakStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterBreakStmt(Context\BreakStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::breakStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitBreakStmt(Context\BreakStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::continueStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterContinueStmt(Context\ContinueStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::continueStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitContinueStmt(Context\ContinueStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::returnStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterReturnStmt(Context\ReturnStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::returnStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitReturnStmt(Context\ReturnStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::arrayAssignment()}.
	 * @param $context The parse tree.
	 */
	public function enterArrayAssignment(Context\ArrayAssignmentContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::arrayAssignment()}.
	 * @param $context The parse tree.
	 */
	public function exitArrayAssignment(Context\ArrayAssignmentContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprTernary`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprTernary(Context\ExprTernaryContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprTernary` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprTernary(Context\ExprTernaryContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprAddr`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprAddr(Context\ExprAddrContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprAddr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprAddr(Context\ExprAddrContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprArrayLit`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprArrayLit(Context\ExprArrayLitContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprArrayLit` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprArrayLit(Context\ExprArrayLitContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprBuiltIn`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprBuiltIn(Context\ExprBuiltInContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprBuiltIn` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprBuiltIn(Context\ExprBuiltInContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprPipe`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprPipe(Context\ExprPipeContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprPipe` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprPipe(Context\ExprPipeContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprParenthesis`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprParenthesis(Context\ExprParenthesisContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprParenthesis` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprParenthesis(Context\ExprParenthesisContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprNot`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprNot(Context\ExprNotContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprNot` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprNot(Context\ExprNotContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprRelational`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprRelational(Context\ExprRelationalContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprRelational` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprRelational(Context\ExprRelationalContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprAddSub`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprAddSub(Context\ExprAddSubContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprAddSub` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprAddSub(Context\ExprAddSubContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprAnd`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprAnd(Context\ExprAndContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprAnd` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprAnd(Context\ExprAndContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprArrayAccess`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprArrayAccess(Context\ExprArrayAccessContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprArrayAccess` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprArrayAccess(Context\ExprArrayAccessContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprCall`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprCall(Context\ExprCallContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprCall` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprCall(Context\ExprCallContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprDeref`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprDeref(Context\ExprDerefContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprDeref` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprDeref(Context\ExprDerefContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprInlineArray`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprInlineArray(Context\ExprInlineArrayContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprInlineArray` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprInlineArray(Context\ExprInlineArrayContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprMulDiv`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprMulDiv(Context\ExprMulDivContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprMulDiv` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprMulDiv(Context\ExprMulDivContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprNegate`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprNegate(Context\ExprNegateContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprNegate` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprNegate(Context\ExprNegateContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprOr`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprOr(Context\ExprOrContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprOr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprOr(Context\ExprOrContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprLiteral`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprLiteral(Context\ExprLiteralContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprLiteral` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprLiteral(Context\ExprLiteralContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprEquality`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprEquality(Context\ExprEqualityContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprEquality` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprEquality(Context\ExprEqualityContext $context): void;
	/**
	 * Enter a parse tree produced by the `ExprId`
	 * labeled alternative in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function enterExprId(Context\ExprIdContext $context): void;
	/**
	 * Exit a parse tree produced by the `ExprId` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 * @param $context The parse tree.
	 */
	public function exitExprId(Context\ExprIdContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::valores()}.
	 * @param $context The parse tree.
	 */
	public function enterValores(Context\ValoresContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::valores()}.
	 * @param $context The parse tree.
	 */
	public function exitValores(Context\ValoresContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::type()}.
	 * @param $context The parse tree.
	 */
	public function enterType(Context\TypeContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::type()}.
	 * @param $context The parse tree.
	 */
	public function exitType(Context\TypeContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::literal()}.
	 * @param $context The parse tree.
	 */
	public function enterLiteral(Context\LiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::literal()}.
	 * @param $context The parse tree.
	 */
	public function exitLiteral(Context\LiteralContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::arrayLiteral()}.
	 * @param $context The parse tree.
	 */
	public function enterArrayLiteral(Context\ArrayLiteralContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::arrayLiteral()}.
	 * @param $context The parse tree.
	 */
	public function exitArrayLiteral(Context\ArrayLiteralContext $context): void;
}