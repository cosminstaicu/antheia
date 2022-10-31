<?php
namespace Antheia\Antheia\Classes\Wireframe;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Interfaces\HtmlAttribute;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
/**
 * A responsive wireframe with a responsive design. The wireframe has no
 * visible borders or background colors and it is used for holding elements,
 * ussualy panels.
 * A wireframe contains one ore more rows, each row with one ore more items / cells
 * @author Cosmin Staicu
 */
class Wireframe extends AbstractClass 
implements HtmlCode, HtmlAttribute, HtmlId {
	const TYPE_FIXED = 1;
	const TYPE_FLUID = 2;
	const ALIGN_LEFT = 1;
	const ALIGN_CENTER = 2;
	private $rows;
	private $type;
	private $htmlId;
	private $align;
	private $classes;
	private $attributes;
	public function __construct() {
		parent::__construct();
		$this->rows = [];
		$this->setType(self::TYPE_FLUID);
		$this->htmlId = '';
		$this->align = self::ALIGN_LEFT;
		$this->classes = ['ant_wireframe'];
		$this->attributes = [];
	}
	/**
	 * Adds a class to the wireframe definition
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
	 * Defines the alignment of the items in a wireframe row. It is used when
	 * the items width is smaller than 100% (the items in a row will have to align,
	 * relative to the ones on a full row).
	 * @param int $align a constant like Simple::ALIGN:##
	 */
	public function setAlign(int $align):void {
		$this->align = $align;
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	/**
	 * Defines the type of wireframe. It can be either fixed (a fixed size, based
	 * on the viewport width) or fluid (full width of the available space)
	 * @param integer $type the type of structure, as a constant
	 * like Simple::TYPE_##.
	 * If the method is not called, then the wireframe will be rendered as a
	 * a FLUID type
	 */
	public function setType(int $type):void {
		$this->type = $type;
	}
	/**
	 * Adds a row to the wireframe and returns it
	 * @param Row $row (optional) the row to be added.
	 * If the parameter is not specified then a new row will be instanced.
	 * @return Row the added row
	 */
	public function addRow(Row $row = null):Row {
		if ($row === null) {
			$row = new Row();
		}
		$this->rows[] = $row;
		return $row;
	}
	public function getHtml():string {
		$code = '<div ';
		if ($this->htmlId !== '') {
			$code .= ' id="'.$this->htmlId.'" ';
		}
		if ($this->type === self::TYPE_FLUID) {
			$this->addClass('ant-fluid');
		}
		switch ($this->align) {
			case self::ALIGN_LEFT:
				$this->addClass('ant-left');
				break;
			case self::ALIGN_CENTER:
				$this->addClass('ant-center');
				break;
			default:
				throw new Exception();
		}
		$code .= 'class="';
		$code .= implode(' ', array_unique($this->classes));
		$code .='"';
		foreach ($this->attributes as $attribute) {
			$code .= ' '.$attribute['name'].'="'.$attribute['value'].'"';
		}
		$code .='>';
		/** @var HtmlCode $element */
		foreach ($this->rows as $row) {
			$code .= $row->getHtml();
		}
		$code .= '</div>';
		return $code;
	}
}
?>