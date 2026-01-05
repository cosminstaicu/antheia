<?php
namespace Antheia\Antheia\Interfaces;
/**
 * The interface used by the table cells inside the library. The interface
 * is needed so type hinting is backward compatible with PHP-7.2
 * @author Cosmin Staicu
 */
interface TableCell extends HtmlCode, HtmlId, HtmlAttribute {
	/**
	 * Adds a CSS class to the class attribute of the tag
	 * @param string $class the name of the class to be added
	 */
	public function addClass(string $class):void;
	/**
	 * Defines the cell content alignment
	 * @param integer $align the content alignment using a constant like
	 * Cell::ALIGN_##
	 */
	public function setAlign(int $align):void;
	/**
	 * Defines the cell colspan
	 * @param integer $colspan the cell colspan
	 */
	public function setColspan(int $colspan):void;
	/**
	 * Defines the cell colspan
	 * @param integer $rowspan the cell colspan
	 */
	public function setRowspan(int $rowspan):void;
	/**
	 * Defines the cell width
	 * @param string $width the cell width, in a css format
	 */
	public function setWidth(string $width):void;
	/**
	 * Adds a text to the cell
	 * @param string $text the text to be added to the cell
	 */
	public function addText(string $text):void;
	/**
	 * Adds a html element to the cell content
	 * @param HtmlCode $code the element to be addes
	 */
	public function addElement(HtmlCode $code):void;
}
?>
