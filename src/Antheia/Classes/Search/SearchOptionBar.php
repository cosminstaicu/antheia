<?php
namespace Antheia\Antheia\Classes\Search;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Input\Raw\InputRawCheckbox;
use Antheia\Antheia\Classes\Panel\Panel;
use Antheia\Antheia\Classes\Table\TablePlain;
use Antheia\Antheia\Interfaces\HtmlCode;
/**
 * Defines a panel that can be displayed above the list with the search
 * results. Using the panel options, the selected items can be managed.
 * This class should not be directly instanced by the user, as it is
 * auto managed by the framework
 * @author Cosmin Staicu
 */
class SearchOptionBar extends AbstractClass implements HtmlCode {
	private $buttons;
	public function __construct() {
		parent::__construct();
		$this->buttons = [];
	}
	/**
	 * Adds a button to the right side of the bar
	 * @param SearchOptionBarButton $buton
	 */
	public function addButton(SearchOptionBarButton $button):void {
		$this->buttons[] = $button;
	}
	public function getHtml():string {
		$table = new TablePlain();
		$table->setWidth('100%');
		$row = $table->addRow();
		$cell = $row->addCell();
		$checkbox = new InputRawCheckbox();
		$checkbox->setHtmlId('ant_selectAll');
		$checkbox->setOnClick('ant_search_toogleSelectAll()');
		$checkbox->setLabel(Texts::get('SELECT_ALL'));
		$cell->addElement($checkbox);
		$code = '<div>';
		foreach ($this->buttons as $button) {
			$code.= $button->getHtml();
		}
		$code .= '</div>';
		$cell = $row->addCell();
		$cell->addElement(new Html($code));
		$container = new Panel();
		$container->setHtmlId('ant_search-options');
		$container->addElement($table);
		return $container->getHtml();
	}
}
?>