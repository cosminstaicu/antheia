<?php
namespace Cosmin\Antheia\Classes\Menu;
use Cosmin\Antheia\Classes\AbstractClass;
use Cosmin\Antheia\Interfaces\HtmlCode;
use Cosmin\Antheia\Classes\Menu\Item\AbstractMenu;
use Cosmin\Antheia\Classes\Exception;
/**
 * A container with a visible container that can have a menu (default hidden)
 * with one ore more items. The menu items can be toggled from the button places
 * to the left side of the title.
 * @author Cosmin Staicu
 */
class Container extends AbstractClass implements HtmlCode {
	private $items;
	private $visible;
	public function __construct() {
		parent::__construct();
		$this->items = [];
		$this->visible = null;
	}
	/**
	 * Adds a menu item to the list
	 * @param AbstractMenu $item the menu item to be added to the list
	 */
	public function addItem(AbstractMenu $item):void {
		$this->items[] = $item;
	}
	/**
	 * Defines the element visible when the menu items are hidden
	 * @param HtmlCode $element the visible element when the menu items
	 * are hidden
	 */
	public function setVisible(HtmlCode $element):void {
		$this->visible = $element;
	}
	public function getHtml():string {
		if ($this->visible === null) {
			throw new Exception('Visible element is not defined');
		}
		if (count($this->items) === 0) {
			throw new Exception('No menu items defined');
		}
		$code = '<div class="ant_menu">';
		$code .= '<a href="javascript:void(0);" onClick="ant_menu_toogle(this)">'
			.'<div></div><div></div><div></div></a><div>';
			$code .= $this->visible->getHtml();
		$code .= '</div><div>';
		/** @var AbstractMenu $item */
		foreach ($this->items as $item) {
			$code .= $item->getHtml();
		}
		$code .= '</div></div>';
		return $code;
	}
}
?>