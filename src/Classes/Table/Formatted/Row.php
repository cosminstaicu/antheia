<?php
namespace Antheia\Framework\Table\Formatted;
use Antheia\Framework\Exception;
use Antheia\Framework\Interfaces\TableCell;
/**
 * A row from the default table
 * @author Cosmin Staicu
 */
class Row extends \Antheia\Framework\Table\Plain\Row {
	public function __construct() {
		parent::__construct();
	}
	public function addCell(?TableCell $cell = NULL):TableCell {
		if ($cell === NULL) {
			$cell = new Cell();
		}
		if (!is_a($cell, 'Antheia\Framework\Table\Formatted\Cell')) {
			throw new Exception('Only Antheia\Framework\Table\Formatted\Cell instances allowed');
		}
		return parent::addCell($cell);
	}
}
?>
