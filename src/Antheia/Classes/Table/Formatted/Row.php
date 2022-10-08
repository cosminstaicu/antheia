<?php
namespace Cosmin\Antheia\Classes\Table\Formatted;
use Cosmin\Antheia\Classes\Exception;
/**
 * A row from the default table
 * @author Cosmin Staicu
 */
class Row extends \Cosmin\Antheia\Classes\Table\Plain\Row {
	public function __construct() {
		parent::__construct();
	}
	/**
	 * Adds a cell to the current row.
	 * @param Cell $cell (optional) the cell to be added. If the
	 * parameter is not defined then a new cell will be created
	 * @return Cell the added cell
	 */
	public function addCell(?Cell $cell):Cell {
		if ($cell === null) {
			$cell = new Cell();
		}
		if (!is_a($cell, 'Cosmin\Antheia\Classes\Table\Formatted\Cell')) {
			throw new Exception(
				'Only Cosmin\Antheia\Classes\Table\Formatted\Cell instances allowed'
			);
		}
		return parent::addCell($cell);
	}
}
?>