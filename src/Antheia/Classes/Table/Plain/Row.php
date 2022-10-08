<?php
namespace Cosmin\Antheia\Classes\Table\Plain;
use Cosmin\Antheia\Classes\AbstractClass;
use Cosmin\Antheia\Interfaces\HtmlCode;
use Cosmin\Antheia\Interfaces\HtmlId;
use Cosmin\Antheia\Interfaces\HtmlAttribute;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Exception;
/**
 * Defines a regular row, from a table. The row (just like the table)
 * has no special formatting
 * @author Cosmin Staicu
 */
class Row extends AbstractClass
implements HtmlCode, HtmlId, HtmlAttribute {
	private $cells;
	private $classes;
	private $inlineCss;
	private $titleRow;
	private $htmlId;
	private $attributes;
	public function __construct() {
		parent::__construct();
		$this->cells = [];
		$this->classes = [];
		$this->inlineCss = [];
		$this->titleRow = false;
		$this->htmlId = '';
		$this->attributes = [];
	}
	public function setHtmlId(string $idUnic):void {
		$this->htmlId = $idUnic;
	}
	/**
	 * Calling the method will render the row as a title row
	 * WARNING The method is automatically called bu the framework. The user does
	 * not need to manage it
	 */
	public function formatAsTitle():void {
		$this->titleRow = true;
	}
	/**
	 * Returns the status of rendering the cell, as a title cell.
	 * WARNING The method is automatically called by the framework. The user does
	 * not need to manage it
	 * @return boolean true if the cell will be formatted as a title cell, false
	 * if not
	 */
	public function isTitle():bool {
		return $this->titleRow;
	}
	/**
	 * Adds a css property to be inserted into the tag definition
	 * @param string $css the css code added (ex: "width: 30px").
	 * If the string does not ends wil a semicolon, then one will be added
	 */
	protected function addCss(string $css):void {
		if (substr($css, -1) !== ';') {
			$css .= ';';
		}
		$this->inlineCss[] = $css;
	}
	/**
	 * Adds a CSS class to the class attribute of the tag
	 * @param string $class the name of the class to be added
	 */
	public function addClass(string $class):void {
		$this->classes[] = $class;
	}	
	public function addAttribute(string $name, string $value):void {
		$this->attributes[] = ['name' => $name, 'value' => $value];
	}
	public function addTextAttribute(string $name, string $value):void {
		$this->addAttribute('data-text-'.$name, Texts::get($value));
	}
	/**
	 * Adds a cell to the current row.
	 * @param Cell $cell (optional) the cell to be added. If the
	 * parameter is not defined then a new cell will be created.
	 * @return Cell the new added cell
	 */
	public function addCell(?Cell $cell):Cell {
		if ($cell === null) {
			$cell = new Cell();
		}
		if (!is_a($cell, 'Cosmin\Antheia\Classes\Table\Plain\Cell')) {
			throw new Exception(
				'Only Cosmin\Antheia\Classes\Table\Plain\Cell instances allowed'
			);
		}
		$this->cells[] = $cell;
		return $cell;
	}
	public function getHtml():string {
		if (count($this->cells) === 0) {
			throw new Exception('addCell');
		}
		if ($this->titleRow) {
			/** @var Cell $celula */
			foreach ($this->cells as $cell) {
				$cell->formatAsTitle();
			}
		}
		$code = '';
		$code .= '<tr';
		if ($this->htmlId != '') {
			$code .= ' id="'.$this->htmlId.'"';
		}
		if (count($this->classes) > 0) {
			$code .= ' class="'.implode(' ', $this->classes).'"';
		}
		if (count($this->inlineCss) > 0) {
			$code .= ' style="'.implode(' ', $this->inlineCss).'"';
		}
		foreach ($this->attributes as $attr) {
			$code .= ' '.$attr['name'].'="'.$attr['value'].'"';
		}
		$code .= '>';
		/** @var Cell $element */
		foreach ($this->cells as $item) {
			$code .= $item->getHtml();
		}
		$code .= '</tr>';
		return $code;
	}
}
?>