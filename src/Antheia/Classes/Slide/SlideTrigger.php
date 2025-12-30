<?php
namespace Antheia\Antheia\Classes\Slide;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Internals;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Interfaces\HtmlAttribute;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
/**
 * The controller for container toggle in a slide panel. This class should
 * not be directlly called by the user. Instead, the controller should be
 * returned by calling the getController() method from the slide panel
 * @author Cosmin Staicu
 */
class SlideTrigger extends AbstractClass 
implements HtmlCode, HtmlAttribute, HtmlId {
	private $htmlId;
	private $testId;
	private $name;
	private $panel;
	private $displayIcon;
	private $attributes;
	private $postCallback;
	public function __construct(?SlidePanel $container) {
		parent::__construct();
		if ($container === null) {
			throw new Exception('No container defined');
		}
		$this->setText('');
		$this->htmlId = '';
		$this->testId = '';
		$this->setDisplayIcon(true);
		$this->panel = $container;
		$this->attributes = [];
		$this->setAfterCallback('');
	}
	/**
	 * Defines a function that will be called after the default action of the
	 * trigger has finished
	 * @param string $functionName the name (just the name) of the javascript
	 * function that will be called, with the "this" parameter
	 */
	public function setAfterCallback(string $functionName):void {
		$this->postCallback = $functionName;
	}
	public function addAttribute(string $name, string $value):void {
		$this->attributes[$name] = $value;
	}
	public function addTextAttribute(string $name, string $value):void {
		$this->addAttribute('data-text-'.$name, Texts::get($value));
	}
	/**
	 * Defines if the icon left to the button will be displayed
	 * @param boolean $status true if the icon is displayed, false if not
	 */
	public function setDisplayIcon(bool $status):void {
		$this->displayIcon = $status;
	}
	public function setHtmlId($id):void {
		$this->htmlId = $id;
	}
	public function setTestId(string $id):void {
		$this->testId = $id;
	}
	/**
	 * Defines the text on the trigger
	 * @param string $text the text displayed on the trigger
	 */
	public function setText(string $text):void {
		$this->name = $text;
	}
	public function getHtml():string {
		$code = '<button type="button" class="ant_slide-button';
		if ($this->displayIcon) {
			$code .= ' ant-icon';
		}
		$code .= '" data-container="'.$this->panel->getHtmlId().'"';
		$code .= Internals::getHtmlIdCode($this->htmlId, $this->testId);
		foreach ($this->attributes as $name => $value) {
			$code .= ' '.$name.'="'.$value.'"';
		}
		if ($this->postCallback !== '') {
			$code .= ' data-post="'.$this->postCallback.'"';
		}
		$code .= ' onClick="ant_slide_click(this)">';
		if ($this->name !== '') {
			$code .= $this->name;
		}
		$code .= '</button>';
		return $code;
	}
}
?>