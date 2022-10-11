<?php
namespace Antheia\Antheia\Classes\FixedButton;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Texts;
/**
 * A fixed button with the add info symbol
 * @author Cosmin Staicu
 */
class FixedButtonAddInfo extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_ADD_INFO);
		$this->setTitle(Texts::get('ADD_INFO'));
	}
}
?>