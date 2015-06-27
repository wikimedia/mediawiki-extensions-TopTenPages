<?php
class SpecialTopTenPages extends PopularPagesPage {
	public function __construct( $name = 'TopTenPages' ) {
		parent::__construct( $name );
		$inc = $this->including();
	}

	public function isIncludable() {
		return true;
	}

	function isListed() {
		return false;
	}

	function execute( $par ) {
		$inc = $this->including();

		if ( $inc ) {
			$parts = explode( '/', $par, 3 );
			$this->offset = (int)$parts[0];
			$this->limit = (int)$parts[1];
		}
		$this->setListoutput( false );
		$this->shownavigation = !$inc;
		parent::execute( $par );
	}

	function openList( $offset ) {
		global $wgTopTenPagesStartAtOne;
		if ( $wgTopTenPagesStartAtOne ) {
			return parent::openList( 0 );
		}
		return parent::openList( $offset );
	}
}
