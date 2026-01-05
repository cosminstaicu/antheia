<?php
namespace Antheia\Antheia\Classes\Search\Views;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Input\Raw\InputRawCheckbox;
use Antheia\Antheia\Classes\Panel\Panel;
use Antheia\Antheia\Classes\Search\SearchResult;
use Antheia\Antheia\Classes\Table\TablePlain;
/**
 * A search result render that displays the results as a table
 * @author Cosmin Staicu
 */
class SearchViewTable extends AbstractSearchView {
	public function __construct() {
		parent::__construct();
	}
	public function getJavascriptStatusUpdate():string {
		return 'ant_search_table_statusUpdate();';
	}
	public function getHtml():string {
		$results = $this->getItems();
		if (count($results) === 0) {
			$emptyList = new SearchViewEmpty();
			$emptyList->setText($this->getNoItemsText());
			return $emptyList->getHtml();
		}
		$table = new TablePlain();
		$table->setHtmlId('ant_search_table');
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
			$row->setHtmlId('ant_search_table_item_'.$index);
			if ($this->getSelectionStatus()) {
				$cell = $row->addCell();
				$check = new InputRawCheckbox();
				$check->setHtmlId('ant_search_checkboxItem'.$index);
				$check->setValue($result->getItemId());
				$check->setOnClick('ant_search_updateSelection()');
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
