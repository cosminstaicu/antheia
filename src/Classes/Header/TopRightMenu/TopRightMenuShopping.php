<?php
namespace Antheia\Framework\Header\TopRightMenu;
use Antheia\Framework\Texts;
/**
 * A menu with the shopping text and symbol
 * @author Cosmin Staicu
 */
class TopRightMenuShopping extends AbstractTopRightMenu {
	public function __construct() {
		parent::__construct();
		$this->setIcon('shopping-basket');
		$this->setName(Texts::get('SHOPPING_CART'));
	}
}
?>
