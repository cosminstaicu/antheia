<?php
namespace Cosmin\Antheia\Classes\Header\TopRightMenu;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * A menu with the select text and symbol
 * @author Cosmin Staicu
 */
class TopRightMenuSelect extends AbstractTopRightMenu {
	public function __construct() {
		parent::__construct();
		$this->setName(Texts::get('SELECT'));
		$this->setIcon(IconVector::ICON_COMPONENT);
	}
}
?>