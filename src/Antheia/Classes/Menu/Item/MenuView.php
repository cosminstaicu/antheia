<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
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