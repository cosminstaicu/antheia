<?php
namespace Antheia\Framework\Header\TopRightMenu;
/**
 * A menu with the user symbol
 * @author Cosmin Staicu
 */
class TopRightMenuUser extends AbstractTopRightMenu {
	public function __construct() {
		parent::__construct();
		$this->setIcon('user');
	}
}
?>
