<?php
namespace Antheia\Framework\Classes\FixedButton;
use Antheia\Framework\Classes\Texts;
/**
 * A fixed button with the add to the shopping cart symbol
 * @author Cosmin Staicu
 */
class FixedButtonShoppingAdd extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon('shopping-basket');
		$this->setTitle(Texts::get('ADD_PRODUCT'));
		$this->setTestId('fixed-button-shopping-add');
	}
}
?>
