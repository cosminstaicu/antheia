<?php
namespace Antheia\Antheia\Classes\Input;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Input\Raw\InputRawCustomButton;
use Antheia\Antheia\Interfaces\BeforeAfterCallback;
/**
 * A select input. On click, the interface will display one ore more options
 * from which the user can select one
 * @author Cosmin Staicu
 */
class InputSelect extends AbstractInput implements BeforeAfterCallback {
	private $options;
	private $beforeCallback;
	private $afterCallback;
	private $button;
	static private $counter = 0;
	public function __construct() {
		parent::__construct();
		$this->button = new InputRawCustomButton();
		$this->button->setIcon(IconVector::ICON_MENU);
		self::setUniqueHtmlId($this->button);
		$this->options = [];
		$this->beforeCallback = '';
		$this->afterCallback = '';
	}
	public function getIdForLabel():string {
		return $this->button->getHtmlId();
	}
	/**
	 * Returns the button for selection control
	 * @return InputRawCustomButton the button for selection control
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
	 * Adds an item to the selection
	 * @param string $label the label of the element (displayed)
	 * @param string $value the value of the element
	 * @param boolean $selected (optional) (default false) if it is true then
	 * this option will be selected by default
	 * @param string $helpText (optional) if defined then an info text will
	 * be displayed under the input when this option is selected
	 */
	public function addOption(
			string $label, 
			string $value, 
			bool $selected = false, 
			string $helpText = ''):void {
		$helpText = str_replace("&", "&amp;", $helpText);
		$helpText = str_replace("'", "&apos;", $helpText);
		$helpText = str_replace('"', "&quot;", $helpText);
		$this->options[] = [
				'name' => $label,
				'value' => $value,
				'selected' => false,
				'helpText' => $helpText
		];
		if ( ($selected === true) || (count($this->options) === 1) ) {
			$this->setValue($value);
		}
	}
	public function setValue(string $value):void {
		if ($this->options == null) {
			$this->options = [];
		}
		foreach ($this->options as $index => $element) {
			if ($element['value'] == $value) {
				$this->options[$index]['selected'] = true;
			} else {
				$this->options[$index]['selected'] = false;
			}
		}
		parent::setValue($value);
	}
	/**
	 * Returns the value of the selected option.
	 * @return string the value of the selected option or null if no option
	 * is selected
	 */
	public function getValue():string {
		foreach ($this->options as $element) {
			if ($element['selected']) {
				return $element['value'];
			}
		}
		return null;
	}
	/**
	 * Returns the name of the selected item.
	 * @return string the name of the selected option or NULL if no option is
	 * selected
	 */
	public function getReadableValue():string {
		foreach ($this->options as $element) {
			if ($element['selected']) {
				return $element['name'];
			}
		}
		return null;
	}
	public function getHtml():string {
		if (count($this->options) == 0) {
			throw new Exception('No options defined');
		}
		$selectedText = $this->options[0]['name'];
		$selectedValue = $this->options[0]['value'];
		$helpText = $this->options[0]['helpText'];
		foreach ($this->options as $element) {
			if ($element['selected']) {
				$selectedText = $element['name'];
				$selectedValue = $element['value'];
				$helpText = $element['helpText'];
			}
		}
		$this->button->setText($selectedText);
		$this->button->addAttribute('data-label', $this->getLabelText());
		$this->button->disableHiddenInputExport();
		$this->button->setOnClick('ant_inputSelect_start(this)');
		$code = $this->button->getHtml();
		$code .= '<select name="'.$this->getName().'"';
		if ($this->getHtmlId() !== '') {
			$code .= ' id="'.$this->getHtmlId().'"';
		}
		if ($this->getDefaultValue() !== NULL) {
			$code .= ' data-default = "'.$this->getDefaultValue().'"';
		}
		$code .= ' data-visible-element-id="'.$this->button->getHtmlId().'"';
		if ($this->beforeCallback !== '') {
			$code .= ' data-pre = "'.$this->beforeCallback.'"';
		}
		if ($this->getValidation() !== '') {
			$code .= ' data-validate = "'.$this->getValidation().'"';
		}
		if ($this->afterCallback !== '') {
			$code .= ' data-post = "'.$this->afterCallback.'"';
		}
		$code .= $this->getAttributesAsText();
		$code .= '>';
		foreach ($this->options as $option) {
			$code .= '<option value="'.$option['value'].'"';
			if ($option['value'] === $selectedValue) {
				$code .= ' selected';
			}
			if ($option['helpText'] !== '') {
				$code .= ' label="'.$option['helpText'].'"';
				$code .= ' data-help="'.$option['helpText'].'"';
			}
			$code .= '>';
			$code .= htmlspecialchars($option['name']).'</option>';
		}
		$code .= '</select>';
		$code .= '<div';
		if ($helpText === '') {
			$code .= ' class="ant-hidden"';
		}
		$code .= '>'.htmlspecialchars($helpText).'</div>';
		$this->setHtmlCode($code);
		return parent::getHtml();
	}
}
?>