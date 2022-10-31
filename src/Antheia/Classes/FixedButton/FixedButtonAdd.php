<?php
namespace Antheia\Antheia\Classes\FixedButton;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
/**
 * A fixed button with the add symbol
 * @author Cosmin Staicu
 */
class FixedButtonAdd extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_ADD);
		$this->setTitle(Texts::get('ADD'));
	}
}
?>