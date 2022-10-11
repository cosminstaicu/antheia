<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
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