<?php
namespace Cosmin\Antheia\Classes\FixedButton;
use Cosmin\Antheia\Classes\Icon\IconVector;
use Cosmin\Antheia\Classes\Texts;
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