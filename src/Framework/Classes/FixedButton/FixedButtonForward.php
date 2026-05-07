<?php
namespace Antheia\Framework\Classes\FixedButton;
use Antheia\Framework\Classes\Texts;
/**
 * A fixed button with a forward (right arrow) symbol
 * @author Cosmin Staicu
 */
class FixedButtonForward extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon('arrow-big-right');
		$this->setTitle(Texts::get('FORWARD'));
		$this->setTestId('fixed-button-forward');
	}
}
?>
