<?php
namespace Cosmin\Antheia\Classes\Header\TopRightMenu;
use Cosmin\Antheia\Classes\Icon\IconVector;
use Cosmin\Antheia\Classes\Texts;
/**
 * A menu with the shopping text and symbol
 * @author Cosmin Staicu
 */
class TopRightMenuShopping extends AbstractTopRightMenu {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_SHOPPING);
		$this->setName(Texts::get('SHOPPING_CART'));
	}
}
?>