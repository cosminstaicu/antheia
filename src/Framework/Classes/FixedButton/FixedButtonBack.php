<?php
namespace Antheia\Framework\Classes\FixedButton;
use Antheia\Framework\Classes\Texts;
/**
 * A fixed button with the back symbol
 * @author Cosmin Staicu
 */
class FixedButtonBack extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon('arrow-big-left');
		$this->setTitle(Texts::get('BACK'));
		$this->setTestId('fixed-button-back');
	}
}
?>
