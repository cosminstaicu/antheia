<?php
namespace Antheia\Antheia\Classes\FixedButton;
use Antheia\Antheia\Classes\Texts;
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
