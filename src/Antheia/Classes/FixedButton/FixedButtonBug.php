<?php
namespace Antheia\Antheia\Classes\FixedButton;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
/**
 * A fixed button with the bug symbol
 * @author Cosmin Staicu
 */
class FixedButtonBug extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_BACK);
		$this->setTitle(Texts::get('BUG'));
	}
}
?>