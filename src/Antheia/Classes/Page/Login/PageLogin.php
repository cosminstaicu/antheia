<?php
namespace Antheia\Antheia\Classes\Page\Login;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Form;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Input\NewInput;
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
			document.getElementById("ant_recaptha-answer").value = result;
			document.getElementById("ant_login-action").classList.remove("ant_login-wait-recaptcha");
		}
		function formValidation() {
			if (!usernameValid()) {
				AntheiaAlert.quickError("'.Texts::get('USERNAME_3_CHARACTERS').'", () => {
					document.getElementById("username").focus();
				});
				return false;
			}
			if (!passwordValid()) {
				AntheiaAlert.quickError("'.Texts::get('PASSWORD_3_CHARACTERS').'", () => {
					document.getElementById("password").focus();
				});
				return false;
			}
			if (document.getElementById("ant_recaptha-answer") !== null) {
				if (document.getElementById("ant_recaptha-answer").value === "") {
					AntheiaAlert.quickError("Recaptcha error");
					return false;
				}
			}
			document.getElementById("ant_login-submit").value="'.Texts::getLc('LOADING').'";
			document.getElementById("ant_login-submit").disabled = true;
			return true;
		}';
		$this->addJavascript($javascript);
		$this->addOnLoad('document.getElementById(\'username\').focus()');
		$form = new Form();
		if ($this->recaptchaKey !== NULL) {
			$this->addJavascriptFile('https://www.google.com/recaptcha/api.js');
			$this->addBodyClass('ant-hasRecaptcha');
		}
		if ($this->url == '') {
			throw new Exception('URL not defined');
		}
		$form->setAction($this->url);
		$form->setOnSubmit('formValidation();');
		// username
		$username = NewInput::text();
		$username->addAttribute('autocomplete', 'username');
		$username->setIcon('user');
		$username->setNameId('username');
		$username->setLabel(Texts::get('USERNAME'));
		$username->setPlaceholder('username');
		$form->addElement($username);
		// password
		$password = NewInput::password();
		$password->addAttribute('autocomplete', 'current-password');
		$password->setPlaceholder(Texts::getLc('PASSWORD'));
		$password->setNameId('password');
		$password->setLabel(Texts::get('PASSWORD'));
		$form->addElement($password);
		$actionDiv = new Html();
		$actionDiv->addRawCode('<div');
		if ($this->recaptchaKey !== NULL) {
			$actionDiv->addRawCode(' id="ant_login-action" class="ant_login-wait-recaptcha"');
		}
		$actionDiv->addRawCode('>');
		if ($this->rememberLogin) {
			$remember = NewInput::checkbox();
			$remember->setNameId('autologin');
			$remember->setValue('ok');
			$remember->setLabel(Texts::get('REMEMBER_LOGIN'));
			$remember->setChecked();
			$actionDiv->addElement($remember);
		}
		// submit button
		$submit = NewInput::submit();
		$submit->setHtmlId('ant_login-submit');
		$submit->setValue(Texts::get('LOGIN'));
		$actionDiv->addElement($submit);
		if ($this->recaptchaKey !== NULL) {
			$actionDiv->addElement(new Html('
			<input type="hidden" name="recaptcha" id="ant_recaptha-answer" value="">
			<div class="g-recaptcha" data-callback="recaptchaSolved"
			id="ant_login-recaptcha" data-sitekey="'.$this->recaptchaKey.'"></div>
			</div>
			'));
		}
		$form->addElement($actionDiv);
		$this->getContent()->addElement($form);
		return parent::getHtml();
	}
}
?>