<?php
namespace Antheia\Antheia\Classes;
use Antheia\Antheia\Classes\Panel\PanelInput;
use Antheia\Antheia\Classes\Wireframe\Wireframe;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
/**
 * A regular form tag
 * @author Cosmin Staicu
 */
class Form extends AbstractClass implements HtmlCode, HtmlId {
	const METHOD_GET = 1;
	const METHOD_POST = 2;
	private $action;
	private $method;
	private $onSubmit;
	private $htmlId;
	private $fileMode;
	private $items;
	private $target;
	private $classes;
	public function __construct() {
		parent::__construct();
		$this->action = '';
		$this->method = self::METHOD_POST;
		$this->onSubmit = 'ant_loading_start(true)';
		$this->items = [];
		$this->htmlId = '';
		$this->fileMode = false;
		$this->target = '';
		$this->classes = [];
	}
	/**
	 * Calling the method will display the form using the maximum available
	 * height (100%)
	 */
	public function setFullHeight():void {
		$this->addClass('ant-max-height');
	}
	/**
	 * Adds a class to the html tag definition
	 * @param string $class the class to be added
	 */
	public function addClass(string $class):void {
		$this->classes[] = $class;
	}
	/**
	 * Calling the method will enable the form to send files to the server.
	 * If this method is not called, but the form contains input=file
	 * tags, then those tags will be ignored when the form is submitted
	 */
	public function setFileMode():void {
		$this->fileMode = true;
	}
	/**
	 * Defines the target of the form (the target attribute from the html tag)
	 * @param string $target the value to be inserted into the target tag or
	 * an empty string if no target is required
	 */
	public function setTarget(string $target):void {
		$this->target = $target;
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	/**
	 * Defines the location where the form data will be submitted
	 * @param string $url the location where the form data will be submitted
	 */
	public function setAction(string $url):void {
		$this->action = $url;
	}
	/**
	 * Defines the method used for submitting data
	 * @param integer $method the method used for submitting data, using
	 * a constant like Form::METHOD_##
	 */
	public function setMethod(string $method):void {
		$this->method = $method;
	}
	/**
	 * Defines a javascript function, to be executed just before submitting
	 * the form.
	 * @param string $code the javascript code to be executed or an
	 * empty string if no onSubmit code is required. The code will be
	 * automatically prefixed with the "return " string
	 */
	public function setOnSubmit(string $code):void {
		$this->onSubmit = $code;
	}
	/**
	 * Adds an html item to the form content
	 * @param HtmlCode $item the item to be added
	 */
	public function addElement(HtmlCode $item):void {
		$this->items[] = $item;
	}
	/**
	 * Adds a new PanelInput to the form and returns it
	 * @return PanelInput the panel that was added to the form
	 */
	public function addInputPanel():PanelInput {
		$panel = new PanelInput();
		$this->addElement($panel);
		return $panel;
	}
	/**
	 * Adds a new wireframe to the form and returns the new wireframe instance
	 * @string $type (optional) (default Wireframe::TYPE_FIXED)
	 * the wireframe type, as a constant like Wireframe::TYPE_XXXX
	 * @return Wireframe the added wireframe
	 */
	public function addWireframe(string $type = Wireframe::TYPE_FIXED):Wireframe {
		$wireframe = new Wireframe();
		$wireframe->setType($type);
		$this->addElement($wireframe);
		return $wireframe;
	}
	/**
	 * Adds a hidden input to the form
	 * @param string $name the name of the hidden input
	 * @param string $value the value of the hidden input
	 * @param string $id (optional) an html id to be assigned to the input
	 * or an empty string, if no id is required
	 */
	public function addHiddenInput(string $name, string $value, string $id = ''):void {
		if ($id !== '') {
			$id = ' id="'.$id.'"';
		}
		$this->addElement(new Html(
			'<input type="hidden" name="'.$name.'"'.$id.' value="'.$value.'">'
		));
	}
	public function getHtml():string {
		if ($this->action == '') {
			throw new Exception('Form action is not defined');
		}
		$code = '<form action="'.$this->action.'" method="';
		switch ($this->method) {
			case self::METHOD_GET:
				$code .= 'get';
				break;
			case self::METHOD_POST:
				$code .= 'post';
				break;
			default:
				throw new Exception($this->method);
		}
		$code .= '"';
		if ($this->onSubmit != '') {
			$code .= ' onSubmit="return '.$this->onSubmit.'"';
		}
		if ($this->target != '') {
			$code .= ' target="'.$this->target.'"';
		}
		if ($this->htmlId != '') {
			$code .= ' id="'.$this->htmlId.'"';
		}
		if ($this->fileMode) {
			$code .= ' enctype="multipart/form-data" ';
		}
		if (count($this->classes) > 0) {
			$code .= ' class="'.implode(" ", array_unique($this->classes)).'" ';
		}
		$code .='>';
		/** @var HtmlCode $element */
		foreach ($this->items as $element) {
			$code .= $element->getHtml();
		}
		$code .= '</form>';
		return $code;
	}
}
?>