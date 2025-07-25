<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Interfaces\HtmlAttribute;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
use Antheia\Antheia\Interfaces\LinkButtonRender;
/**
 * Abstract class to be extended by all menu buttons
 * @author Cosmin Staicu
 */
abstract class AbstractMenu extends AbstractClass 
implements HtmlCode, HtmlId, HtmlAttribute, LinkButtonRender {
	const LOW_CONTRAST = 'low';
	const NORMAL = 'normal';
	const WARNING = 'warning';
	private $text;
	private $href;
	private $icon;
	private $cssCode;
	private $htmlId;
	private $attributes;
	private $onClick;
	private $renderType;
	private $appearance;
	private $classList;
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
		$this->appearance = self::NORMAL;
		$this->classList = [];
		$this->addClass('ant_menu-item');
	}
	/**
	 * Defines the appearance of the menu, as normal, low contrast or warning
	 * @param string $appearance the appearance as one of the constants
	 * AbstractMenu::LOW_CONTRAST, AbstractMenu::NORMAL, AbstractMenu::WARNING
	 */
	public function setAppearance(string $appearance):void {
		$this->appearance = $appearance;
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
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
	/**
	 * Adds a css class to the tag
	 * @param string $class the css class that will be added to the tag
	 */
	public function addClass(string $class):void {
		$this->classList[] = $class;
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
	public function setHref(string $href):void {
		$this->href = $href;
	}
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
				$code .= '<button type="button"';
				break;
			default:
				throw new Exception('Invalid type '.$this->renderType);
		}
		switch ($this->appearance) {
			case self::LOW_CONTRAST:
				$this->addClass('low-contrast');
				break;
			case self::NORMAL:
				$this->addClass('normal');
				break;
			case self::WARNING:
				$this->addClass('warning');
				break;
			default:
				throw new Exception('Invalid value '.$this->appearance);
		}
		$code .= ' class="'.implode(' ', $this->classList).'"';
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