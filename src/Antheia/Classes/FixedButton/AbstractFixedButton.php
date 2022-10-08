<?php
namespace Cosmin\Antheia\Classes\FixedButton;
use Cosmin\Antheia\Classes\AbstractClass;
use Cosmin\Antheia\Interfaces\HtmlCode;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * Defines a fixed button to be displayed on the bottom-right side of the page
 * @author Cosmin Staicu
 */
abstract class AbstractFixedButton extends AbstractClass implements HtmlCode {
	private $href;
	private $onClick;
	private $icon;
	private $title;
	private $classes;
	public function __construct() {
		parent::__construct();
		$this->href = 'javascript:void(0)';
		$this->onClick = '';
		$this->icon = new IconVector();
		$this->icon->setSize(IconVector::SIZE_XL);
		$this->title = '';
		$this->classes = [];
	}
	/**
	 * The onClick script to be executed when the button is clicked
	 * @param string $code Javascript code to be executed when the button
	 * is clicked
	 */
	public function setOnClick(string $code):void {
		$this->onClick = $code;
	}
	/**
	 * The icon to be displayed on the button
	 * @param string $name the name of the simbol
	 * (a constant like IconVector::ICON_##) 
	 */
	public function setIcon(string $name):void {
		$this->icon->setIcon($name);
	}
	/**
	 * The title of the button
	 * @param string $title the title of the button (displayed on hover)
	 */
	public function setTitle(string $title):void {
		$this->title = $title;
	}
	/**
	 * Adds a class to the button html definition
	 * @param string $class the name of the class added to the html definition
	 */
	public function addClass(string $class):void  {
		$this->classes[] = $class;
	}
	/**
	 * The html code to be inserted into the href attribute
	 * If the code is not defined then the href attribute will be set up to
	 * javascript:void(0)
	 * @param string $href the code to be inserted into the href attribute.
	 * If the parameter is not defined then "javascript:void(0)" value
	 * will be used
	 */
	public function setHref(string $href = 'javascript:void(0)'):void  {
		$this->href = $href;
	}
	public function getHtml():string {
		$code = '<a class="'.implode(',', $this->classes).'"';
		if ($this->title != '') {
			$code .= ' title="'.$this->title.'"';
		}
		if ($this->onClick != '') {
			$code .= ' onClick="'.$this->onClick.'"';
		}
		$code .= ' href="'.$this->href.'">';
		$code .= $this->icon->getHtml();
		$code .= '</a>';
		return $code;
	}
}
?>