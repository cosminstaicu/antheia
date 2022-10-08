<?php
namespace Cosmin\Antheia\Classes\Page;
use Cosmin\Antheia\Classes\Form;
use Cosmin\Antheia\Classes\Html;
/**
 * A page that redirects the user to another page. It uses a html form, that
 * can have parameters. After the page has been loaded, the form is auto submitted.
 * @author Cosmin Staicu
 *
 */
class PageRedirect extends AbstractPage {
	private $form;
	private $doNotInit;
	public function __construct() {
		parent::__construct();
		$this->form = new Form();
		$this->form->setHtmlId('jsf_form');
		$this->doNotInit = false;
	}
	/**
	 * Calling the method will generate the html code, without submitting
	 * the redirect form. It can be used for debugging, when you need to see
	 * the html code.
	 */
	public function doNotInit():void {
		$this->doNotInit = true;
	}
	/**
	 * Adds a parameter that will be sent to the destination page on redirect.
	 * @param string $name the name of the parameter
	 * @param string $value the value of the parameter
	 */
	public function addParameter(string $name, string $value):void {
		$this->form->addElement(new Html(
			'<input type="hidden" name="'.$name
			.'" value="'.htmlspecialchars($value).'">'
		));
	}
	/**
	 * Defines the protocol used for sending the form redirect parameters
	 * @param integer $method the method used for sending data to the server
	 * (like Form::METHOD::##)
	 * @see Form::setMethod()
	 */
	public function setMethod($method) {
		$this->form->setMethod($method);
	}
	/**
	 * Defines the redirect to url.
	 * @param string $url the url for the action attribute of the form
	 */
	public function setUrl(string $url):void {
		$this->form->setAction($url);
	}
	public function getHtml():string {
		if (!$this->doNotInit) {
			$this->addOnLoad("document.getElementById('jsf_form').submit()");
		}
		$this->addElement($this->form);
		return parent::getHtml();
	}
}
?>