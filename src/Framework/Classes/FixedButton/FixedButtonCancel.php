<?php
namespace Antheia\Framework\Classes\FixedButton;
use Antheia\Framework\Classes\Texts;
/**
 * A fixed button with the cancel symbol
 * @author Cosmin Staicu
 */
class FixedButtonCancel extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon('x');
		$this->setTitle(Texts::get('CANCEL'));
		$this->addClass('ant-warning');
		$this->setTestId('fixed-button-cancel');
	}
}
?>
