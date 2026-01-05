<?php
namespace Antheia\Antheia\Classes\FixedButton;
use Antheia\Antheia\Classes\Texts;
/**
 * A fixed button with the valid symbol
 * @author Cosmin Staicu
 */
class FixedButtonValid extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon('check');
		$this->setTitle(Texts::get('SUBMIT'));
		$this->addClass('ant-valid');
		$this->setTestId('fixed-button-valid');
	}
}
?>
