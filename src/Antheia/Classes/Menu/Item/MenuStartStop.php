<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
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