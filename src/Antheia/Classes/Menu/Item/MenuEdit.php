<?php
namespace Cosmin\Antheia\Classes\Menu\Item;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * A menu with the edit icon
 * @author Cosmin Staicu
 */
class MenuEdit extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('EDIT'));
		$this->setIcon(IconVector::ICON_EDIT);
	}
}
?>