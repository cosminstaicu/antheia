<?php
namespace Antheia\Antheia\Classes\Input;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Exception;
/**
 * Abstract class to be extended by all text type inputs
 * (text, password, phone, numbers etc.)
 * @author Cosmin Staicu
 */
abstract class AbstractInputText extends AbstractInput {
	const TYPE_TEXT = 1;
	const TYPE_PASSWORD = 2;
	const TYPE_PHONE = 3;
	const TYPE_EMAIL = 4;
	const TYPE_NUMBER = 5;
	private $placeholder;
	private $type;
	private $icon;
	private $maxLength;
	private static $globalMaxLength = 0;
	public function __construct() {
		parent::__construct();
		$this->setType(self::TYPE_TEXT);
		$this->icon = null;
		$this->setPlaceholder('');
		$this->maxLength = self::$globalMaxLength;
	}
	/**
	 * Defines the default maximum length for all text based inputs (passwords,
	 * text, phones, numbers etc.).
	 * The instances defined prior to this method call are not affected.
	 * @param int $maxLength the default maximum length for all text inputs
	 * or 0 if no limit is defined
	 */
	public static function setGlobalMaxLength(int $maxLength):void {
		self::$globalMaxLength = $maxLength;
	}
	/**
	 * Defines the text used as a placeholder inside the element
	 * @param string $text the placeholder text
	 */
	public function setPlaceholder(string $text):void {
		$this->placeholder = $text;
	}
	/**
	 * Defines the symbol displayed on the right side of the input.
	 * @param integer $icon the icon to be displayed, as a constant like
	 * IconVector::ICON_## or null if no symbol will be displayed
	 */
	public function setIcon(int $icon):void {
		if ($icon !== null) {
			$this->icon = new IconVector();
			$this->icon->setIcon($icon);
		} else {
			$this->icon = null;
		}
	}
	/**
	 * Defines the input type.
	 * @param integer $type input type as a constant like
	 * AbstractInputText::TIP_##
	 */
	protected function setType(int $type):void {
		$this->type = $type;
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
		$code = '<input type="';
		switch ($this->type) {
			case self::TYPE_TEXT:
				$code .= 'text" ';
				break;
			case self::TYPE_PASSWORD:
				$code .= 'password" ';
				break;
			case self::TYPE_PHONE:
				$code .= 'tel" ';
				break;
			case self::TYPE_EMAIL:
				$code .= 'email" ';
				break;
			case self::TYPE_NUMBER:
				$code .= 'number" ';
				break;
			default:
				throw new Exception($this->type);
		}
		$code .= ' name="'.$this->getName().'" value="';
		$code .= htmlspecialchars($this->getValue()).'"';
		if ($this->placeholder !== '') {
			$code .= ' placeholder="'.$this->placeholder.'"';
		}
		if ($this->getDefaultValue() !== NULL) {
			$code .= ' data-default="'.$this->getDefaultValue().'" ';
		}
		$code .= $this->getAttributesAsText();
		if ($this->getValidation() !== '') {
			$code .= ' data-validate="'.$this->getValidation().'"';
			$function = 'ant_forms_updateStatus(\''.$this->getHtmlId().'\')';
			$code .= ' onchange = "'.$function.'"'
					.' onkeyup = "'.$function.'"'
					.' onblur = "'.$function.'"';
		}
		if ($this->getHtmlId() !== '') {
			$code .= ' id="'.$this->getHtmlId().'" ';
		}
		if ($this->maxLength != 0) {
			$code .= ' maxlength="'.$this->maxLength.'" ';
		}
		$code .= '>';
		if ($this->icon !== null) {
			$code .= $this->icon->getHtml();
		}
		parent::setHtmlCode($code);
		return parent::getHtml();
	}
}
?>