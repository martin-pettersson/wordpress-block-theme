<?php

use NunoMaduro\PhpInsights\Domain\Insights\CyclomaticComplexityIsHigh;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenDefineFunctions;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenGlobals;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenNormalClasses;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenTraits;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Arrays\DisallowLongArraySyntaxSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\UselessOverridingMethodSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\CharacterBeforePHPOpeningTagSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\WhiteSpace\ArbitraryParenthesesSpacingSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\WhiteSpace\DisallowTabIndentSniff;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\WhiteSpace\ScopeClosingBraceSniff;
use PHP_CodeSniffer\Standards\PSR1\Sniffs\Files\SideEffectsSniff;
use PHP_CodeSniffer\Standards\PSR1\Sniffs\Methods\CamelCapsMethodNameSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Classes\ValidClassNameSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\GlobalKeywordSniff;
use PhpCsFixer\Fixer\Basic\BracesFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassDefinitionFixer;
use PhpCsFixer\Fixer\ClassNotation\NoBlankLinesAfterClassOpeningFixer;
use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\ControlStructure\NoAlternativeSyntaxFixer;
use PhpCsFixer\Fixer\FunctionNotation\FunctionDeclarationFixer;
use PhpCsFixer\Fixer\FunctionNotation\MethodArgumentSpaceFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\ReturnNotation\ReturnAssignmentFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\NoSpacesAroundOffsetFixer;
use PhpCsFixer\Fixer\Whitespace\NoSpacesInsideParenthesisFixer;
use SlevomatCodingStandard\Sniffs\Classes\ClassConstantVisibilitySniff;
use SlevomatCodingStandard\Sniffs\Classes\SuperfluousAbstractClassNamingSniff;
use SlevomatCodingStandard\Sniffs\Classes\SuperfluousExceptionNamingSniff;
use SlevomatCodingStandard\Sniffs\Classes\SuperfluousInterfaceNamingSniff;
use SlevomatCodingStandard\Sniffs\Commenting\DocCommentSpacingSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\DisallowYodaComparisonSniff;
use SlevomatCodingStandard\Sniffs\Functions\FunctionLengthSniff;
use SlevomatCodingStandard\Sniffs\Functions\UnusedParameterSniff;
use SlevomatCodingStandard\Sniffs\PHP\OptimizedFunctionsWithoutUnpackingSniff;
use SlevomatCodingStandard\Sniffs\PHP\ShortListSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\DeclareStrictTypesSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\DisallowArrayTypeHintSyntaxSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\DisallowMixedTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\PropertyTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\UselessConstantTypeHintSniff;
use SlevomatCodingStandard\Sniffs\Variables\UnusedVariableSniff;

return array(
	'preset'       => 'default',
	'exclude'      => array(
		'docker',
		'resources/bootstrap',
		'resources/templates',
	),
	'remove'       => array(
		DisallowYodaComparisonSniff::class,
		DeclareStrictTypesSniff::class,
		NoAlternativeSyntaxFixer::class,
		DisallowArrayTypeHintSyntaxSniff::class,
		DisallowMixedTypeHintSniff::class,
		ParameterTypeHintSniff::class,
		PropertyTypeHintSniff::class,
		ReturnTypeHintSniff::class,
		UnusedParameterSniff::class,
		UnusedVariableSniff::class,
		UselessOverridingMethodSniff::class,
		ForbiddenDefineFunctions::class,
		ForbiddenGlobals::class,
		OptimizedFunctionsWithoutUnpackingSniff::class,
		MethodArgumentSpaceFixer::class,
		ForbiddenTraits::class,
		ForbiddenNormalClasses::class,
		ValidClassNameSniff::class,
		SuperfluousInterfaceNamingSniff::class,
		SuperfluousAbstractClassNamingSniff::class,
		DisallowLongArraySyntaxSniff::class,
		DisallowTabIndentSniff::class,
		DocCommentSpacingSniff::class,
		CamelCapsMethodNameSniff::class,
		ArbitraryParenthesesSpacingSniff::class,
		ScopeClosingBraceSniff::class,
		BracesFixer::class,
		NoSpacesAroundOffsetFixer::class,
		NoBlankLinesAfterClassOpeningFixer::class,
		ClassDefinitionFixer::class,
		FunctionDeclarationFixer::class,
		NoSpacesInsideParenthesisFixer::class,
		BinaryOperatorSpacesFixer::class,
		MethodChainingIndentationFixer::class,
		UselessConstantTypeHintSniff::class,
		ClassConstantVisibilitySniff::class,
		VisibilityRequiredFixer::class,
		GlobalKeywordSniff::class,
		SuperfluousExceptionNamingSniff::class,
		ShortListSniff::class,
		ReturnAssignmentFixer::class,
	),
	'config'       => array(
		CyclomaticComplexityIsHigh::class        => array(
			'maxComplexity' => 20,
		),
		FunctionLengthSniff::class               => array(
			'maxLinesLength' => 20,
		),
		LineLengthSniff::class                   => array(
			'lineLimit'         => 120,
			'absoluteLineLimit' => 120,
			'ignoreComments'    => true,
		),
		CharacterBeforePHPOpeningTagSniff::class => array(
			'exclude' => array(
				'resources/templates',
			),
		),
		SideEffectsSniff::class                  => array(
			'exclude' => array(
				'functions.php',
			),
		),
	),
	'requirements' => array(
		'min-quality'      => 100,
		'min-complexity'   => 50,
		'min-architecture' => 100,
		'min-style'        => 100,
	),
);
