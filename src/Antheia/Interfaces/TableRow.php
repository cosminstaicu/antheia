<?php
namespace Antheia\Antheia\Interfaces;
/**
 * The interface used by the table rows inside the library. The interface
 * is needed so type hinting is backward compatible with PHP-7.2
 * @author Cosmin Staicu
 */
interface TableRow extends HtmlCode, HtmlId, HtmlAttribute {
	/**
	 * Adds a CSS class to the class attribute of the tag
	 * @param string $class the name of the class to be added
	 */
	public function addClass(string $class):void;
	/**
	 * Adds a cell to the current row.
	 * @param TableCell $cell (optional) the cell to be added. If the
	 * parameter is not defined then a new cell will be created.
	 * @return TableCell the new added cell
	 */
	public function addCell(TableCell $cell = NULL):TableCell;
}
?>
