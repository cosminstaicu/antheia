<?php
namespace Antheia\Framework\Header\Tabs;
use Antheia\Framework\Icon\IconVector;
/**
 * A tab with no title, but a symbol for adding an item
 * @author Cosmin Staicu
 */
class HeaderAddTab extends HeaderTab {
	public function __construct() {
		parent::__construct();
		$icon = new IconVector();
		$icon->setIcon('plus');
		$this->setTitle($icon->getHtml());
	}
}
?>
