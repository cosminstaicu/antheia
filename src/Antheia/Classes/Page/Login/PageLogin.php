<?php
namespace Cosmin\Antheia\Classes\Page\Login;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Form;
use Cosmin\Antheia\Classes\Exception;
use Cosmin\Antheia\Classes\Input\InputText;
use Cosmin\Antheia\Classes\Icon\IconVector;
use Cosmin\Antheia\Classes\Input\InputPassword;
use Cosmin\Antheia\Classes\Html;
use Cosmin\Antheia\Classes\Input\InputCheckbox;
use Cosmin\Antheia\Classes\Input\InputSubmit;
/**
 * A page for entering credentials, to login to an app
 * @author Cosmin Staicu
 */
class PageLogin extends AbstractPageLogin {
	private $url;
	private $rememberLogin;
	private $recaptchaKey;
	public function __construct() {
		parent::__construct();
		$this->url = '';
		$this->rememberLogin = false;
		$this->recaptchaKey = NULL;
	}
	/**
	 * Enables or disables the google recaptcha verification on the login page
	 * @param string|NULL $key the public key for the recaptcha module or
	 * NULL if the recaptcha module is inactive
	 */
	public function setRecaptcha(string $key = NULL):void {
		$this->recaptchaKey = $key;
	}
	/**
	 * Defines the URL for submitting the form with the credentials
	 * @param string $url the URL for submitting the form with credentials
	 */
	public function setUrl(string $url):void {
		$this->url = $url;
	}
	/**
	 * Defines if a checkbox with "remember login" should be displayed
	 * @param boolean $status true if a checkbox should be displayed, false if not
	 */
	public function setRememberLogin(bool $status = true):void {
		$this->rememberLogin = $status;
	}
	public function getHtml():string {
		$javascript = '
		function usernameValid() {
			if (document.getElementById("username").value.length < 3) {
				return false;
			} else {
				return true;
			}
		}
		function passwordValid() {
			if (document.getElementById("password").value.length < 3) {
				return false;
			} else {
				return true;
			}
		}
		function recaptchaSolved(result) {
			document.getElementById("jsf_recaptha-answer").value = result;
			document.getElementById("jsf_login-action").classList.remove("jsf_login-wait-recaptcha");
		}
		function formValidation() {
			if (!usernameValid()) {
				jsf_alert.quickError("'.Texts::get('USERNAME_3_CHARACTERS').'", () => {
					document.getElementById("username").focus();
				});
				return false;
			}
			if (!passwordValid()) {
				jsf_alert.quickError("'.Texts::get('PASSWORD_3_CHARACTERS').'", () => {
					document.getElementById("password").focus();
				});
				return false;
			}
			if (document.getElementById("jsf_recaptha-answer") !== null) {
				if (document.getElementById("jsf_recaptha-answer").value === "") {
					jsf_alert.quickError("Recaptcha error");
					return false;
				}
			}
			document.getElementById("jsf_login-submit").value="'.Texts::getLc('LOADING').'";
			document.getElementById("jsf_login-submit").disabled = true;
			return true;
		}';
		$this->addJavascript($javascript);
		$this->addOnLoad('document.getElementById(\'username\').focus()');
		$form = new Form();
		if ($this->recaptchaKey !== NULL) {
			$this->addJavascriptFile('https://www.google.com/recaptcha/api.js');
			$this->addBodyClass('jsf-hasRecaptcha');
		}
		if ($this->url == '') {
			throw new Exception('URL not defined');
		}
		$form->setAction($this->url);
		$form->setOnSubmit('formValidation();');
		// username
		$username = new InputText();
		$username->addAttribute('autocomplete', 'username');
		$username->setIcon(IconVector::ICON_USER);
		$username->setNameId('username');
		$username->setLabel(Texts::get('USERNAME'));
		$username->setPlaceholder('username');
		$form->addElement($username);
		// parola
		$password = new InputPassword();
		$password->addAttribute('autocomplete', 'current-password');
		$password->setPlaceholder(Texts::getLc('PASSWORD'));
		$password->setNameId('password');
		$password->setLabel(Texts::get('PASSWORD'));
		$form->addElement($password);
		$actionDiv = new Html();
		$actionDiv->addRawCode('<div');
		if ($this->recaptchaKey !== NULL) {
			$actionDiv->addRawCode(' id="jsf_login-action" class="jsf_login-wait-recaptcha"');
		}
		$actionDiv->addRawCode('>');
		if ($this->rememberLogin) {
			$remember = new InputCheckbox();
			$remember->setNameId('autologin');
			$remember->setValue('ok');
			$remember->setLabel(Texts::get('REMEMBER_LOGIN'));
			$remember->setChecked();
			$actionDiv->addElement($remember);
		}
		// buton submit
		$submit = new InputSubmit();
		$submit->setHtmlId('jsf_login-submit');
		$submit->setValue(Texts::get('LOGIN'));
		$actionDiv->addElement($submit);
		if ($this->recaptchaKey !== NULL) {
			$actionDiv->addElement(new Html('
			<input type="hidden" name="recaptcha" id="jsf_recaptha-answer" value="">
			<div class="g-recaptcha" data-callback="recaptchaSolved"
			id="jsf_login-recaptcha" data-sitekey="'.$this->recaptchaKey.'"></div>
			</div>
			'));
		}
		$form->addElement($actionDiv);
		$this->getContent()->addElement($form);
		return parent::getHtml();
	}
}
?>