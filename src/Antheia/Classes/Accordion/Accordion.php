<?php 
namespace Antheia\Antheia\Classes\Accordion;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Internals;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
/**
 * The class defines a list of stack items that will display some content when clicked
 * @author Cosmin Staicu
 */
class Accordion extends AbstractClass implements HtmlId, HtmlCode {
	private $id;
	private $testId;
	private $items;
	public function __construct() {
		parent::__construct();
		$this->items = [];
		$this->id = '';
		$this->testId = '';
	}
	public function setHtmlId(string $id):void {
		$this->id = $id;
	}
	public function setTestId(string $id):void {
		$this->testId = $id;
	}
	/**
	 * Adds a new item to the accordion and returns the item
	 * @return Item the added item
	 */
	public function getNewItem():Item {
		$item = new Item();
		$this->items[] = $item;
		return $item;
	}
	public function getHtml():string {
		$code = '<div class="ant_accordion"';
		$code .= Internals::getHtmlIdCode($this->id, $this->testId);
		$code .= '>';
		/** @var Item $item */
		foreach ($this->items as $item) {
			$code .= $item->getHtml();
		}
		$code .= '</div>';
		return $code;
	}
}
?>