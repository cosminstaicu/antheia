<?php
namespace Antheia\Antheia\Classes\Header\Search;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Classes\Form;
use Antheia\Antheia\Classes\Input\AbstractInputText;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Icon\IconVector;
/**
 * Renders the search input placed on the top bar
 * @author Cosmin Staicu
 */
class TopSearch implements HtmlCode {
	private $formAction;
	private $formMethod;
	private $formClasses;
	private $formOnSubmit;
	private $formId;
	private $formAttributes;
	private $formTarget;
	private $inputName;
	private $inputId;
	private $inputClasses;
	private $inputType;
	private $inputPlaceholderText;
	private $focusAnimation;
	public function __construct() {
		$this->formAction = NULL;
		$this->formMethod = Form::METHOD_GET;
		$this->formClasses = [];
		$this->formOnSubmit = '';
		$this->formId = NULL;
		$this->formAttributes = [];
		$this->formTarget = NULL;
		$this->inputType = AbstractInputText::TYPE_TEXT;
		$this->inputName = 'search';
		$this->inputId = NULL;
		$this->inputClasses = [];
		$this->inputPlaceholderText = '';
		$this->focusAnimation = true;
	}
	/**
	 * Defines the form target
	 * @param string $target the form target
	 */
	public function setFormTarget(string $target):void {
		$this->formTarget = $target;
	}
	/**
	 * Defines the focus animation for the search input
	 * @param bool $status true if the input is animated on focus, false if not
	 */
	public function setFocusAnimation(bool $status):void {
		$this->focusAnimation = $status;
	}
	/**
	 * Defines url for the form action
	 * @param string $action the url for the form action
	 */
	public function setFormAction(string $action):void {
		$this->formAction = $action;
	}
	/**
	 * Defines the method used by the form
	 * @param string $method the method used by the form, using a constant
	 * like Form::METHOD_##
	 */
	public function setFormMethod(string $method):void {
		$this->formMethod = $method;
	}
	/**
	 * Adds a css class to the search form tag
	 * @param string $class the css class added to the form tag
	 */
	public function addFormClass(string $class):void {
		$this->formClasses[] = $class;
	}
	/**
	 * Defines a javascript function, to be executed just before submitting
	 * the form.
	 * @param string $code the javascript code to be executed or an
	 * empty string if no onSubmit code is required. The code will be
	 * automatically prefixed with the "return " string
	 */
	public function setOnSubmit(string $code):void {
		$this->formOnSubmit = $code;
	}
	/**
	 * Defines the search form id
	 * @param string $id the id for the search form or NULL if no id is needed
	 */
	public function setFormId(?string $id):void {
		$this->formId = $id;
	}
	/**
	 * Adds an name=value attribute to the form tag
	 * @param string $name attribute name (for custom attributes you should
	 * use "data-XXXX" template)
	 * @param string $value attribute value
	 */
	public function addFormAttribute(string $name, string $value):void {
		$this->formAttributes[$name] = $value;
	}
	/**
	 * Defines the name of the input
	 * @param string $name the name of the input
	 */
	public function setInputName(string $name):void {
		$this->inputName = $name;
	}
	/**
	 * Defines the search input id
	 * @param string $id the id for the search input or NULL if no id is needed
	 */
	public function setInputId(string $id):void {
		$this->inputId = $id;
	}
	/**
	 * Adds a css class to the search input tag
	 * @param string $class the css class added to the input tag
	 */
	public function addInputClass(string $class):void {
		$this->inputClasses[] = $class;
	}
	/**
	 * Defines the input type
	 * @param string $type the input type, using a constant like
	 * AbstractInputText::TYPE_###
	 */
	public function setInputType(string $type):void {
		$this->inputType = $type;
	}
	/**
	 * Defines the placeholder text to be used on the input tag
	 * @param string $placeholder the placeholder text to be used on the input tag
	 */
	public function setInputPlaceholder(string $placeholder):void {
		$this->inputPlaceholderText = $placeholder;
	}
	public function getHtml(): string {
		$code = '<form';
		if ($this->formAction === NULL) {
			throw new Exception('Invalid action');
		}
		$code .= ' action="'.$this->formAction.'" method="';
		switch ($this->formMethod) {
			case Form::METHOD_GET:
				$code .= 'get';
				break;
			case Form::METHOD_POST:
				$code .= 'post';
				break;
			default:
				throw new Exception('Invalid method '.$this->formMethod);
		}
		$code .= '"';
		if (count($this->formClasses) > 0) {
			$code .= ' class="'.implode(' ', $this->formClasses).'"';
		}
		if ($this->formId !== NULL) {
			$code .= ' id="'.$this->formId.'"';
		}
		if ($this->formTarget !== NULL) {
			$code .= ' target="'.$this->formTarget.'"';
		}
		foreach ($this->formAttributes as $attrName => $attrValue) {
			$code .= ' '.$attrName.'="'.$attrValue.'"';
		}
		if ($this->formOnSubmit != '') {
			$code .= ' onSubmit="return '.$this->formOnSubmit.'"';
		}
		if ($this->focusAnimation) {
			$this->addInputClass('ant_topBar_focus-animation');
		}
		$code .= '><input type="';
		switch ($this->inputType) {
			case AbstractInputText::TYPE_EMAIL:
				$code .= 'email';
				break;
			case AbstractInputText::TYPE_NUMBER:
				$code .= 'number';
				break;
			case AbstractInputText::TYPE_PASSWORD:
				$code .= 'password';
				break;
			case AbstractInputText::TYPE_PHONE:
				$code .= 'tel';
				break;
			case AbstractInputText::TYPE_TEXT:
				$code .= 'text';
				break;
			default:
				throw new Exception('Invalid type '.$this->inputType);
		}
		$code .= '"';
		if ($this->inputName === '') {
			throw new Exception('Invalid input name');
		}
		$code .= ' name="'.$this->inputName.'"';
		if ($this->inputId !== NULL) {
			$code .= ' id="'.$this->inputId.'"';
		}
		if ($this->inputPlaceholderText !== '') {
			$code .= ' placeholder="'.$this->inputPlaceholderText.'"';
		}
		if (count($this->inputClasses) > 0) {
			$code .= ' class="'.implode(' ', array_unique($this->inputClasses)).'"';
		}
		$code .= '>';
		$icon = new IconVector();
		$icon->setIcon('search');
		$icon->setSize(24);
		$code .= $icon->getHtml();
		$code .= '</form>';
		return $code;
	}
}
?>