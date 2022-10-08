<?php
namespace Cosmin\Antheia\Classes\Menu\Item;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * A menu with the update icon
 * @author Cosmin Staicu
 */
class MenuUpdate extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('UPDATE'));
		$this->setIcon(IconVector::ICON_UPDATE);
	}
}
?>