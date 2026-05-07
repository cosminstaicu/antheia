<?php
namespace Antheia\Framework\Classes\Menu\Item;
use Antheia\Framework\Classes\Texts;
/**
 * A menu with the start/stop icon
 * @author Cosmin Staicu
 */
class MenuStartStop extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('ON'));
		$this->setIcon('power');
	}
}
?>
