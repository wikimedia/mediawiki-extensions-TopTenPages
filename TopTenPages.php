<?php
/**
 * Top Ten Pages extension.
 *
 * Display the most popular pages of a wiki on a page.
 */

$wgExtensionCredits['specialpage'][] = array(
	'path' => __FILE__,
	'name' => 'TopTenPages',
	'version' => '0.3.2',
	'license-name' => 'MIT',
	'author' => array(
		'Timo Tijhof',
		'Sascha',
	),
	'url' => 'https://www.mediawiki.org/wiki/Extension:TopTenPages',
	'description' => 'Shows most viewed pages.',
);

$wgAutoloadClasses['SpecialTopTenPages'] = __DIR__ . '/SpecialTopTenPages.php';
$wgSpecialPages['TopTenPages'] = 'SpecialTopTenPages';
$wgSpecialPageGroups['TopTenPages'] = 'other';

$wgExtensionFunctions[] = 'efTopTenPages';

// Enable this to always start the list numbering at "1", even if an offset was set.
// Defaults to false so that if (for example) offset is "2", the list will be numbered 3, 4, 5, ...
$wgTopTenPagesStartAtOne = false;

function efTopTenPages() {
	global $wgParser;
	$wgParser->setHook( 'TopTenPages', 'efTopTenPagesRender' );
}

/**
 * The callback function for converting the input text to HTML output.
 */
function efTopTenPagesRender( $text, Array $args, Parser $parser, PPFrame $frame ) {
	if ( array_key_exists( 'offset', $args ) ) {
		$offset = (int) $args['offset'];
	} else {
		$offset = 0;
	}
	if ( $text > 0 ){
		$limit = (int) $text;
	} else {
		$limit = 10;
	}
	return $parser->recursiveTagParse( "{{Special:TopTenPages/$offset/$limit}}", $frame );
}
