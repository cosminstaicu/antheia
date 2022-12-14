<?php
namespace Antheia\Antheia\Classes\Table\Plain;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Interfaces\TableCell;
use Antheia\Antheia\Interfaces\TableRow;
/**
 * Defines a regular row, from a table. The row (just like the table)
 * has no special formatting
 * @author Cosmin Staicu
 */
class Row extends AbstractClass
implements TableRow {
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
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	/**
	 * Calling the method will render the row as a title row
	 * WARNING The method is automatically called by the framework. The user does
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
	public function addClass(string $class):void {
		$this->classes[] = $class;
	}	
	public function addAttribute(string $name, string $value):void {
		$this->attributes[] = ['name' => $name, 'value' => $value];
	}
	public function addTextAttribute(string $name, string $value):void {
		$this->addAttribute('data-text-'.$name, Texts::get($value));
	}
	public function addCell(TableCell $cell = NULL):TableCell {
		if ($cell === null) {
			$cell = new Cell();
		}
		if (!is_a($cell, 'Antheia\Antheia\Classes\Table\Plain\Cell')) {
			throw new Exception(
				'Only Antheia\Antheia\Classes\Table\Plain\Cell instances allowed'
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