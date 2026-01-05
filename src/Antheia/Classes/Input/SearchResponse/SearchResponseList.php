<?php
namespace Antheia\Antheia\Classes\Input\SearchResponse;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Interfaces\HtmlCode;
/**
 * The response from a server search. The class is just a list containing
 * SearchResponseItem instances
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
	 * @param SearchResponseItem|NULL $item the item to be added or NULL for
	 * generating an item automatically
	 * @return SearchResponseItem the added item
	 */
	public function addItem(SearchResponseItem $item = NULL):SearchResponseItem {
		if ($item === NULL) {
			$item = new SearchResponseItem();
		}
		$this->items[] = $item;
		return $item;
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
