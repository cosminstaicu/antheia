<?php
namespace Antheia\Framework\Classes\Table\Formatted;
use Antheia\Framework\Classes\Exception;
use Antheia\Framework\Interfaces\TableCell;
/**
 * A row from the default table
 * @author Cosmin Staicu
 */
class Row extends \Antheia\Framework\Classes\Table\Plain\Row {
	public function __construct() {
		parent::__construct();
	}
	/**
	 * Adds a cell to the current row.
	 * @param TableCell $cell (optional) the cell to be added. If the
	 * parameter is not defined then a new cell will be created
	 * @return TableCell the added cell
	 */
	public function addCell(TableCell $cell = NULL):TableCell {
		if ($cell === null) {
			$cell = new Cell();
		}
		if (!is_a($cell, 'Antheia\Framework\Classes\Table\Formatted\Cell')) {
			throw new Exception(
				'Only Antheia\Framework\Classes\Table\Formatted\Cell instances allowed'
			);
		}
		return parent::addCell($cell);
	}
}
?>
