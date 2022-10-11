<?php
namespace Antheia\Antheia\Classes\Input\Raw;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlAttribute;
use Antheia\Antheia\Interfaces\HtmlId;
use Antheia\Antheia\Classes\Texts;
/**
 * A simple checkbox
 * @author Cosmin Staicu
 */
class InputRawCheckbox extends AbstractClass 
implements HtmlCode, HtmlAttribute, HtmlId {
	private $label;
	private $name;
	private $value;
	private $onClick;
	private $checked;
	private $htmlId;
	private $attributes;
	public function __construct() {
		parent::__construct();
		$this->label = '';
		$this->name = 'undefined';
		$this->value = '';
		$this->checked = false;
		$this->onClick = '';
		$this->htmlId = '';
		$this->attributes = [];
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	/**
	 * Defines the name of the parameter that will be send, for the checkbox
	 * @param string $name the name of the parameter that will be send
	 * to the server, when the checkbox is checked
	 */
	public function setName(string $name):void {
		$this->name = $name;
	}
	/**
	 * Defines the value of the parameter that will be sent when the checkbox
	 * is checked
	 * @param string $value the value to be sent when the checlbox is checked
	 */
	public function setValue(string $value):void {
		$this->value = $value;
	}
	/**
	 * Defines if the checkbox will be rendered checked or unchecked
	 * @param boolean $checked if true the checkbox will be checked
	 */
	public function setChecked(bool $checked = true):void {
		$this->checked = $checked;
	}
	/**
	 * Defines the label for the checkbox (the text near the input)
	 * @param string $label the label for the checkbox (the text near the input)
	 */
	public function setLabel(string $label):void {
		$this->label = $label;
	}
	public function addAttribute(string $name, string $value):void {
		$this->attributes[] = ['name'=>$name, 'value'=>$value];
	}
	public function addTextAttribute(string $name, string $value):void {
		$this->addAttribute('data-text-'.$name, Texts::get($value));
	}
	/**
	 * Defines the javascript code to be executed when the item is clicked
	 * @param string $code the javascript code or an empty string if no event
	 * is needed
	 */
	public function setOnClick(string $code):void {
		$this->onClick = $code;
	}
	public function getHtml():string {
		$code = '<label>';
		$code .='<input type="checkbox"';
		if ($this->htmlId !== '') {
			$code .= ' id="'.$this->htmlId.'" ';
		}
		if ($this->onClick !== '') {
			$code .= ' onClick="'.$this->onClick.'" ';
		}
		$code .= 'name="'.$this->name.'" value="'.$this->value.'" ';
		if ($this->checked) {
			$code .= ' checked="checked" ';
		}
		foreach ($this->attributes as $atribut) {
			$code .= ' '.$atribut['name'].'="'.$atribut['value'].'"';
		}
		$code .= '><span>';
		if ($this->label == '') {
			$code .= '&nbsp;';
		} else {
			$code .= htmlspecialchars($this->label);
		}
		$code .= '</span></label>';
		return $code;
	}
}
?>