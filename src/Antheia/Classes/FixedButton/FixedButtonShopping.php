<?php
namespace Antheia\Antheia\Classes\FixedButton;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Texts;
/**
 * A fixed button with the shopping cart symbol
 * @author Cosmin Staicu
 */
class FixedButtonShopping extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_SHOPPING);
		$this->setTitle(Texts::get('PRODUCTS'));
	}
}
?>