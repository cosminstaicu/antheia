<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
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