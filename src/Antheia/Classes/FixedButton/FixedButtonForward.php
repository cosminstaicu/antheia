<?php
namespace Antheia\Antheia\Classes\FixedButton;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
/**
 * A fixed button with a forward (right arrow) symbol
 * @author Cosmin Staicu
 */
class FixedButtonForward extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_RIGHT);
		$this->setTitle(Texts::get('FORWARD'));
	}
}
?>