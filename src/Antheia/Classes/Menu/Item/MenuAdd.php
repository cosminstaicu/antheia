<?php
namespace Cosmin\Antheia\Classes\Menu\Item;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * A menu with the add icon
 * @author Cosmin Staicu
 */
class MenuAdd extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('ADD'));
		$this->setIcon(IconVector::ICON_ADD);
	}
}
?>