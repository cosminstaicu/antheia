<?php
namespace Antheia\Antheia\Classes\FixedButton;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Texts;
/**
 * A fixed button with the valid symbol
 * @author Cosmin Staicu
 */
class FixedButtonValid extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_VALID);
		$this->setTitle(Texts::get('SUBMIT'));
		$this->addClass('ant-valid');
	}
}
?>