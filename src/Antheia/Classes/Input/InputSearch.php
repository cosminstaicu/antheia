<?php
namespace Antheia\Antheia\Classes\Input;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Input\Raw\InputRawCustomButton;
use Antheia\Antheia\Interfaces\BeforeAfterCallback;
/**
 * A button that can perform a search on the server and returns a list of values.
 * The user can click on a value that will be updated to the original input
 * @author Cosmin Staicu
 */
class InputSearch extends AbstractInput implements BeforeAfterCallback {
	private $displayUndefined;
	private $initialText;
	private $searchInputInitialValue;
	private $url;
	private $undefinedText;
	private $undefinedValue;
	private $beforeCallback;
	private $afterCallback;
	private $button;
	static private $counter = 0;
	public function __construct() {
		parent::__construct();
		$this->button = new InputRawCustomButton();
		$this->button->addAttribute('data-ant-type', 'search');
		self::setUniqueHtmlId($this->button);
		$this->displayUndefined = false;
		$this->initialText = null;
		$this->searchInputInitialValue = '';
		$this->url = null;
		$this->undefinedText = 'Undefined';
		$this->undefinedValue = '';
		$this->beforeCallback = '';
		$this->afterCallback = '';
	}
	public function getIdForLabel():string {
		return $this->button->getHtmlId();
	}
	/**
	 * Returns the button controlling the input
	 * @return InputRawCustomButton the button controlling the input
	 */
	public function getButton():InputRawCustomButton {
		return $this->button;
	}
	public function setBeforeCallback(string $functionName):void {
		$this->beforeCallback = $functionName;
	}
	public function setAfterCallback(string $functionName):void {
		$this->afterCallback = $functionName;
	}
	/**
	 * Defines the initial value in the search field
	 * @param string $text the initial value in the search field
	 */
	public function setInputFieldInitialValue(string $text):void {
		$this->searchInputInitialValue= $text;
	}
	/**
	 * Defines the address where the search request will be submitted
	 * @param string $url the address where the search request will be submitted
	 */
	public function setUrl(string $url):void {
		$this->url = $url;
	}
	/**
	 * Defines the initial text on the button
	 * @param string $text the initial text on the button
	 */
	public function setInitialText(string $text):void {
		$this->initialText = $text;
	}
	public function getReadableValue():string {
		return $this->initialText;
	}
	/**
	 * Adds a button with the Undefined option, available to the user
	 * @param string $text (optional) the text to be displayed on the button
	 * @param string $value (optional) (default '') the value to be inserted
	 * into the hidden input for the element (the value will be sent
	 * to the server)
	 */
	public function displayUndefined($text = 'Undefined', $value = '') {
		$this->displayUndefined = true;
		$this->undefinedText = $text;
		$this->undefinedValue = $value;
	}
	public function getHtml():string {
		if ($this->initialText === null) {
			throw new Exception('Initial text is undefined');
		}
		if ($this->url === null) {
			throw new Exception('Url is undefined');
		}
		$this->button->setText($this->initialText);
		$this->button->setIcon('search');
		$this->button->setHiddenInputHtmlId($this->getHtmlId());
		$this->button->setHiddenInputName($this->getName());
		$this->button->setHiddenInputValue($this->getValue());
		if ($this->getDefaultValue() !== NULL) {
			$this->button->addHiddenInputAttribute(
					'data-default', $this->getDefaultValue()
			);
		}
		foreach ($this->getAttributeList() as $attr) {
			$this->button->addHiddenInputAttribute($attr['name'], $attr['value']);
		}
		$this->button->setOnClick('ant_inputSearch_start(this)');
		$this->button->addAttribute('data-label', $this->getLabelText());
		$this->button->addAttribute('data-url', $this->url);
		$this->button->addAttribute('data-initial', $this->searchInputInitialValue);
		$this->button->addAttribute('data-last-query', '');
		$this->button->addHiddenInputAttribute('data-validate', $this->getValidation());
		$this->button->addHiddenInputAttribute('data-post', $this->afterCallback);
		$this->button->addHiddenInputAttribute('data-pre', $this->beforeCallback);
		$this->button->addHiddenInputAttribute(
			'data-visible-element-id', $this->button->getHtmlId()
		);
		if ($this->displayUndefined) {
			$this->button->addAttribute('data-show-undefined', 'yes');
			$this->button->addAttribute(
					'data-text-undefined', addslashes($this->undefinedText)
			);
			$this->button->addAttribute(
					'data-undefined-value', addslashes($this->undefinedValue)
			);
		} else {
			$this->button->addAttribute('data-show-undefined', 'no');
		}
		if ($this->exportJavascript()) {
			$this->button->setHiddenInputHtmlId($this->getHtmlId());
			$this->button->addHiddenInputAttribute(
					'data-validate', $this->getValidation()
			);
		}
		$this->setHtmlCode($this->button->getHtml());
		return parent::getHtml();
	}
}
?>
