<?php
namespace Antheia\Antheia\Classes\Input\Raw;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Internals;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Interfaces\HtmlAttribute;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
/**
 * The class renders a custom button, to be used by some types of inputs.
 * For example, the select input, the file input, the date input etc.
 * The button has a sibling as a hidden input that is used to store the
 * value to be sent to the server
 * The class does not need to be instanced by the end user, as it is automatically
 * used by the framework when the coresponding input type is used.
 * @author Cosmin Staicu
 */
class InputRawCustomButton extends AbstractClass
implements HtmlCode, HtmlAttribute, HtmlId {
	private $text;
	private $icon;
	private $onClick;
	private $htmlId;
	private $testId;
	private $attributes;
	private $hiddenInput;
	private $hiddenInputExport;
	public function __construct() {
		parent::__construct();
		$this->icon = new IconVector();
		$this->icon->setSize(24);
		$this->setText('');
		$this->setOnClick('');
		$this->htmlId = '';
		$this->testId = '';
		$this->attributes = [];
		$this->hiddenInput = new InputRawHidden();
		$this->hiddenInputExport = true;
	}
	public function addAttribute(string $name, string $value):void {
		$this->attributes[] = ['name'=>$name, 'value'=>$value];
	}
	public function addTextAttribute(string $name, string $value):void {
		$this->addAttribute('data-text-'.$name, Texts::get($value));
	}
	/**
	 * Returns the html id for the button
	 * @return string the html id for the button
	 */
	public function getHtmlId():string {
		return $this->htmlId;
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	public function setTestId(string $id):void {
		$this->testId = $id;
	}
	/**
	 * Calling the method will instruct the instance to export the button
	 * without the hidden input element
	 */
	public function disableHiddenInputExport():void {
		$this->hiddenInputExport = false;
	}
	/**
	 * Defines the name for the hidden input sibling
	 * @param string $name the name for the hidden input sibling
	 */
	public function setHiddenInputName(string $name):void {
		$this->hiddenInput->setName($name);
	}
	/**
	 * Defines the value for the hidden input sibling
	 * @param string $value the value for the hidden input sibling
	 */
	public function setHiddenInputValue(string $value):void {
		$this->hiddenInput->setValue($value);
	}
	/**
	 * Defines the html id for the hidden input sibling
	 * @param string $id the html id for the hidden input sibling
	 */
	public function setHiddenInputHtmlId(string $id):void {
		$this->hiddenInput->setHtmlId($id);
	}
	/**
	 * Returns the hidden input to be added in the html code,
	 * as a sibling of the button
	 * @return InputRawHidden the hidden input to be added
	 * in the html code, as a sibling of the button
	 */
	public function getHiddenInput():InputRawHidden {
		return $this->hiddenInput;
	}
	/**
	 * Add an name=value attribute to the hidden input sibling
	 * @param string $name attribute name (for custom attributes you should
	 * use "data-XXXX" template)
	 * @param string $value attribute value
	 */
	public function addHiddenInputAttribute(string $name, string $value):void {
		$this->hiddenInput->addAttribute($name, $value);
	}
	/**
	 * Defines the text to be displayed on the button
	 * @param string $text the text to be displayed on the button
	 */
	public function setText($text):void {
		$this->text = $text;
	}
	/**
	 * Defines the javascript code to be executed when the button is clicked
	 * @param string $cod the javascript code to be executed when the button
	 * is clicked or an empty string, if no code is required
	 */
	public function setOnClick(string $code):void {
		$this->onClick = $code;
	}
	/**
	 * Defines the icon to be displayed on the right side of the button
	 * @param string $icon the name of the icon to be displayed on the right side
	 * of the button
	 * @see IconVector::setIcon()
	 */
	public function setIcon(string $icon):void {
		$this->icon->setIcon($icon);
	}
	public function getHtml():string {
		if ($this->onClick == '') {
			throw new Exception('onClick function is not defined');
		}
		$code = '';
		$code .= '<input type="button" class="ant_form-button"'
				.' value="'.htmlspecialchars($this->text)
				.'" onClick="'.$this->onClick.'"';
		$code .= Internals::getHtmlIdCode($this->htmlId, $this->testId);
		foreach ($this->attributes as $atribut) {
			$code .= ' '.$atribut['name'].'="'.$atribut['value'].'"';
		}
		$code .= '>';
		if ($this->icon !== null) {
			$code .= $this->icon->getHtml();
		}
		if ($this->hiddenInputExport) {
			$code .= $this->hiddenInput->getHtml();
		}
		return $code;
	}
}
?>