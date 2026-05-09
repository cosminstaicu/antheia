<?php
namespace Antheia\Framework\Menu\Item;
use Antheia\Framework\Texts;
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
