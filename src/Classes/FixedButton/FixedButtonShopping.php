<?php
namespace Antheia\Framework\FixedButton;
use Antheia\Framework\Texts;
/**
 * A fixed button with the shopping cart symbol
 * @author Cosmin Staicu
 */
class FixedButtonShopping extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon('shopping-cart');
		$this->setTitle(Texts::get('PRODUCTS'));
		$this->setTestId('fixed-button-shopping');
	}
}
?>
