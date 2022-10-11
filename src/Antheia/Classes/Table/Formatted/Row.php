<?php
namespace Antheia\Antheia\Classes\Table\Formatted;
use Antheia\Antheia\Classes\Exception;
/**
 * A row from the default table
 * @author Cosmin Staicu
 */
class Row extends \Antheia\Antheia\Classes\Table\Plain\Row {
	public function __construct() {
		parent::__construct();
	}
	/**
	 * Adds a cell to the current row.
	 * @param Cell $cell (optional) the cell to be added. If the
	 * parameter is not defined then a new cell will be created
	 * @return Cell the added cell
	 */
	public function addCell(Cell $cell = NULL):Cell {
		if ($cell === null) {
			$cell = new Cell();
		}
		if (!is_a($cell, 'Antheia\Antheia\Classes\Table\Formatted\Cell')) {
			throw new Exception(
				'Only Antheia\Antheia\Classes\Table\Formatted\Cell instances allowed'
			);
		}
		return parent::addCell($cell);
	}
}
?>