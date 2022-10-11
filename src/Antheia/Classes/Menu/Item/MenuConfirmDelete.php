<?php
namespace Cosmin\Antheia\Classes\Menu\Item;
use Cosmin\Antheia\Classes\Exception;
/**
 * The class defines a button that, when pressed, asks for a delete confirmation
 * before initiating a (delete) action
 * @author Cosmin Staicu
 */
class MenuConfirmDelete extends MenuDelete {
	private $url;
	private $paramValue;
	private $paramName;
	private $formTarget;
	private $beforeCallback;
	public function __construct() {
		parent::__construct();
		$this->setHref('javascript:void(0)');
		$this->setOnClick('ant_deleteConfirmation(this)');
		$this->paramName = 'id';
		$this->formTarget = '';
		$this->beforeCallback = '';
		$this->url = null;
		$this->paramValue = null;
	}
	/**
	 * Defines the URL where the delete request will be sent
	 * @param string $url the URL where the delete request will be sent
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
	/**
	 * Defines a function that will be called before displaying the graphics for
	 * the confirmation
	 * @param string $functionName the name (just the name) of the javascript 
	 * function that will be called, with the "this" parameter
	 */
	public function setBeforeCallback(string $javascript):void {
		$this->beforeCallback = $javascript;
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
		if ($this->url === null) {
			throw new Exception('URL is not defined');
		}
		if ($this->paramValue === null) {
			throw new Exception('Item ID is not defined');
		}
		$this->addAttribute('data-url', $this->url);
		$this->addAttribute('data-input-value', $this->paramValue);
		$this->addAttribute('data-input-name', $this->paramName);
		$this->addAttribute('data-target', $this->formTarget);
		$this->addAttribute('data-pre', $this->beforeCallback);
		$this->addTextAttribute('button', 'DELETE');
		$this->addTextAttribute('info', 'TYPE_DELETE');
		$this->addTextAttribute('template', 'VALUE_FOR_DELETE_CONFIRMATION');
		$this->addTextAttribute('error', 'DELETE_CONFIRMATION_INVALID');
		return parent::getHtml();
	}
}
?>