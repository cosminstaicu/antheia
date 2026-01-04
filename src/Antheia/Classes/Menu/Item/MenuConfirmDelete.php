<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Interfaces\BeforeAfterCallback;
/**
 * The class defines a button that, when pressed, asks for a delete confirmation
 * before initiating a (delete) action. When the confirmation is valid the
 * button will either submit a form or call a javascript function.
 * If the method setUrl is called then a form will be submitted.
 * If the method setAfterCallback is called then a javascript function will
 * be called.
 * If both methods are called or no method is called then an exception will be
 * thrown.
 * @author Cosmin Staicu
 */
class MenuConfirmDelete extends MenuDelete implements BeforeAfterCallback {
	private $url;
	private $paramValue;
	private $paramName;
	private $formTarget;
	private $beforeCallback;
	private $afterCallback;
	public function __construct() {
		parent::__construct();
		$this->setRender(self::BUTTON);
		parent::setOnClick('ant_deleteConfirmation(this)');
		$this->paramName = 'id';
		$this->formTarget = '';
		$this->beforeCallback = '';
		$this->afterCallback = '';
		$this->url = '';
		$this->paramValue = null;
	}
	public function setOnClick(string $onClick):void {
		throw new Exception('OnClick function is not available. Use setAfterCallback()');
	}
	/**
	 * Defines the URL where the delete request will be sent. For a form to be
	 * submitted then the method setAfterCallback must not be called.
	 * @param string $url the URL where the delete request will be sent or
	 * an empy string if no form needs to be submitted
	 */
	public function setUrl(string $url):void {
		$this->url = $url;
	}
	/**
	 * Defines the value to be sent with the delete request. This value is
	 * the id (from the database) of the element to be deleted
	 * @param string $id the id of the item to be deleted
	 */
	public function setItemId(string $id):void {
		$this->paramValue = $id;
	}
	public function setBeforeCallback(string $functionName):void {
		$this->beforeCallback = $functionName;
	}
	/**
	 * Defines a javascript function that will be called after the user confirmed
	 * the deletion. Warning! This function is only called if no url for
	 * the form has been provided. If a URL is provided (using the serUrl method)
	 * then this method is never called
	 * @param string $functionName the name (just the name) of the javascript
	 * function that will be called, with the "this" parameter If an empty string
	 * is provided then no function will be called.
	 */
	public function setAfterCallback(string $functionName):void {
		$this->afterCallback = $functionName;
	}
	/**
	 * Defines the target of the form used for the delete request
	 * @param string $target the target for the form.
	 */
	public function setFormTarget(string $target):void {
		$this->formTarget = $target;
	}
	/**
	 * Defines the name of the parameter that contains the id of the item
	 * to be deleted. If this method is not called then the default
	 * parameter name is "id"
	 * @param string $name the parameter name
	 */
	public function setParamName(string $name):void {
		$this->paramName = $name;
	}
	public function getHtml():string {
		if ( ($this->url === '') && ($this->afterCallback === '') ) {
			throw new Exception('URL not defined, afterCallback not defined. Please choose one of them.');
		}
		if ( ($this->url !== '') && ($this->afterCallback !== '') ) {
			throw new Exception('Both URL and afterCallback are defined, use only one.');
		}
		if (($this->afterCallback === '') && ($this->paramValue === null)) {
			throw new Exception('Item ID is not defined');
		}
		if (($this->afterCallback !== '') && ($this->paramValue === null)) {
			// param value is set with an empty string as it is not used
			// because the menu will trigger the javascript afterCallback
			// method
			$this->paramValue = '';
		}
		$this->addAttribute('data-url', $this->url);
		$this->addAttribute('data-input-value', $this->paramValue);
		$this->addAttribute('data-input-name', $this->paramName);
		$this->addAttribute('data-target', $this->formTarget);
		$this->addAttribute('data-pre', $this->beforeCallback);
		$this->addAttribute('data-post', $this->afterCallback);
		$this->addTextAttribute('button', 'DELETE');
		$this->addTextAttribute('info', 'TYPE_DELETE');
		$this->addTextAttribute('template', 'VALUE_FOR_DELETE_CONFIRMATION');
		$this->addTextAttribute('error', 'DELETE_CONFIRMATION_INVALID');
		return parent::getHtml();
	}
}
?>
