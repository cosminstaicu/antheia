<?php
namespace Antheia\Antheia\Classes\Input;
/**
 * A textarea input
 * @author Cosmin Staicu
 */
class InputTextarea extends AbstractInput {
	private $placeholder;
	private $maxLength;
	private $rows;
	private static $globalMaxLength = 0;
	public function __construct() {
		parent::__construct();
		$this->rows = 5;
		$this->maxLength = self::$globalMaxLength;
	}
	/**
	 * Defines the default maximum length for all textarea inputs.
	 * The instances defined prior to this method call are not affected.
	 * @param int $maxLength the default maximum length for all text inputs
	 * or 0 if no limit is defined
	 */
	public static function setGlobalMaxLength(int $maxLength):void {
		self::$globalMaxLength = $maxLength;
	}
	/**
	 * Defines the number of rows for the textarea
	 * @param integer $rows the number of rows for the textarea
	 */
	public function setRows(int $rows):void {
		$this->rows = $rows;
	}
	/**
	 * Defines the text used as a placeholder inside the element
	 * @param string $text the placeholder text
	 */
	public function setPlaceholder(string $text):void {
		$this->placeholder = $text;
	}
	/**
	 * Defines the maximum length of the input
	 * @param int $max the maximum length of the input or 0 if the attribute
	 * is not required
	 */
	public function setMaxLength(int $max):void {
		$this->maxLength = $max;
	}
	public function getHtml():string {
		$this->checkHtmlId();
		$code = '';
		$code .= '<textarea name="'.$this->getName().'" ';
		if ($this->placeholder != '') {
			$code .= ' placeholder="'.$this->placeholder.'"';
		}
		if ($this->getDefaultValue() !== NULL) {
			$code .= ' data-default="'.$this->getDefaultValue().'"';
		}
		if ($this->getHtmlId() !== '') {
			$code .= ' id="'.$this->getHtmlId().'"';
		}
		if ($this->maxLength != 0) {
			$code .= ' maxlength="'.$this->maxLength.'" ';
		}
		if ($this->getValidation() !== '') {
			$code .= ' data-validate = "'.$this->getValidation().'"';
			$callback = 'ant_forms_updateStatus(\''.$this->getHtmlId().'\')';
			$code .= ' onchange = "'.$callback.'"'
					.' onkeyup = "'.$callback.'"'
					.' onblur = "'.$callback.'"';
		}
		$code .= $this->getAttributesAsText();
		$code .= ' rows="'.$this->rows.'">';
		$code .= str_replace("\n", '&#10;', htmlspecialchars($this->getValue()));
		$code .= '</textarea>';
		parent::setHtmlCode($code);
		return parent::getHtml();
	}
}
?>