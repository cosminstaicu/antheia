<?php
namespace Cosmin\Antheia\Classes\Menu\Item;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * A menu with the valid icon
 * @author Cosmin Staicu
 */
class MenuValid extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('SUBMIT'));
		$this->setIcon(IconVector::ICON_VALID);
	}
}
?>