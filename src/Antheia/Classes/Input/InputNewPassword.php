<?php
namespace Antheia\Antheia\Classes\Input;
use Antheia\Antheia\Interfaces\BeforeAfterCallback;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Input\Raw\InputRawCustomButton;
/**
 * A button that, when clicked displays an interface to input a new password.
 * @author Cosmin Staicu
 */
class InputNewPassword extends AbstractInput implements BeforeAfterCallback  {
	private $button;
	private $username;
	private $beforeCallback;
	private $afterCallback;
	private $minLength;
	private $maxLength;
	private $justDigits;
	private $uppercase;
	private $lowercase;
	private $digits;
	private $symbols;
	private $initialText;
	private $finalText;
	public function __construct() {
		parent::__construct();
		$this->beforeCallback = '';
		$this->afterCallback = '';
		$this->button = new InputRawCustomButton();
		$this->button->addAttribute('data-ant-type', 'newPassword');
		$this->username = '';
		$this->minLength = 3;
		$this->maxLength = 30;
		$this->justDigits = 'no';
		$this->uppercase = 'no';
		$this->lowercase = 'no';
		$this->digits = 'no';
		$this->symbols = 'no';
		$this->initialText = '---';
		$this->finalText = '******';
	}
	/**
	 * Defines the text initially displayed on the button
	 * @param string $text the text initially displayed on the button
	 */
	public function setInitialText(string $text):void {
		$this->initialText = $text;
	}
	/**
	 * Defines the text displayed on the button after the password has been
	 * defined by the user
	 * @param string $text the final text displayed on the button after the
	 * password has been defined by the user
	 */
	public function setFinalText(string $text):void {
		$this->finalText = $text;
	}
	/**
	 * Defines the minimum and maximum length for the password
	 * @param int $minimum the minimum length for the password
	 * @param int $maximum (optional) the maximum length for the password 
	 * or 0 if no limit is required
	 */
	public function setLength (int $minimum, int $maximum = 0):void {
		if ($minimum < 3) {
			throw new Exception('Minimum length is 3 characters');
		}
		$this->minLength = $minimum;
		$this->maxLength = $maximum;
	}
	/**
	 * Calling the method will render the input to only accept digits
	 * (for defining a PIN number, for example)
	 */
	public function setOnlyDigits():void {
		$this->justDigits = 'yes';
	}
	/**
	 * Calling the method will render the input to validate the password if
	 * it contains at least one uppercase character
	 */
	public function mustContainUppercase():void {
		$this->uppercase = 'yes';
	}
	/**
	 * Calling the method will render the input to validate the password if
	 * it contains at least one lowercase character
	 */
	public function mustContainLowercase():void {
		$this->lowercase = 'yes';
	}
	/**
	 * Calling the method will render the input to validate the password if
	 * it contains at least one digit
	 */
	public function mustContainDigits():void {
		$this->digits = 'yes';
	}
	/**
	 * Calling the method will render the input to validate the password if
	 * it contains at least one special symbol
	 */
	public function mustContainSymbols():void {
		$this->symbols = 'yes';
	}
	/**
	 * Defines the username attached to the new password. It is not used
	 * by the script, it just enters the username in a display-none text field.
	 * It is required so the browser can save the new password in a keychain,
	 * if the user agrees.
	 * @param string $username the username for which the password is updated
	 */
	public function setUsername(string $username):void {
		$this->username = $username;
	}
	/**
	 * Returns the button that controls the script
	 * @return InputRawCustomButton the button that controls the script
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
	public function getHtml():string {
		if ($this->justDigits === 'yes') {
			if ($this->lowercase === 'yes') {
				throw new Exception(
					'Invalid rules: only digits - must contain uppercase'
				);
			}
			if ($this->uppercase === 'yes') {
				throw new Exception(
					'Invalid rules: only digits - must contain lowercase'
				);
			}
			if ($this->symbols === 'yes') {
				throw new Exception(
					'Invalid rules: only digits - must contain symbols'
				);
			}
		}
		$this->checkHtmlId();
		$this->button->setHiddenInputHtmlId($this->getHtmlId());
		$this->button->setHiddenInputName($this->getName());
		$this->button->setHiddenInputValue($this->getValue());
		if ($this->getDefaultValue() !== NULL) {
			$this->button->addHiddenInputAttribute(
					'data-default', $this->getDefaultValue());
		}
		foreach ($this->getAttributeList() as $info) {
			$this->button->addHiddenInputAttribute($info['name'], $info['value']);
		}
		$this->button->setText($this->initialText);
		$this->button->setIcon(IconVector::ICON_PASSWORD);
		$this->button->setOnClick('ant_inputNewPassword_start(this)');
		$this->button->addAttribute('data-digits', $this->digits);
		$this->button->addAttribute('data-label', $this->getLabelText());
		$this->button->addAttribute('data-lowercase', $this->uppercase);
		$this->button->addAttribute('data-max', $this->maxLength);
		$this->button->addAttribute('data-min', $this->minLength);
		$this->button->addAttribute('data-only-digits', $this->justDigits);
		$this->button->addAttribute('data-symbols', $this->symbols);
		$this->button->addAttribute('data-uppercase', $this->lowercase);
		$this->button->addAttribute('data-username', $this->username);
		$this->button->addTextAttribute('chr', 'CHARACTERS');
		$this->button->addTextAttribute('digits', 'PASSWORD_DIGITS');
		$this->button->addAttribute('data-text-final', $this->finalText);
		$this->button->addTextAttribute('identical', 'IDENTICAL_PASSWORDS');
		$this->button->addTextAttribute('lowercase', 'PASSWORD_LOWERCASE');
		$this->button->addTextAttribute('max', 'MAXIMUM');
		$this->button->addTextAttribute('min', 'MINIMUM');
		$this->button->addTextAttribute('must-contain', 'PASSWORD_MUST_CONTAIN');
		$this->button->addTextAttribute('new-password', 'NEW_PASSWORD');
		$this->button->addTextAttribute('only-digits', 'PASSWORD_ONLY_DIGITS');
		$this->button->addTextAttribute('retype', 'RETYPE_NEW_PASSWORD');
		$this->button->addTextAttribute('submit', 'SUBMIT');
		$this->button->addTextAttribute('symbols', 'PASSWORD_SPECIAL');
		$this->button->addTextAttribute('uppercase', 'PASSWORD_UPPERCASE');
		$this->button->addHiddenInputAttribute('data-pre', $this->beforeCallback);
		$this->button->addHiddenInputAttribute('data-post', $this->afterCallback);
		$this->button->addHiddenInputAttribute ('data-validate', $this->getValidation());
		$this->setHtmlCode($this->button->getHtml());
		return parent::getHtml();
	}
}
?>