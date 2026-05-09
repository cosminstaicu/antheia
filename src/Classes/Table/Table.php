<?php
namespace Antheia\Framework\Table;
use Antheia\Framework\Exception;
use Antheia\Framework\Interfaces\TableRow;
use Antheia\Framework\Table\Formatted\Row;
/**
 * The code for a default table (formatted according to the current theme)
 * @author Cosmin Staicu
 */
class Table extends TablePlain {
	private $alternateRows;
	public function __construct() {
		parent::__construct();
		$this->addClass('ant_table-default');
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
	 * @param TableRow $row (optional) 
	 * the row to be added. If the parameter is not defined then a new row will
	 * be created
	 * @return TableRow the added row
	 */
	public function addRow(TableRow $row = NULL):TableRow {
		if ($row === null) {
			$row = new Row();
		}
		if (!is_a($row, 'Antheia\Framework\Table\Formatted\Row')) {
			throw new Exception(
				'Only Antheia\Framework\Table\Formatted\Row instances allowed'
			);
		}
		return parent::addRow($row);
	}
	public function getHtml():string {
		if ($this->alternateRows) {
			$this->addClass('ant_table-alternate');
		}
		return parent::getHtml();
	}
}
?>
