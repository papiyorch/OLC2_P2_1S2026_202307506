<?php

/*
 * Generated from Golampi.g4 by ANTLR 4.13.1
 */

use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;

/**
 * This interface defines a complete generic visitor for a parse tree produced by {@see GolampiParser}.
 */
interface GolampiVisitor extends ParseTreeVisitor
{
	/**
	 * Visit a parse tree produced by {@see GolampiParser::start()}.
	 *
	 * @param Context\StartContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStart(Context\StartContext $context);

	/**
	 * Visit a parse tree produced by the `DeclFunction` labeled alternative
	 * in {@see GolampiParser::topDecl()}.
	 *
	 * @param Context\DeclFunctionContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDeclFunction(Context\DeclFunctionContext $context);

	/**
	 * Visit a parse tree produced by the `DeclGlobalVar` labeled alternative
	 * in {@see GolampiParser::topDecl()}.
	 *
	 * @param Context\DeclGlobalVarContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDeclGlobalVar(Context\DeclGlobalVarContext $context);

	/**
	 * Visit a parse tree produced by the `DeclGlobalConst` labeled alternative
	 * in {@see GolampiParser::topDecl()}.
	 *
	 * @param Context\DeclGlobalConstContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDeclGlobalConst(Context\DeclGlobalConstContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::functionDecl()}.
	 *
	 * @param Context\FunctionDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFunctionDecl(Context\FunctionDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::returnTypes()}.
	 *
	 * @param Context\ReturnTypesContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitReturnTypes(Context\ReturnTypesContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::paramList()}.
	 *
	 * @param Context\ParamListContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitParamList(Context\ParamListContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::parametro()}.
	 *
	 * @param Context\ParametroContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitParametro(Context\ParametroContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::block()}.
	 *
	 * @param Context\BlockContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBlock(Context\BlockContext $context);

	/**
	 * Visit a parse tree produced by the `StmtVar` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmtVarContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmtVar(Context\StmtVarContext $context);

	/**
	 * Visit a parse tree produced by the `StmtConst` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmtConstContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmtConst(Context\StmtConstContext $context);

	/**
	 * Visit a parse tree produced by the `StmtShortDecl` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmtShortDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmtShortDecl(Context\StmtShortDeclContext $context);

	/**
	 * Visit a parse tree produced by the `StmtAssign` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmtAssignContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmtAssign(Context\StmtAssignContext $context);

	/**
	 * Visit a parse tree produced by the `StmIncrement` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmIncrementContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmIncrement(Context\StmIncrementContext $context);

	/**
	 * Visit a parse tree produced by the `StmtPrint` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmtPrintContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmtPrint(Context\StmtPrintContext $context);

	/**
	 * Visit a parse tree produced by the `StmtIf` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmtIfContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmtIf(Context\StmtIfContext $context);

	/**
	 * Visit a parse tree produced by the `StmtSwitch` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmtSwitchContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmtSwitch(Context\StmtSwitchContext $context);

	/**
	 * Visit a parse tree produced by the `StmtFor` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmtForContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmtFor(Context\StmtForContext $context);

	/**
	 * Visit a parse tree produced by the `StmtBreak` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmtBreakContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmtBreak(Context\StmtBreakContext $context);

	/**
	 * Visit a parse tree produced by the `StmtContinue` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmtContinueContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmtContinue(Context\StmtContinueContext $context);

	/**
	 * Visit a parse tree produced by the `StmtBlock` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmtBlockContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmtBlock(Context\StmtBlockContext $context);

	/**
	 * Visit a parse tree produced by the `StmtReturn` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmtReturnContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmtReturn(Context\StmtReturnContext $context);

	/**
	 * Visit a parse tree produced by the `StmtArrayAssign` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmtArrayAssignContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmtArrayAssign(Context\StmtArrayAssignContext $context);

	/**
	 * Visit a parse tree produced by the `StmtExpr` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmtExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmtExpr(Context\StmtExprContext $context);

	/**
	 * Visit a parse tree produced by the `StmtEmpty` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmtEmptyContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmtEmpty(Context\StmtEmptyContext $context);

	/**
	 * Visit a parse tree produced by the `StmtPtrAssign` labeled alternative
	 * in {@see GolampiParser::statement()}.
	 *
	 * @param Context\StmtPtrAssignContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStmtPtrAssign(Context\StmtPtrAssignContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::varDecl()}.
	 *
	 * @param Context\VarDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitVarDecl(Context\VarDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::constantDecl()}.
	 *
	 * @param Context\ConstantDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitConstantDecl(Context\ConstantDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::shortDecl()}.
	 *
	 * @param Context\ShortDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitShortDecl(Context\ShortDeclContext $context);

	/**
	 * Visit a parse tree produced by the `AssignSimple` labeled alternative
	 * in {@see GolampiParser::assignment()}.
	 *
	 * @param Context\AssignSimpleContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAssignSimple(Context\AssignSimpleContext $context);

	/**
	 * Visit a parse tree produced by the `AssignCompound` labeled alternative
	 * in {@see GolampiParser::assignment()}.
	 *
	 * @param Context\AssignCompoundContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAssignCompound(Context\AssignCompoundContext $context);

	/**
	 * Visit a parse tree produced by the `IncDec` labeled alternative
	 * in {@see GolampiParser::increment()}.
	 *
	 * @param Context\IncDecContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIncDec(Context\IncDecContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::printStmt()}.
	 *
	 * @param Context\PrintStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitPrintStmt(Context\PrintStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::ifStmt()}.
	 *
	 * @param Context\IfStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIfStmt(Context\IfStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::switchStmt()}.
	 *
	 * @param Context\SwitchStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitSwitchStmt(Context\SwitchStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::switchBlock()}.
	 *
	 * @param Context\SwitchBlockContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitSwitchBlock(Context\SwitchBlockContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::caseStmt()}.
	 *
	 * @param Context\CaseStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitCaseStmt(Context\CaseStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::defaultStmt()}.
	 *
	 * @param Context\DefaultStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDefaultStmt(Context\DefaultStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::forStmt()}.
	 *
	 * @param Context\ForStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitForStmt(Context\ForStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::breakStmt()}.
	 *
	 * @param Context\BreakStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBreakStmt(Context\BreakStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::continueStmt()}.
	 *
	 * @param Context\ContinueStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitContinueStmt(Context\ContinueStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::returnStmt()}.
	 *
	 * @param Context\ReturnStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitReturnStmt(Context\ReturnStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::arrayAssignment()}.
	 *
	 * @param Context\ArrayAssignmentContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArrayAssignment(Context\ArrayAssignmentContext $context);

	/**
	 * Visit a parse tree produced by the `ExprTernary` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprTernaryContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprTernary(Context\ExprTernaryContext $context);

	/**
	 * Visit a parse tree produced by the `ExprAddr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprAddrContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprAddr(Context\ExprAddrContext $context);

	/**
	 * Visit a parse tree produced by the `ExprArrayLit` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprArrayLitContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprArrayLit(Context\ExprArrayLitContext $context);

	/**
	 * Visit a parse tree produced by the `ExprBuiltIn` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprBuiltInContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprBuiltIn(Context\ExprBuiltInContext $context);

	/**
	 * Visit a parse tree produced by the `ExprPipe` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprPipeContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprPipe(Context\ExprPipeContext $context);

	/**
	 * Visit a parse tree produced by the `ExprParenthesis` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprParenthesisContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprParenthesis(Context\ExprParenthesisContext $context);

	/**
	 * Visit a parse tree produced by the `ExprNot` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprNotContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprNot(Context\ExprNotContext $context);

	/**
	 * Visit a parse tree produced by the `ExprRelational` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprRelationalContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprRelational(Context\ExprRelationalContext $context);

	/**
	 * Visit a parse tree produced by the `ExprAddSub` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprAddSubContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprAddSub(Context\ExprAddSubContext $context);

	/**
	 * Visit a parse tree produced by the `ExprAnd` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprAndContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprAnd(Context\ExprAndContext $context);

	/**
	 * Visit a parse tree produced by the `ExprArrayAccess` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprArrayAccessContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprArrayAccess(Context\ExprArrayAccessContext $context);

	/**
	 * Visit a parse tree produced by the `ExprCall` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprCallContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprCall(Context\ExprCallContext $context);

	/**
	 * Visit a parse tree produced by the `ExprDeref` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprDerefContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprDeref(Context\ExprDerefContext $context);

	/**
	 * Visit a parse tree produced by the `ExprInlineArray` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprInlineArrayContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprInlineArray(Context\ExprInlineArrayContext $context);

	/**
	 * Visit a parse tree produced by the `ExprMulDiv` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprMulDivContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprMulDiv(Context\ExprMulDivContext $context);

	/**
	 * Visit a parse tree produced by the `ExprNegate` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprNegateContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprNegate(Context\ExprNegateContext $context);

	/**
	 * Visit a parse tree produced by the `ExprOr` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprOrContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprOr(Context\ExprOrContext $context);

	/**
	 * Visit a parse tree produced by the `ExprLiteral` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprLiteralContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprLiteral(Context\ExprLiteralContext $context);

	/**
	 * Visit a parse tree produced by the `ExprEquality` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprEqualityContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprEquality(Context\ExprEqualityContext $context);

	/**
	 * Visit a parse tree produced by the `ExprId` labeled alternative
	 * in {@see GolampiParser::expression()}.
	 *
	 * @param Context\ExprIdContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprId(Context\ExprIdContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::valores()}.
	 *
	 * @param Context\ValoresContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitValores(Context\ValoresContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::type()}.
	 *
	 * @param Context\TypeContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitType(Context\TypeContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::literal()}.
	 *
	 * @param Context\LiteralContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitLiteral(Context\LiteralContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::arrayLiteral()}.
	 *
	 * @param Context\ArrayLiteralContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArrayLiteral(Context\ArrayLiteralContext $context);
}