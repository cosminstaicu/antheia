<?php
namespace Cosmin\Antheia\Classes\Menu\Item;
use Cosmin\Antheia\Classes\AbstractClass;
use Cosmin\Antheia\Interfaces\HtmlCode;
use Cosmin\Antheia\Interfaces\HtmlId;
use Cosmin\Antheia\Interfaces\HtmlAttribute;
use Cosmin\Antheia\Classes\Exception;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * Abstract class to be extended by all menu buttons
 * @author Cosmin Staicu
 */
abstract class AbstractMenu extends AbstractClass 
implements HtmlCode, HtmlId, HtmlAttribute {
	private $text;
	private $href;
	private $icon;
	private $cssCode;
	private $htmlId;
	private $attributes;
	private $onClick;
	public function __construct() {
		parent::__construct();
		$this->text = '';
		$this->href='javascript:void(0)';
		$this->icon = new IconVector();
		$this->cssCode = '';
		$this->htmlId = '';
		$this->attributes = [];
		$this->onClick = '';
	}
	public function setHtmlId(string $idUnic):void {
		$this->htmlId = $idUnic;
	}
	/**
	 * Adds a css definition into the tag, using the style attribute
	 * @param string $code the added definition (ex: "width: 30px").
	 * If the definition does not end with a semicolon then the character will
	 * be appended
	 */
	public function addCss(string $code):void {
		if (substr($code, -1) != ';') {
			$code .= ';';
		}
		$this->cssCode .= $code.' ';
	}
	public function addAttribute(string $name, string $value):void {
		$this->attributes[] = ['name' => $name, 'value' => $value];
	}
	public function addTextAttribute(string $name, string $value):void {
		$this->addAttribute('data-text-'.$name, Texts::get($value));
	}
	/**
	 * Defines the text to be displayed on the menu
	 * @param string $text the text to be displayed on the menu
	 */
	public function setText(string $text):void {
		$this->text = $text;
	}
	/**
	 * Defines the href for the link of the menu item. If the method is not
	 * called then 'javascript:void(0)' text will be used
	 * @param string $href the href for the link of the menu item
	 */
	public function setHref(string $href):void {
		$this->href = $href;
	}
	/**
	 * Defines the script to be inserted into the onClick attribute of the link
	 * @param string $onClick the script to be inserted into the onClick 
	 * attribute of the link
	 */
	public function setOnClick(string $onClick):void {
		$this->onClick = $onClick;
	}
	/**
	 * Defines the icon for the menu item
	 * @param int $icon the displayed icon as a constant like
	 * jsc_element_icon::ICON_##
	 */
	public function setIcon(int $icon):void {
		$this->icon->setIcon($icon);
	}
	public function getHtml():string {
		if ($this->text === '') {
			throw new Exception('Name is not defined');
		}
		$cod = '<a href="'.$this->href.'" class="jsf_menu-button"';
		if ($this->cssCode !== '') {
			$cod .= ' style="'.$this->cssCode.'"';
		}
		if ($this->onClick !== '') {
			$cod .= ' onClick="'.$this->onClick.'" ';
		}
		if ($this->htmlId !== '') {
			$cod .= ' id="'.$this->htmlId.'" ';
		}
		foreach ($this->attributes as $attr) {
			$cod .= ' '.$attr['name'].'="'.$attr['value'].'"';
		}
		$cod .= '>'.$this->icon->getHtml();
		$cod .='<span>'.$this->text.'</span></a>';
		return $cod;
	}
}
?>