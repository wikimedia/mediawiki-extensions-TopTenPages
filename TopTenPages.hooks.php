<?php
class TopTenPagesHooks {

	public static function onParserFirstCallInit( Parser $parser ) {
		$parser->setHook( 'TopTenPages', 'TopTenPagesHooks::renderTag' );
	}

	/**
	 * The callback function for converting the input text to HTML output.
	 */
	public static function renderTag( $text, Array $args, Parser $parser, PPFrame $frame ) {
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
}
