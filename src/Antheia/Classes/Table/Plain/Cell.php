<?php
namespace Cosmin\Antheia\Classes\Table\Plain;
use Cosmin\Antheia\Classes\AbstractClass;
use Cosmin\Antheia\Interfaces\HtmlCode;
use Cosmin\Antheia\Interfaces\HtmlId;
use Cosmin\Antheia\Interfaces\HtmlAttribute;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Html;

/**
 * Defines a regular cell, from a table row. The cell (just like the table)
 * has no special formatting
 * @author Cosmin Staicu
 */
class Cell extends AbstractClass
implements HtmlCode, HtmlId, HtmlAttribute {
	const ALIGN_UNDEFINED = 1;
	const ALIGN_LEFT = 2;
	const ALIGN_CENTER = 3;
	const ALIGN_RIGHT = 4;
	private $content;
	private $width;
	private $titleCell;
	private $colspan;
	private $rowspan;
	private $align;
	private $inlineCss;
	private $classes;
	private $htmlId;
	private $attributes;
	public function __construct() {
		parent::__construct();
		$this->content = [];
		$this->width = '';
		$this->titleCell = false;
		$this->colspan = 1;
		$this->rowspan = 1;
		$this->setAlign(self::ALIGN_UNDEFINED);
		$this->inlineCss = [];
		$this->classes = [];
		$this->htmlId = '';
		$this->attributes = [];
	}	
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
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
	 * Adds a css property to be inserted into the tag definition
	 * @param string $css the css code added (ex: "width: 30px"). 
	 * If the string does not ends wil a semicolon, then one will be added
	 */
	protected function addCss(string $css):void {
		if (substr($css, -1) != ';') {
			$css .= ';';
		}
		$this->inlineCss[] = $css;
	}
	/**
	 * Defines the cell content alignment
	 * @param integer $align the content alignment using a constant like
	 * de tipul Cell::ALIGN_##
	 */
	public function setAlign(int $align):void {
		$this->align = $align;
	}
	/**
	 * Defines the cell colspan
	 * @param integer $colspan the cell colspan
	 */
	public function setColspan(int $colspan):void {
		$this->colspan = $colspan;
	}
	/**
	 * Defines the cell colspan
	 * @param integer $rowspan the cell colspan
	 */
	public function setRowspan(int $rowspan):void {
		$this->rowspan = $rowspan;
	}
	/**
	 * Calling the method will render the cell as a title cell
	 * WARNING The method is automatically called bu the framework. The user does
	 * not need to manage it
	 */
	public function formatAsTitle():void {
		$this->titleCell = true;
	}
	/**
	 * Returns the status of rendering the cell, as a title cell.
	 * WARNING The method is automatically called bu the framework. The user does
	 * not need to manage it
	 * @return boolean true if the cell will be formatted as a title cell, false
	 * if not
	 */
	public function isTitle():bool {
		return $this->titleCell;
	}
	/**
	 * Defines the cell width
	 * @param string $width the cell width, in a css format
	 */
	public function setWidth(string $width):void {
		$this->width = $width;
	}
	/**
	 * Adds a text to the cell
	 * @param string $text the text to be added to the cell
	 */
	public function addText(string $text):void {
		$this->addElement(new Html($text));
	}
	/**
	 * Adds a html element to the cell content
	 * @param HtmlCode $code the element to be addes
	 */
	public function addElement(HtmlCode $code):void {
		$this->content[] = $code;
	}
	public function getHtml():string {
		$code = '';
		if ($this->titleCell) {
			$code .= '<th ';
		} else {
			$code .= '<td ';
		}
		if ($this->htmlId != '') {
			$code .= ' id="'.$this->htmlId.'"';
		}
		if (count($this->classes) > 0) {
			$code .= ' class="'.implode(' ', $this->classes).'"';
		}
		if ($this->width != '') {
			$this->addCss('width:'.$this->width);
		}
		switch ($this->align) {
			case self::ALIGN_UNDEFINED:
				break;
			case self::ALIGN_LEFT:
				$this->addCss('text-align: left');
				break;
			case self::ALIGN_CENTER:
				$this->addCss('text-align: center');
				break;
			case self::ALIGN_RIGHT:
				$this->addCss('text-align: right');
				break;
		}
		if (count($this->inlineCss) > 0) {
			$code .= ' style="'.implode(' ', $this->inlineCss).'"';
		}
		if ($this->colspan !== 1) {
			$code .= ' colspan="'.$this->colspan.'" ';
		}
		if ($this->rowspan !== 1) {
			$code .= ' rowspan="'.$this->rowspan.'" ';
		}
		foreach ($this->attributes as $attribute) {
			$code .= ' '.$attribute['name'].'="'.$attribute['value'].'"';
		}
		$code .= '>';
		/** @var HtmlCode $element */
		foreach ($this->content as $item) {
			$code .= $item->getHtml();
		}
		if ($this->titleCell) {
			$code .= '</th>';
		} else {
			$code .= '</td>';
		}
		return $code;
	}
}
?>