<?php
namespace Cosmin\Antheia\Classes\Header\TopRightMenu;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * A menu with the logout text and symbol
 * @author Cosmin Staicu
 */
class TopRightMenuExit extends AbstractTopRightMenu {
	public function __construct() {
		parent::__construct();
		$this->setName(Texts::get('LOGOUT'));
		$this->setIcon(IconVector::ICON_EXIT);
	}
}
?>