<?php
namespace Antheia\Antheia\Classes\Header\Tabs;
use Antheia\Antheia\Classes\Icon\IconVector;
/**
 * A tab with no title, but a symbol for adding an item
 * @author Cosmin Staicu
 *
 */
class HeaderAddTab extends HeaderTab {
	public function __construct() {
		parent::__construct();
		$icon = new IconVector();
		$icon->setIcon(IconVector::ICON_ADD);
		$this->setTitle($icon->getHtml());
	}
}
?>