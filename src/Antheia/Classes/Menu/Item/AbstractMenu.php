<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Interfaces\HtmlAttribute;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
/**
 * Abstract class to be extended by all menu buttons
 * @author Cosmin Staicu
 */
abstract class AbstractMenu extends AbstractClass 
implements HtmlCode, HtmlId, HtmlAttribute {
	const LINK = 'link';
	const BUTTON = 'button';
	private $text;
	private $href;
	private $icon;
	private $cssCode;
	private $htmlId;
	private $attributes;
	private $onClick;
	private $renderType;
	public function __construct() {
		parent::__construct();
		$this->text = '';
		$this->href='javascript:void(0)';
		$this->icon = new IconVector();
		$this->cssCode = '';
		$this->htmlId = '';
		$this->attributes = [];
		$this->onClick = '';
		$this->renderType = self::LINK;
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	/**
	 * Defines the render to be used by the menu. It can be a button or a link
	 * @param string $type the render type for the menu, as one of the constants:
	 * <dl>
	 * <dt>AbstractMenu::LINK</dt><dd>the menu will be rendered as a link</dd>
	 * <dt>AbstractMenu::BUTTON</dt><dd>the menu will be rendered as a button</dd>
	 * </dl>
	 */
	public function setRender(string $type):void {
		$this->renderType = $type;
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
	 * Defines the href for the link of the menu item. It is only used if the
	 * button is rendered as a link. For buttons, the method has no effect.
	 * If the method is not called then 'javascript:void(0)' text will be used
	 * for the items rendered as links.
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
	 * IconVector::ICON_##
	 */
	public function setIcon(int $icon):void {
		$this->icon->setIcon($icon);
	}
	public function getHtml():string {
		if ($this->text === '') {
			throw new Exception('Name is not defined');
		}
		$code = '';
		switch ($this->renderType) {
			case self::LINK:
				$code .= '<a href="'.$this->href.'"';
				break;
			case self::BUTTON:
				$code .= '<button';
				break;
			default:
				throw new Exception('Invalid type '.$this->renderType);
		}
		$code .= ' class="ant_menu-item"';
		if ($this->cssCode !== '') {
			$code .= ' style="'.$this->cssCode.'"';
		}
		if ($this->onClick !== '') {
			$code .= ' onClick="'.$this->onClick.'" ';
		}
		if ($this->htmlId !== '') {
			$code .= ' id="'.$this->htmlId.'" ';
		}
		foreach ($this->attributes as $attr) {
			$code .= ' '.$attr['name'].'="'.$attr['value'].'"';
		}
		$code .= '>'.$this->icon->getHtml();
		$code .='<span>'.$this->text.'</span>';
		switch ($this->renderType) {
			case self::LINK:
				$code .= '</a>';
				break;
			case self::BUTTON:
				$code .= '</button>';
				break;
			default:
				throw new Exception('Invalid type '.$this->renderType);
		}
		return $code;
	}
}
?>