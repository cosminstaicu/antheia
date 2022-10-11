<?php 
namespace Cosmin\Antheia\Classes\Accordion;
use Cosmin\Antheia\Classes\AbstractClass;
use Cosmin\Antheia\Interfaces\HtmlCode;
/**
 * The class defines a list of stack items that will display some content when clicked
 * @author Cosmin Staicu
 */
class Accordion extends AbstractClass implements HtmlCode {
	private $items;
	public function __construct() {
		parent::__construct();
		$this->items = [];
	}
	/**
	 * Adds a new item to the accordion and returns the item
	 * @return Item the added item
	 */
	public function getNewItem():Item {
		$item = new Item($this);
		$this->items[] = $item;
		return $item;
	}
	public function getHtml():string {
		$code = '<div class="ant_accordion">';
		/** @var Item $item */
		foreach ($this->items as $item) {
			$code .= $item->getHtml();
		}
		$code .= '</div>';
		return $code;
	}
}
?>