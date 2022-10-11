<?php
namespace Antheia\Antheia\Classes\Header\TopRightMenu;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Texts;
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