<?php
namespace Cosmin\Antheia\Classes\FixedButton;
use Cosmin\Antheia\Classes\Icon\IconVector;
use Cosmin\Antheia\Classes\Texts;
/**
 * A fixed button with the add to the shopping cart symbol
 * @author Cosmin Staicu
 */
class FixedButtonShoppingAdd extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_SHOPPING_ADD);
		$this->setTitle(Texts::get('ADD_PRODUCT'));
	}
}
?>