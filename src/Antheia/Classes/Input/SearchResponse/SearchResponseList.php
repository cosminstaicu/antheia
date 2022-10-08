<?php
namespace Cosmin\Antheia\Classes\Input\SearchResponse;
use Cosmin\Antheia\Classes\AbstractClass;
use Cosmin\Antheia\Interfaces\HtmlCode;
use Cosmin\Antheia\Classes\Texts;
/**
 * The response from a server search. The class is just a list containing
 * jsc_input_searchResponse_item instances
 * @author Cosmin Staicu
 */
class SearchResponseList extends AbstractClass implements HtmlCode {
	private $items;
	public function __construct() {
		parent::__construct();
		$this->items = [];
	}
	/**
	 * Adds an element to the list
	 * @param SearchResponseItem $item the item to be added
	 */
	public function addItem(SearchResponseItem $item):void {
		$this->items[] = $item;
	}
	public function getHtml():string {
		$code = '';
		if (count($this->items) === 0) {
			$code .= Texts::get('NO_RESULTS');
		} else {
			/** @var SearchResponseItem $item */
			foreach ($this->items as $item) {
				$code .= $item->getHtml();
			}
		}
		return $code;
	}
}
?>