<?php
namespace Cosmin\Antheia\Classes\Menu\Item;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * A menu with the start/stop icon
 * @author Cosmin Staicu
 */
class MenuStartStop extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('ON'));
		$this->setIcon(IconVector::ICON_ON_OFF);
	}
}
?>