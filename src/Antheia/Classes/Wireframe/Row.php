<?php
namespace Antheia\Antheia\Classes\Wireframe;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
/**
 * Defines a row from a wireframe. The row can contain one ore more cells.
 * @author Cosmin Staicu
 */
class Row extends AbstractClass implements HtmlCode, HtmlId {
	private $content;
	private $htmlId;
	private $classes;
	public function __construct() {
		parent::__construct();
		$this->content = [];
		$this->htmlId = '';
		$this->classes = [];
	}
	/**
	 * Adds a cell to the current row
	 * @param Cell $cell (optional) the cell to be added. If the
	 * parameter is not defined then a new cell will be created.
	 * @return Cell the cell added to the row
	 */
	public function addCell(Cell $cell = null):Cell {
		if ($cell === null) {
			$cell = new Cell();
		}
		$this->content[] = $cell;
		return $cell;
	}
	public function setHtmlId(string $uniqueId):void {
		$this->htmlId = $uniqueId;
	}
	/**
	 * Adds a CSS class to the row definition
	 * @param string $class the css class to be added to the row definition
	 */
	public function addClass(string $class):void {
		$this->classes[] = $class;
	}
	public function getHtml():string {
		$code = '<div';
		if (count($this->classes) > 0) {
			$code .= ' class="'.implode(' ', array_unique($this->classes)).'"';
		}
		if ($this->htmlId !== '') {
			$code .= ' id="'.$this->htmlId.'" ';
		}
		$code .= '>';
		/** @var HtmlCode $cell */
		foreach ($this->content as $cell) {
			$code .= $cell->getHtml();
		}
		$code .= '</div>';
		return $code;
	}
}
?>