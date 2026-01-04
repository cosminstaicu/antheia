<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Texts;
/**
 * A menu with the shopping cart icon
 * @author Cosmin Staicu
 */
class MenuShopping extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('SHOPPING_CART'));
		$this->setIcon('shopping-cart');
	}
}
?>
