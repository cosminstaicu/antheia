<?php
namespace Antheia\Antheia\Classes\Header\TopRightMenu;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
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