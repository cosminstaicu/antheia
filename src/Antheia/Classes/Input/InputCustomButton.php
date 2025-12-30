<?php
namespace Antheia\Antheia\Classes\Input;
use Antheia\Antheia\Classes\Input\Raw\InputRawCustomButton;
use Antheia\Antheia\Classes\Input\Raw\InputRawHidden;
/**
 * A custom button, to be displayed inside a form. The button has a hidden
 * input attached to it, that can be used for sending values with a form.
 * @author Cosmin Staicu
 */
class InputCustomButton extends AbstractInput {
	private $button;
	static private $counter = 0;
	public function __construct() {
		parent::__construct();
		$this->button = new InputRawCustomButton();
		self::setUniqueHtmlId($this->button);
		$this->button->addAttribute('data-ant-type', 'custom');
	}
	public function getIdForLabel():string {
		return $this->button->getHtmlId();
	}
	/**
	 * Returns the button that manages the input
	 * @return InputRawCustomButton the visible button
	 */
	public function getButton():InputRawCustomButton {
		return $this->button;
	}
	/**
	 * Defines the javascript code to be executed when the user clicks
	 * on the button. If the code does not ends with ; then the script will
	 * add it.
	 * @param string $javascript the javascript code to be executed when the user clicks
	 * the user clicks on the button
	 */
	public function setOnClick(string $javascript):void {
		$this->button->setOnClick($javascript);
	}
	/**
	 * Defines the icon displayed on the right side of the button
	 * @param string $icon the name of the icon
	 */
	public function setIcon(string $icon):void {
		$this->button->setIcon($icon);
	}
	/**
	 * Defines the name for the hidden input
	 * @param string $name the name for the hidden input
	 */
	public function setHiddenInputName(string $name):void {
		$this->button->setHiddenInputName($name);
	}
	/**
	 * Defines the value for the hidden input
	 * @param string $value the value for the hidden input
	 */
	public function setHiddenInputValue(string $value):void {
		$this->button->setHiddenInputValue($value);
	}
	/**
	 * Return the hidden input attached to the button
	 * @return InputRawHidden the hidden input attached to the button
	 */
	public function getHiddenInput():InputRawHidden {
		return $this->button->getHiddenInput();
	}
	public function getHtml():string {
		$this->button->setHiddenInputHtmlId($this->getHtmlId());
		$this->button->setHiddenInputName($this->getName());
		$this->button->addHiddenInputAttribute(
			'data-visible-element-id', $this->button->getHtmlId()
		);
		$this->button->setText($this->getValue());
		foreach ($this->getAttributeList() as $attr) {
			$this->button->addHiddenInputAttribute($attr['name'], $attr['value']);
		}
		if ($this->exportJavascript()) {
			$this->button->addHiddenInputAttribute(
					'data-validate', $this->getValidation());
		}
		$cod = $this->button->getHtml();
		$this->setHtmlCode($cod);
		return parent::getHtml();
	}
}
?>