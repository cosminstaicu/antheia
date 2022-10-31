<?php
namespace Antheia\Antheia\Classes\FixedButton;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
/**
 * A fixed button with the refresh symbol
 * @author Cosmin Staicu
 */
class FixedButtonUpdate extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_UPDATE);
		$this->setTitle(Texts::get('REFRESH'));
	}
}
?>