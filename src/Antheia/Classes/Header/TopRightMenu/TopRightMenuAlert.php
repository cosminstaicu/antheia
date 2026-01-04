<?php
namespace Antheia\Antheia\Classes\Header\TopRightMenu;
/**
 * A menu without any text and an alert symbol
 * @author Cosmin Staicu
 */
class TopRightMenuAlert extends AbstractTopRightMenu {
	public function __construct() {
		parent::__construct();
		$this->setIcon('triangle-alert');
	}
}
?>
