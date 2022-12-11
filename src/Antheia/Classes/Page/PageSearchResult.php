<?php
namespace Antheia\Antheia\Classes\Page;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Input\AbstractInput;
use Antheia\Antheia\Classes\Search\SearchForm;
use Antheia\Antheia\Classes\Search\SearchOptionBar;
use Antheia\Antheia\Classes\Search\SearchOptionBarButton;
use Antheia\Antheia\Classes\Search\SearchResult;
use Antheia\Antheia\Classes\Search\Views\SearchViewAccordion;
use Antheia\Antheia\Classes\Search\Views\SearchViewCards;
use Antheia\Antheia\Classes\Search\Views\SearchViewTable;
use Antheia\Antheia\Classes\Wireframe\Wireframe;
/**
 * The template for a page that displays the search result, along with the
 * filters, to further refine the search.
 * @author Cosmin Staicu
 */
class PageSearchResult extends PageEmpty {
	const LIST_TYPE_ACCORDION = 1;
	const LIST_TYPE_CARDS = 2;
	const LIST_TYPE_TABLE = 3;
	private $wireframe;
	private $form;
	private $pages;
	private $currentPage;
	private $results;
	private $listType;
	private $resultsCell;
	private $showSelectOptions;
	private $selectOptions;
	private $noItemsText;
	private $uniqueIdCounter;
	public function __construct() {
		parent::__construct();
		$this->wireframe = new Wireframe();
		$this->wireframe->setType(Wireframe::TYPE_FIXED);
		$row = $this->wireframe->addRow();
		$cell = $row->addCell();
		$cell->addWidth('sm', 12);
		$this->form = new SearchForm();
		$cell->addElement($this->form);
		$row = $this->wireframe->addRow();
		$this->resultsCell = $row->addCell();
		$this->resultsCell->addWidth('sm', 12);
		$this->setPagination(1, 1);
		$this->setListType(self::LIST_TYPE_ACCORDION);
		$this->results = [];
		$this->showSelectOptions = false;
		$this->selectOptions = new SearchOptionBar();
		$this->noItemsText = Texts::get('EMPTY_SEARCH');
		$this->uniqueIdCounter = 0;
		parent::addElement($this->wireframe);
	}
	/**
	 * Defines the text displayed when no items have been found
	 * @param string $text the text displayed when no items have been found
	 */
	public function setNoItemsText(string $text):void {
		$this->noItemsText = $text;
	}
	/**
	 * Defines the type of wireframe used by the search result container.
	 * If it is fixed, then the result set width will have a fixed width, based
	 * on the curent viewport width, being aligned with the rest of the page
	 * elements.
	 * It the wireframe is fluid then all available width will be used, ignoring
	 * the alignment with the rest of the page elements.
	 * @param integer $wireframeType the type of wireframe, as one of the
	 * Wireframe::TYPE_FIXED, Wireframe::TYPE_FLUID
	 */
	public function setWireframeType(int $wireframeType):void {
		$this->wireframe->setType($wireframeType);
	}
	/**
	 * Enables the selection controls for the search results
	 */
	public function showSelectOptions():void {
		$this->showSelectOptions = true;
	}
	/**
	 * Adds a button to right of the the container for managing selected elements
	 * (if the container is enabled using the showSelectOptions() method)
	 * @param SearchOptionBarButton $button the button to be added
	 */
	public function addSelectButton(SearchOptionBarButton $button):void {
		$this->selectOptions->addButton($button);
	}
	/**
	 * Defines the list type (the render) for the results.
	 * @param integer $render the render used to display the results, as one 
	 * of the constants like PageSearchResult::LIST_TYPE_##
	 */
	public function setListType(int $render):void {
		$this->listType = $render;
	}
	/**
	 * Adds a search result, to be displayed on the page
	 * @param SearchResult $result the result to be added
	 */
	public function addResult(SearchResult $result) {
		$this->results[] = $result;
	}
	/**
	 * @see SearchForm::setDisplayFilters
	 */
	public function setDisplayFilters(bool $status):void {
		$this->form->setDisplayFilters($status);
	}
	/**
	 * @see SearchForm::setResultIndex
	 */
	public function setResultIndex (int $from, int $to, int $total):void {
		$this->form->setResultIndex($from, $to, $total);
	}
	/**
	 * Defines the pagination for the search results.
	 * @param integer $current the current page
	 * @param integer $total the total number of pages
	 */
	public function setPagination(int $current, int $total):void {
		$this->pages = $total;
		$this->currentPage = $current;
	}
	/**
	 * @see SearchForm::setSortBy
	 */
	public function setSortBy(array $list, string $selected):void {
		$this->form->setSortBy($list, $selected);
	}
	/**
	 * @see SearchForm::setOrder
	 */
	public function setOrder(string $order):void {
		$this->form->setOrder($order);
	}
	/**
	 *@see SearchForm::hideResetButton
	 */
	public function hideResetButton():void {
		$this->form->hideResetButton();
	}
	/**
	 * Adds an search filter (an input) to the criteria list of the page
	 * @param AbstractInput $input the input being added
	 * @param string $id (optional) the HTML id for the cell containing
	 * the filter (the container with the label and input)
	 * If an id is not required then an empty string can be used
	 * @param string $classes (optional) a list o classes to be inserted into
	 * the input container definition. If no classes are required then an
	 * empty array can be submitted
	 * @see SearchForm::addInput
	 */
	public function addInput(
			AbstractInput $input, string $id = '', array $classes = []):void {
		if ($input->getHtmlId() === NULL) {
			$input->setHtmlId('ant_search-filter-id'.$this->uniqueIdCounter++);
		}
		$this->form->addInput($input, $id, $classes);
	}
	/**
	 * Returns the form used for further refining the search
	 * @return SearchForm the form used for further refining the search
	 */
	public function getForm():SearchForm {
		return $this->form;
	}
	public function getHtml():string {
		switch ($this->listType) {
			case self::LIST_TYPE_ACCORDION:
				$results = new SearchViewAccordion();
				break;
			case self::LIST_TYPE_CARDS:
				$results = new SearchViewCards();
				break;
			case self::LIST_TYPE_TABLE:
				$results = new SearchViewTable();
				break;
			default:
				throw new Exception($this->listType);
		}
		$results->setNoItemsText($this->noItemsText);
		$javascript = 'ant_search_total = '.count($this->results).';
			function ant_search_renderSelection() {
				'.$results->getJavascriptStatusUpdate().'
			}';
		$this->addJavascript($javascript);
		$this->form->setPagination($this->currentPage, $this->pages);
		foreach ($this->results as $item) {
			$results->addElement($item);
		}
		if ($this->showSelectOptions) {
			$results->enableSelection();
			$this->resultsCell->addElement($this->selectOptions);
		}
		$this->resultsCell->addElement($results);
		$nextIcon = new IconVector();
		$nextIcon->setIcon(IconVector::ICON_RIGHT);
		$previousIcon = new IconVector();
		$previousIcon->setIcon(IconVector::ICON_LEFT);
		$code = '<div id="ant_search-pages"><table><tr><td>';
		if ($this->currentPage > 1) {
			$code .= '<button class="ant-back" onClick="ant_search_changePage('
			.($this->currentPage-1).')">'.$previousIcon->getHtml().'</button>';
		}
		$code .= '
			</td><td>'.Texts::get('PAGE').' </td>
			<td><input id="ant_search-input-page" type="number" min="1"
			value="'.$this->currentPage.'"
			onkeypress="ant_search_pageInputUpdated(event,'
			.$this->pages.')"></td><td>'.Texts::get('OF').'&nbsp;</td>
			<td>'.$this->pages.'</td><td>';
		if ($this->currentPage < $this->pages) {
			$code .= '<button class="ant-forward" onClick="ant_search_changePage('
			.($this->currentPage+1).')">'.$nextIcon->getHtml().'</button>';
		}
		$code .= '</td></tr></table></div>';
		parent::addElement(new Html($code));
		return parent::getHtml();
	}
}
?>