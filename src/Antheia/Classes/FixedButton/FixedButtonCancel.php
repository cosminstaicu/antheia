<?php
namespace Cosmin\Antheia\Classes\FixedButton;
use Cosmin\Antheia\Classes\Icon\IconVector;
use Cosmin\Antheia\Classes\Texts;
/**
 * A fixed button with the cancel symbol
 * @author Cosmin Staicu
 */
class FixedButtonCancel extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_CLOSE);
		$this->setTitle(Texts::get('CANCEL'));
		$this->addClass('jsf-warning');
	}
}
?>