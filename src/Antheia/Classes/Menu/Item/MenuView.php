<?php
namespace Cosmin\Antheia\Classes\Menu\Item;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * A menu with the view icon
 * @author Cosmin Staicu
 */
class MenuView extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('VIEW'));
		$this->setIcon(IconVector::ICON_INFO);
	}
}
?>