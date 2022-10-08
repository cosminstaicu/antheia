<?php
namespace Cosmin\Antheia\Classes\FixedButton;
use Cosmin\Antheia\Classes\Icon\IconVector;
use Cosmin\Antheia\Classes\Texts;
/**
 * A fixed button with the back symbol
 * @author Cosmin Staicu
 */
class FixedButtonBack extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_BACK);
		$this->setTitle(Texts::get('BACK'));
	}
}
?>