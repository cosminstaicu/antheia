<?php
namespace Antheia\Antheia\Classes\FixedButton;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
/**
 * A fixed button with the cancel symbol
 * @author Cosmin Staicu
 */
class FixedButtonCancel extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_CLOSE);
		$this->setTitle(Texts::get('CANCEL'));
		$this->addClass('ant-warning');
	}
}
?>