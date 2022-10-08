<?php
namespace Cosmin\Antheia\Classes\Menu\Item;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * A menu that can be customised
 * @author Cosmin Staicu
 */
class MenuCustom extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('UNDEFINED'));
		$this->setIcon(IconVector::ICON_ALERT);
	}
}
?>