<?php
namespace Cosmin\Antheia\Classes\Header\TopRightMenu;
use Cosmin\Antheia\Classes\AbstractClass;
use Cosmin\Antheia\Interfaces\HtmlCode;
use Cosmin\Antheia\Classes\Icon\IconVector;
use Cosmin\Antheia\Classes\Exception;
/**
 * Abstract class that is extended by all menu items that can be inserted into
 * the top right menu
 * @author Cosmin Staicu
 */
abstract class AbstractTopRightMenu extends AbstractClass implements HtmlCode {
	private $href;
	private $name;
	private $icon;
	private $startLoadingAnimationOnClick;
	private $targetBlank;
	public function __construct() {
		parent::__construct();
		$this->href = '';
		$this->name = '';
		$this->icon = new IconVector();
		$this->startLoadingAnimationOnClick = false;
		$this->targetBlank = false;
	}
	/**
	 * Defines if the action is executed in a new browser window or not
	 * (If a a target=_blank attribute will be inserted into the html tag)
	 * @param boolean $status (optional) (default true) if true then a new
	 * browser window will be opened on click
	 */
	public function setTargetBlank(bool $status = true):void {
		$this->targetBlank = $status;
	}
	/**
	 * The name of the menu (the text that will be displayed on the menu)
	 * @param string $name the name of the menu
	 */
	public function setName(string $name):void {
		$this->name = $name;
	}
	/**
	 * Defines the value that will be used for the href attribute
	 * @param string $href the href of the link (the action to be performed when
	 * the menu is pressed)
	 */
	public function setHref(string $href):void {
		$this->href = $href;
	}
	/**
	 * Defines the symbol used for the menu
	 * @param integer $icon the symbol used for the menu, as a constant like
	 * IconVector::ICON_##
	 */
	public function setIcon(int $icon):void {
		$this->icon->setIcon($icon);
	}
	/**
	 * Calling the method will set up the menu to trigger a loading animation
	 * when the menu is clicked
	 */
	public function startLoadingOnClick():void {
		$this->startLoadingAnimationOnClick = true;
	}
	public function getHtml():string {
		if ($this->name == '') {
			throw new Exception('Name is not defined');
		}
		if ($this->href == '') {
			throw new Exception('Href is not defined');
		}
		$code = '<a href="'.$this->href.'"';
		if ($this->startLoadingAnimationOnClick) {
			$code .= ' onClick="jsf_loading_start()"';
		}
		if ($this->targetBlank) {
			$code .= ' target="_blank" ';
		}
		$code .= '>';
		$code .= $this->icon->getHtml();
		$code .= '<span>'.$this->name.'</span></a>';
		return $code;
	}
}
?>