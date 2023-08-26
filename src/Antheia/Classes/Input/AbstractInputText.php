<?php
namespace Antheia\Antheia\Classes\Input;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Icon\IconVector;
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
	private $suggestionLimit;
	private $suggestionUrl;
	private static $globalMaxLength = 0;
	public function __construct() {
		parent::__construct();
		$this->setType(self::TYPE_TEXT);
		$this->icon = null;
		$this->setPlaceholder('');
		$this->maxLength = self::$globalMaxLength;
		$this->suggestionLimit = null;
		$this->suggestionUrl = null;
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
	/**
	 * Enables (or disables) the suggestions for the input. Suggestions are loaded
	 * from the server and then cached. The minimum length for showing suggestions
	 * can be set up using the $limit parameter
	 * @param integer $limit the limit of the input for the query. If null then
	 * suggestions are disabled. If a number is provided then the suggestions will
	 * be enabled when the length of the typed value is egual of greater then
	 * $limit. A request for suggestion update is sent to the server when the
	 * first $limit characters are different then the last request.
	 * @param string $url the url where the request for suggestions will be sent
	 * of null if the suggestions are disabled.
	 */
	public function setSuggestion(?int $limit, string $url = NULL):void {
		$this->suggestionLimit = $limit;
		if ($limit === NULL) {
			if ($url !== NULL) {
				throw new Exception('If $limit is null then $url must be also null');
			}
		}
		$this->suggestionUrl = $url;
	}
	public function getHtml():string {
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
		if ($this->suggestionLimit !== NULL) {
			$code .= ' data-suggestion-last-request="'.uniqid().'"';
			$code .= ' data-suggestion-limit='.$this->suggestionLimit.' ';
			$code .= ' data-suggestion-url="'.$this->suggestionUrl.'" ';
		}
		$code .= $this->getAttributesAsText();
		$onChange = '';
		$onFocus = '';
		$onKeyUp = '';
		$onKeyDown = '';
		$onBlur = '';
		if ($this->getValidation() !== '') {
			$code .= ' data-validate="'.$this->getValidation().'"';
			$function = 'ant_forms_updateStatus(\''.$this->getHtmlId().'\');';
			$onChange .= $function;
			$onKeyUp .= $function;
			$onBlur .= $function;
		}
		if ($this->suggestionLimit !== NULL) {
			$function = 'ant_inputText_updateSuggestions(this);';
			$onChange .= $function;
			$onKeyUp .= $function;
			$onFocus .= $function;
			$onKeyDown .= 'ant_inputText_keydown(event)';
		}
		if ($onChange !== '') {
			$code .= ' onchange = "'.$onChange.'"';
		}
		if ($onKeyUp !== '') {
			$code .= ' onkeyup = "'.$onKeyUp.'"';
		}
		if ($onKeyDown !== '') {
			$code .= ' onkeydown = "'.$onKeyDown.'"';
		}
		if ($onBlur !== '') {
			$code .= ' onblur = "'.$onBlur.'"';
		}
		if ($onFocus !== '') {
			$code .= ' onfocus = "'.$onFocus.'"';
		}
		if ($this->getHtmlId() !== '') {
			$code .= ' id="'.$this->getHtmlId().'" ';
		}
		if ($this->maxLength != 0) {
			$code .= ' maxlength="'.$this->maxLength.'" ';
		}
		if ($this->suggestionLimit !== NULL) {
			$code .= ' autocomplete="off"';
		}
		$code .= '>';
		if ($this->icon !== null) {
			$code .= $this->icon->getHtml();
		}
		if ($this->suggestionLimit !== NULL) {
			$code .= '<div class="ant_inputText_suggestions"><div></div></div>';
		}
		parent::setHtmlCode($code);
		return parent::getHtml();
	}
}
?>