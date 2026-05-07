<?php
namespace Antheia\Framework\Classes\FixedButton;
use Antheia\Framework\Classes\Texts;
/**
 * A fixed button with the add symbol
 * @author Cosmin Staicu
 */
class FixedButtonAdd extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon('plus');
		$this->setTitle(Texts::get('ADD'));
		$this->setTestId('fixed-button-add');
	}
}
?>
