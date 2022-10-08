<?php
namespace Cosmin\Antheia\Classes\Input;
use Cosmin\Antheia\Interfaces\HtmlCode;
use Cosmin\Antheia\Interfaces\HtmlAttribute;
use Cosmin\Antheia\Interfaces\HtmlId;
use Cosmin\Antheia\Classes\AbstractClass;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\InlineHelp\AbstractInlineHelp;
use Cosmin\Antheia\Classes\InlineHelp\InlineHelp;
use Cosmin\Antheia\Classes\Exception;
use Cosmin\Antheia\Classes\Input\Raw\InputRawLabel;
/**
 * Abstract class to be extended by all classed defining form inputs
 * @author Cosmin Staicu
 */
abstract class AbstractInput extends AbstractClass
implements HtmlCode, HtmlAttribute, HtmlId {
	private $label;
	private $name;
	private $value;
	private $defaultValue;
	private $validation;
	private $exportForAttribute;
	private $htmlId;
	private $containerHtmlId;
	private $containerClasses;
	private $labelTag;
	private $exportLabel;
	private $onClick;
	private $codHtml;
	private $exportJavascript;
	private $uniqueCounter;
	private $attributes;
	static private $counter = 0;
	public function __construct() {
		parent::__construct();
		$this->label = 'Undefined';
		$this->labelTag = new InputRawLabel();
		$this->labelTag->setInput($this);
		$this->exportLabel = true;
		$this->exportJavascript = true;
		$this->htmlId = '';
		$this->containerHtmlId = '';
		$this->setName('undefined');
		$this->setValue('');
		$this->setDefaultValue(NULL);
		// some inputs will throw an error when setValidation is called
		// (like the fileDrop input)
		// so the validation property is set directly, without calling the method
		$this->validation = '';
		$this->setHtmlCode('');
		$this->exportForAttributeInLabel(true);
		$this->uniqueCounter = AbstractInput::$counter;
		AbstractInput::$counter++;
		$this->attributes = [];
		$this->containerClasses = ['jsf_form-item'];
		$this->onClick = '';
	}
	public final function addAttribute(string $name, string $value):void {
		$this->attributes[] = ['name'=>$name, 'value'=>$value];
	}
	public function addTextAttribute(string $name, string $value):void {
		$this->addAttribute('data-text-'.$name, Texts::get($value));
	}
	/**
	 * Returns a list with all atributes defined for this input
	 * @return string[] the attributes defined for this input. Each item contains
	 * 2 properties: name (the name of the attrigure) and value (the value
	 * of the attribute)
	 */
	protected function getAttributeList():array {
		return $this->attributes;
	}
	/**
	 * Returns the HTML code will all attributes defined for the tag in a single
	 * line.
	 * @return string a text line with all attributes
	 */
	protected function getAttributesAsText():string {
		$code = '';
		foreach ($this->getAttributeList() as $atribut) {
			$code .= ' '.$atribut['name'].'="'.$atribut['value'].'"';
		}
		return $code;
	}
	/**
	 * Defines a html id for the container containing the input
	 * (the input, without the label). The container contains the input, along
	 * sith other elements, like hidden inputs, status icons etc.
	 * @param string $id the id for the container or an empty string if
	 * no id is required
	 */
	public function setContainerHtmlId(string $id):void {
		$this->containerHtmlId = $id;
	}
	/**
	 * Adds a class to the container containing the input
	 * (the input, without the label). The container contains the input, along
	 * sith other elements, like hidden inputs, status icons etc.
	 * @param string $clasa the class added to the container
	 */
	public function addContainerClass(string $class):void {
		$this->containerClasses[] = $class;
	}
	/**
	 * The method checks if the input needs an unique id. If so, then
	 * the script checks if an html id exists.
	 * If no id has been already defined by the user, then the script will
	 * generate an unique id automatically.
	 */
	protected function checkHtmlId():void {
		if ($this->getValidation() === '') {
			// no validation function is defined, so no html id is required
			return false;
		}
		if ($this->getHtmlId() !== '') {
			return false;
		}
		// the input needs an html id, but the user has not defined one
		$this->setHtmlId('jsf_input_'.$this->uniqid().$this->uniqueCounter);
	}
	/**
	 * The method returns true if the javascript code, inserted after the element
	 * needs to be generated or false if not.
	 * Usually the javascript code needs to be exported. But there are cases
	 * (for example, for the inputs that are using server side searches)
	 * the javascript export needs to be blocked.
	 * @return boolean true if javascript code needs to be inserted
	 * after the element html code, false if not
	 */
	protected function exportJavascript():bool {
		if ($this->getValidation() === '') {
			// no validation function is defined, so no javascript is required
			return false;
		}
		if (!$this->getJavascriptExport()) {
			// the user has disabled the javascript export
			return false;
		}
		return true;
	}
	/**
	 * Defines if the javascript code after the element html will be exported.
	 * @param boolean $status true if the javascript code will be exported,
	 * false if not
	 */
	public function setJavascriptExport(bool $status):void {
		$this->exportJavascript = $status;
	}
	/**
	 * Returns if the javascript code, for the input needs to be exported
	 * with the element.
	 * @param boolean $status if true the javascript code will be exported
	 * after the element, if false, the code will be ignored
	 */
	protected function getJavascriptExport():bool {
		return $this->exportJavascript;
	}
	/**
	 * Returns the inline help object attached to the input
	 * @return null | jsc_inlineHelp_abstract the inline help object attached
	 * to the input or null if no inline help object is defined
	 */
	public function getInlineHelp():void {
		return $this->labelTag->getInlineHelp();
	}
	/**
	 * Defines the inline help object attached to the input
	 * @param AbstractInlineHelp $inlineHelp the inline help object
	 * attached to the input or null if no inline help object is defined
	 */
	public function setInlineHelp(AbstractInlineHelp $inlineHelp = null):void {
		$this->labelTag->setInlineHelp($inlineHelp);
	}
	/**
	 * Defines the text that will be displayed inside an inline help object,
	 * places to the right of the input label
	 * @param string $text the text to be displayed
	 * @param string $id (optional) a html id that will be set to the inline
	 * help object
	 */
	public function setInlineHelpText(string $text, string $id = ''):void {
		$inlineHelp = new InlineHelp();
		$inlineHelp->setText($text);
		if ($id !== '') {
			$inlineHelp->setHtmlId($id);
		}
		$this->setInlineHelp($inlineHelp);
	}
	/**
	 * Defines if the label generated for the input will contain the FOR attribute,
	 * pointing to the id of the input. Ussualy all inputs have this attribure
	 * pointing to the id of the input, except the radio buttons and checkboxes.
	 * @param boolean $status true if the FOR attribute will be
	 * generated, false if not
	 */
	protected function exportForAttributeInLabel(bool $status):void {
		$this->labelTag->setExportAtributFor($status);
	}
	/**
	 * Defines the label of the input
	 * @param string $label the label of the input
	 */
	public function setLabel(string $label):void {
		$this->label = $label;
	}
	/**
	 * Returns the text for the label of the input
	 * @return string the text for the label of the element
	 */
	public function getLabelText():string {
		return $this->label;
	}
	/**
	 * Defines the javascript code that will be triggered when the user clicks
	 * on the input. The script adds ";" to the end of the line, if no
	 * such symbol already exists.
	 * @param string $javascript the onClick script that will be triggered when
	 * the user clicks on the element
	 */
	public function setOnClick(string $javascript):void {
		$this->onClick = $javascript;
		if (substr($this->onClick, -1) != ';') {
			$this->onClick.= ';';
		}
	}
	/**
	 * Returns the onClick script defined for the element
	 * @return string the onClick script defined for the element
	 */
	protected function getOnClick():string {
		return $this->onClick;
	}
	/**
	 * Defines the HTML code for the entire input element
	 * @param string $code the HTML code required to display the entire element
	 */
	protected function setHtmlCode(string $code):void {
		$this->codHtml = $code;
	}
	/**
	 * Defines the name of the javascript function used for the input
	 * validation. Calling the method will set up the input with a valid
	 * or invalid symbol next to the input. When needed the input calls
	 * the javascript function that needs to return a boolean TRUE value
	 * if the input is valid or a boolean FALSE value if the input is not
	 * valid.
	 * @param string $javascriptFunction the name of the javascript
	 * function (no parameters, just the name) of the function.
	 * The function needs to return a boolean value
	 * If an empty string is provided then the entire validation system for
	 * this input is disabled.
	 */
	public function setValidation(string $javascriptFunction):void {
		$this->validation = $javascriptFunction;
	}
	/**
	 * Returns the name of the javascript function used for input validations
	 * @return string the name of the javascript function used for input validations
	 * or an empty string if no validation is needed
	 * @see Abstractinput::setValidation()
	 */
	protected function getValidation():string {
		return $this->validation;
	}
	/**
	 * Defines if a label for the input will be exported along with the input
	 * @param boolean $status true if a label will be exported, false if not
	 */
	public function setLabelExport(bool $status):void {
		$this->exportLabel = $status;
	}
	/**
	 * Returns true if a label for the input needs to be exported, false if not
	 * @return boolean true daca a fost selectat exportul etichetei, false daca nu
	 */
	public function getLabelExport():bool {
		return $this->exportLabel;
	}
	/**
	 * Returns the label element for the input
	 * @return InputRawLabel the label element for the input
	 */
	public function getLabel():InputRawLabel {
		return $this->labelTag;
	}
	/**
	 * Defines the name of the element (the name attribute)
	 * @param string $name the name of the element
	 */
	public function setName(string $name):void {
		$this->name = $name;
	}
	/**
	 * Returns the name of the element (the name attribute)
	 * @return string the name of the element (the name attribute)
	 */
	public function getName():string {
		return $this->name;
	}
	/**
	 * Defines the value of the input. Special characters are automatically
	 * escaped.
	 * @param string $value the value of the input
	 */
	public function setValue(string $value):void {
		$this->value = $value;
	}
	/**
	 * Returns the value of the input
	 * @return string the value of the input
	 */
	public function getValue():string {
		return $this->value;
	}
	/**
	 * Returns the human readable value for the input. For text inputs, this
	 * method should returns the same result as getValue(). But for some
	 * special inputs (date, time) the readable value is different from the
	 * input value (for example, for a date, the input value is 18910427
	 * but the readable value is 27 April 1981).
	 * @return string the human readable value for the input
	 */
	public function getReadableValue():string {
		return $this->value;
	}
	/**
	 * Defines the default value for the input. Is is used when displaying 
	 * search results. If the input value is different then the default value
	 * then the user can reset the input to its default value.
	 * @param string $value the default value or NULL if no default value
	 * is required.
	 */
	public function setDefaultValue(?string $value):void {
		$this->defaultValue = $value;
	}
	/**
	 * Returns the default value for the input.
	 * @see Abstractinput::setDefaultValue()
	 * @return string the default value or NULL if no default value
	 * is required.
	 */
	public function getDefaultValue():?string {
		return $this->defaultValue;
	}
	public function setHtmlId(string $idUnic) {
		$this->htmlId = $idUnic;
	}
	/**
	 * Defines the name and the html id for the element in a single method
	 * (the name attribute and the id attribute from the tag)
	 * @param string $nameId the value for the two properties
	 */
	public function setNameId(string $nameId):void {
		$this->setName($nameId);
		$this->setHtmlId($nameId);
	}
	/**
	 * Returns the html id for the input
	 * @return string $id the html id for the input or an empty string if
	 * no id is defined
	 */
	public function getHtmlId():string {
		return $this->htmlId;
	}
	public function getHtml():string {
		if ($this->codHtml == '') {
			throw new Exception('setHtmlCode');
		}
		$code = '';
		if ($this->exportLabel) {
			$code .= $this->labelTag->getHtml();
		}
		// the inputs have to be wrapped in a div because the input tag
		// can not have :before and :after css properties (to display the status)
		$code .= '<div class="'.implode(' ', $this->containerClasses).'"';
		if ($this->containerHtmlId !== '') {
			$code .= ' id="'.$this->containerHtmlId.'"';
		}
		$code .='>'.$this->codHtml;
		// if a validation function is defined
		// then that function will be called just after the element is inserted
		if ($this->getValidation() !== '') {
			if ($this->getJavascriptExport() && $this->exportJavascript()) {
				$code .= '<script>jsf_forms_updateStatus("'
					.$this->getHtmlId().'");</script>';
			}
		}
		$code .= '</div>';
		return $code;
	}
}
?>