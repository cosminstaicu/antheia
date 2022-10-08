<?php
namespace Cosmin\Antheia\Classes\Search\Views;
use Cosmin\Antheia\Classes\Table\TablePlain;
use Cosmin\Antheia\Classes\Html;
use Cosmin\Antheia\Classes\Search\SearchResult;
use Cosmin\Antheia\Classes\Input\Raw\InputRawCheckbox;
use Cosmin\Antheia\Classes\Panel\Panel;
/**
 * A search result render that displays the results as a table
 * @author Cosmin Staicu
 */
class SearchViewTable extends AbstractSearchView {
	public function __construct() {
		parent::__construct();
	}
	public function getJavascriptStatusUpdate():string {
		return 'jsf_search_table_statusUpdate();';
	}
	public function getHtml():string {
		$results = $this->getItems();
		if (count($results) === 0) {
			$emptyList = new SearchViewEmpty();
			$emptyList->setText($this->getNoItemsText());
			return $emptyList->getHtml();
		}
		$table = new TablePlain();
		$table->setHtmlId('jsf_search_table');
		$table->setWidth('100%');
		$table->setHorizontalScroll();
		$row = $table->addRow();
		$row->formatAsTitle();
		// header
		if ($this->getSelectionStatus()) {
			$cell = $row->addCell();
			$cell->setWidth('25px');
		}
		$properties = $results[0]->getProperties();
		foreach ($properties as $property) {
			$cell = $row->addCell();
			$cell->addElement(new Html(htmlspecialchars($property['label'])));
		}
		/** @var SearchResult $result */
		foreach ($results as $index => $result) {
			$row = $table->addRow();
			$row->setHtmlId('jsf_search_table_item_'.$index);
			if ($this->getSelectionStatus()) {
				$cell = $row->addCell();
				$check = new InputRawCheckbox();
				$check->setHtmlId('jsf_search_checkboxItem'.$index);
				$check->setValue($result->getItemId());
				$check->setOnClick('jsf_search_updateSelection()');
				$cell->addElement($check);
			}
			$properties = $result->getProperties();
			foreach ($properties as $property) {
				$cell = $row->addCell();
				$cell->addElement(new Html($property['value']));
			}
		}
		$panel = new Panel();
		$panel->addElement($table);
		return $panel->getHtml();
	}
}
?>