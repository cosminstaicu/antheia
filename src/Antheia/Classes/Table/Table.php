<?php
namespace Cosmin\Antheia\Classes\Table;
use Cosmin\Antheia\Classes\Exception;
use Cosmin\Antheia\Classes\Table\Formatted\Row;
/**
 * The code for a default table (formatted according to the current theme)
 * @author Cosmin Staicu
 */
class Table extends TablePlain {
	private $alternateRows;
	public function __construct() {
		parent::__construct();
		$this->addClass('jsf_table-default');
		$this->setHeaderRowStatus();
		$this->alternateRows = false;
	}
	/**
	 * The method defines if the table will be rendered with alternative
	 * background colors for the rows inside
	 * @param boolean $status true if the rows shoud hane alternate background
	 * colors, false if not
	 */
	public function setAlternateRows(bool $status = true):void {
		$this->alternateRows = $status;
	}
	/**
	 * Adds a row to the table.
	 * @param Row $row (optional) the rows to be added.
	 * If the parameter is not defined then a new row will be created
	 * @return Row the added row
	 */
	public function addRow(?Row $row):Row {
		if ($row === null) {
			$row = new Row();
		}
		if (!is_a($row, 'Cosmin\Antheia\Classes\Table\Formatted\Row')) {
			throw new Exception(
				'Only Cosmin\Antheia\Classes\Table\Formatted\Row instances allowed'
			);
		}
		return parent::addRow($row);
	}
	public function getHtml():string {
		if ($this->alternateRows) {
			$this->addClass('jsf_table-alternate');
		}
		return parent::getHtml();
	}
}
?>