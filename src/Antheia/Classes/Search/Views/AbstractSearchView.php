<?php
namespace Cosmin\Antheia\Classes\Search\Views;
use Cosmin\Antheia\Classes\AbstractClass;
use Cosmin\Antheia\Interfaces\HtmlCode;
use Cosmin\Antheia\Classes\Search\SearchResult;
/**
 * Abstract class to be extended by all classed defining renders for displaying
 * search results
 * @author Cosmin Staicu
 */
abstract class AbstractSearchView extends AbstractClass implements HtmlCode {
	private $list;
	private $enableSelection;
	private $noItemsText;
	public function __construct() {
		parent::__construct();
		$this->list = [];
		$this->enableSelection = false;
		$this->noItemsText = '---';
	}
	/**
	 * Defines the text shown when there are no items found
	 * @param string $text the text shown when there are no items found
	 */
	public function setNoItemsText(string $text):void {
		$this->noItemsText = $text;
	}
	/**
	 * Returns the text shown when there are no items found
	 * @return string the text shown when there are no items found
	 */
	protected function getNoItemsText():string {
		return $this->noItemsText;
	}
	/**
	 * Returns the javascript code called to update the selection status of
	 * the items. The code will be inserted into the head of the page, so proper
	 * formatting is required.
	 * @return string the javascript code used for updating the selected
	 * items status. Probably it is just a function
	 */
	abstract public function getJavascriptStatusUpdate():string;
	/**
	 * Enables the item individually selection
	 */
	public function enableSelection():void {
		$this->enableSelection = true;
	}
	/**
	 * Returns the status for individually selection of the items
	 * @return boolean true if a selection checkbox is displayed, false if not
	 */
	protected function getSelectionStatus():bool {
		return $this->enableSelection;
	}
	/**
	 * Adds a search result to the list
	 * @param SearchResult $element the result that is added to the list
	 */
	public function addElement(SearchResult $element):void {
		$this->list[] = $element;
	}
	/**
	 * Returns the list with all elements
	 * @return SearchResult[]
	 */
	protected function getItems():array {
		return $this->list;
	}
}
?>