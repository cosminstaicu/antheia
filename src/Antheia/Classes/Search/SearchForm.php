<?php
namespace Antheia\Antheia\Classes\Search;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Form;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Input\AbstractInput;
use Antheia\Antheia\Classes\Input\InputButton;
use Antheia\Antheia\Classes\Input\InputSelect;
use Antheia\Antheia\Classes\Input\InputSubmit;
use Antheia\Antheia\Classes\Panel\Panel;
use Antheia\Antheia\Classes\Slide\SlidePanel;
use Antheia\Antheia\Classes\Wireframe\Wireframe;
/**
 * The class defines a form from a page that contains the results of a search.
 * The class displays the search filters, the sorting options and the pagination.
 * @author Cosmin Staicu
 */
class SearchForm extends Form {
	const SORT_ASC = 'ASC';
	const SORT_DESC = 'DESC';
	private $panel;
	private $wireframe;
	private $from;
	private $to;
	private $total;
	private $page;
	private $totalPages;
	private $sortByList;
	private $filters;
	private $selectedSortBy;
	private $order;
	private $displayFilters;
	private $sortByInput;
	private $displayResetButton;
	private $code;
	public function __construct() {
		parent::__construct ();
		$this->setAction($_SERVER['PHP_SELF']);
		$this->setHtmlId('ant_search-form');
		$this->setOnSubmit('ant_loading_start(true)');
		$this->setResultIndex(0, 0, 0);
		$this->setPagination(0, 0);
		$this->setOrder(self::SORT_ASC);
		$this->setDisplayFilters(true);
		$this->setSortBy([], '');
		$this->filters = [];
		$this->panel = new Panel();
		$this->addElement($this->panel);
		$this->wireframe = new Wireframe();
		$this->panel->addElement($this->wireframe);
		$this->sortByInput = new InputSelect();
		$this->displayResetButton = true;
		$this->code = '';
	}
	/**
	 * Hides the button used to reset the search filters
	 */
	public function hideResetButton():void {
		$this->displayResetButton = false;
	}
	/**
	 * Defines if the search filters are being displayed or not
	 * @param boolean $status true if the filters are displayed, false if not
	 */
	public function setDisplayFilters(bool $status):void {
		$this->displayFilters = $status;
	}
	/**
	 * Adds an search filter (an input) to the criteria list
	 * @param AbstractInput $input the input being added
	 * @param string $id (optional) the HTML id for the cell containing
	 * the filter (the container with the label and input)
	 * If an id is not required then an empty string can be used
	 * @param string $classes (optional) a list o classes to be inserted into
	 * the input container definition. If no classes are required then an
	 * empty array can be submitted
	 */
	public function addInput(
			AbstractInput $input, string $id= '', array $classes = []):void {
		$this->filters[] = ['id' => $id, 'input' => $input, 'classes' => $classes];
	}
	/**
	 * Defines the sort by list
	 * @param string[] $list a list having the value send to the
	 * server as an index and the visible text as a value
	 * @param string $elementSelectat the index of the selected element from
	 * the list defined in the previous parameter
	 */
	public function setSortBy(array $list, string $selected):void {
		$this->sortByList = $list;
		$this->selectedSortBy = $selected;
	}
	/**
	 * Defines the order of the displayed elements
	 * @param string $order a constant like Form::SORT::##
	 */
	public function setOrder(string $order):void {
		$this->order = $order;
	}
	/**
	 * Defines the count and offset for all results of the search
	 * @param integer $from the index of the first displayed element
	 * @param integer $to the index of the last displayed element
	 * @param integer $total total number of results
	 */
	public function setResultIndex (int $from, int $to, int $total):void {
		$this->from = $from;
		$this->to = $to;
		$this->total = $total;
	}
	/**
	 * Defines the pagination of the result set
	 * @param integer $page the current page
	 * @param integer $total total number of pages
	 */
	public function setPagination(int $page, int $total):void {
		$this->page = $page;
		$this->totalPages = $total;
	}
	/**
	 * Calling the method generates the html code for the form and loads it
	 * into the $this->code property
	 * @throws Exception
	 */
	private function createHtml():void {
		$slide = new SlidePanel();
		$this->addElement(new Html(
			'<input type="hidden" name="page" value="'
			.$this->page.'" id="ant_currentPage">'));
		$displaySortBy = false;
		if (count($this->sortByList) > 0) {
			$displaySortBy = true;
		}
		$wireframe = new Wireframe();
		$row = $wireframe->addRow();
		$cell = $row->addCell();
		if ($displaySortBy) {
			$cell->addWidth('sm', 5);
		} else {
			$cell->addWidth('xs', 11);
		}
		$code = '';
		$textFromTo = $this->from.' - '.$this->to.' '.Texts::get('OF').' '
			.$this->total .' '.Texts::get('RESULTS');
		if ($this->displayFilters) {
			$slideControl = $slide->getController();
			$slideControl->setText($textFromTo);
			$slideControl->setHtmlId('ant_search-filter-expand-control');
			$code .= $slideControl->getHtml();
		} else {
			$code .= '<div style="margin-top: 15px">'.$textFromTo.'</div>';
		}
		$cell->addElement(new Html($code));
		$sortBy = '';
		switch ($this->order) {
			case self::SORT_ASC:
				$sortBy = self::SORT_DESC;
				break;
			case self::SORT_DESC:
				$sortBy = self::SORT_ASC;
				break;
			default:
				throw new Exception($this->order);
		}
		$orderBy = new IconVector();
		$orderBy->setIcon(IconVector::ICON_SORT);
		$sortArrow = new IconVector();
		$sortCode = '<input type="hidden" name="sortOrder" 
			id="ant_sort-order" value="'.$this->order
			.'"><a id="ant_search-sort-order"
			href="javascript:ant_search_changeSortOrder(\''.$sortBy.'\')">';
		switch ($this->order) {
			case self::SORT_ASC:
				$sortArrow->setIcon(IconVector::ICON_SORT_ASC);
				break;
			case self::SORT_DESC:
				$sortArrow->setIcon(IconVector::ICON_SORT_DESC);
				break;
			default:
				throw new Exception($this->order);
		}
		$sortCode .= $orderBy->getHtml();
		$sortCode .= $sortArrow->getHtml();
		$sortCode .= '</a>';
		if ($displaySortBy) {
			$this->sortByInput->setLabel(Texts::get('SORT_BY'));
			$this->sortByInput->setName('sortBy');
			$this->sortByInput->setAfterCallback('ant_search_submit');
			$this->sortByInput->setLabelExport(false);
			foreach ($this->sortByList as $index => $name) {
				$selected = false;
				if ($index == $this->selectedSortBy) {
					$selected = true;
				}
				$this->sortByInput->addOption($name, $index, $selected);
			}
			$cell = $row->addCell();
			$cell->addWidth('sm', 2);
			$this->sortByInput->getLabel()->setHtmlId('ant_search-sort-label');
			$cell->addElement($this->sortByInput->getLabel());
			$cell = $row->addCell();
			$cell->addWidth('sm', 5);
			$sortTable = new Html();
			$sortTable->addRawCode('<table><tr><td style="width: 100%">');
			$sortTable->addElement($this->sortByInput);
			$sortTable->addRawCode('</td><td>');
			$sortTable->addRawCode($sortCode);
			$sortTable->addRawCode('</td></tr></table>');
			$cell->addElement($sortTable);
		} else {
			$cell = $row->addCell();
			$cell->addWidth('xs', 1);
			$cell->setAlign($cell::ALIGN_RIGHT);
			$cell->addElement(new Html($sortCode));
		}
		$this->panel->setHtmlTitle($wireframe);
		// active filters
		$activeFilters = new Html();
		$closeButton = new IconVector();
		$closeButton->setIcon(IconVector::ICON_CLOSE);
		/** @var AbstractInput $filtru */
		foreach ($this->filters as $index => $filterInfo) {
			/** @var AbstractInput $input */
			$input = $filterInfo['input'];
			if ($input->getDefaultValue() === NULL) {
				continue;
			}
			// there is a letter "t" appended to the value
			// to force a text comparation
			// otherwise problems when comparing 0 with "0" will occure
			if (($input->getDefaultValue().'t') === ($input->getValue().'t')) {
				continue;
			}
			if ($input->getHtmlId() === '') {
				$input->setHtmlId('ant_searchFilterHtmlId_'.$index);
			}
			$activeFilters->addRawCode(
				'<div class="ant_search-active-filter">'.$input->getLabelText().': '
				.htmlspecialchars($input->getReadableValue())
				.'<a href="javascript:void(0)" onClick="ant_search_resetInput(\''
				.$input->getHtmlId().'\')">'.$closeButton->getHtml().'</a></div>'
			);
		}
		if ($this->displayFilters) {
			$slide->addVisible($activeFilters);
		}
		// all filters
		$wireframe = new Wireframe();
		$row = $wireframe->addRow();
		/** @var AbstractInput $filtru */
		foreach ($this->filters as $filterInfo) {
			/** @var AbstractInput $input */
			$input = $filterInfo['input'];
			$cell = $row->addCell();
			$cell->setHtmlId($filterInfo['id']);
			foreach ($filterInfo['classes'] as $clasa) {
				$cell->addClass($clasa);
			}
			$cell->addWidth('sm', 6);
			$cell->addWidth('md', 4);
			$cell->addWidth('lg', 3);
			$cell->addElement($input);
		}
		$row = $wireframe->addRow();
		$cell = $row->addCell();
		$cell->addWidth('xs', 12);
		$table = new Html();
		$table->addRawCode(
			'<table style="margin-left: auto; margin-right: auto; margin-top: 10px">
			<tr><td>'
		);
		if ($this->displayResetButton) {
			$butonReset = new InputButton();
			$butonReset->setHtmlId('ant_search-reset');
			$butonReset->setOnClick('ant_search_reset(this)');
			$butonReset->setValue(Texts::get('RESET'));
			$table->addElement($butonReset);
			$table->addRawCode('</td><td>');
		}
		$butonSubmit = new InputSubmit();
		$butonSubmit->setValue(Texts::get('SEARCH'));
		$table->addElement($butonSubmit);
		$table->addRawCode('</td></tr></table>');
		$cell->addElement($table);
		$slide->addHidden($wireframe);
		$this->panel->addElement($slide);
		$this->code = parent::getHtml();
	}
	public function getHtml():string {
		if ($this->code === '') {
			$this->createHtml();
		}
		return $this->code;
	}
}
?>