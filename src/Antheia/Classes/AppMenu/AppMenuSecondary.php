<?php
namespace Antheia\Antheia\Classes\AppMenu;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Globals;
use Antheia\Antheia\Classes\Internals;
use Antheia\Antheia\Classes\Icon\AbstractIcon;
use Antheia\Antheia\Classes\Icon\IconPixelSmall;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
/**
 * A submenu item (that will be displayed when the parent menu is clicked)
 * @author Cosmin Staicu
 */
class AppMenuSecondary extends AbstractClass implements HtmlCode, HtmlId {
	private $htmlId;
	private $testId;
	/** @var AbstractIcon */
	private $icon;
	private $text;
	private $href;
	private $startLoadingAnimation;
	public function __construct() {
		$this->icon = new IconPixelSmall('default');
		$this->text = 'undefined';
		$this->href = '#';
		$this->htmlId = '';
		$this->testId = '';
		$this->startLoadingAnimation = Globals::getAppMenuLoadingAnimation();
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	public function setTestId(string $id):void {
		$this->testId = $id;
	}
	/**
	 * Defines if a loading animation will be triggered when the user clicks
	 * on this menu.
	 * @param boolean $status true if the animation will start, false if not
	 */
	public function startLoadingOnClick($status):void {
		$this->startLoadingAnimation = $status;
	}
	/**
	 * Defines the href for the menu link.
	 * @param string $href the location to be loaded on click
	 */
	public function setHref($href):void {
		$this->href = $href;
	}
	/**
	 * Defines the icon for the menu.
	 * @param AbstractIcon $icon the icon for the menu
	 */
	public function setIcon(AbstractIcon $icon):void {
		$this->icon = $icon;
	}
	/**
	 * Defines the name of the icon for the menu (and, optionally, the icon type)
	 * @param string $name the name of the icon for the menu (the filename of
	 * the symbol, inside the zip file located in the media folder)
	 * @param string [$type=NULL] the type of the icon, as one of the variables
	 * AbstractIcon::PIXEL or AbstractIcon::VECTOR. If no type is provided then
	 * the current icon instance is used. If type is provided then a new instance
	 * for the icon will be created
	 */
	public function setIconName(string $name, string $type = NULL) {
		if ($type !== NULL) {
			switch ($type) {
				case AbstractIcon::PIXEL:
					$this->setIcon(new IconPixelSmall($name));
					break;
				case AbstractIcon::VECTOR:
					$this->setIcon(new IconVector($name, 16));
					break;
				default:
					throw new Exception('Invalid type '.$type);
			}
		} else {
			$this->icon->setIcon($name);
		}
	}
	/**
	 * Returns the icon linked to the menu (placed on the left side of the menu)
	 * @return AbstractIcon the icon linked to the menu
	 */
	public function getIcon() {
		return $this->icon;
	}
	/**
	 * Defines the text to be displayed on the menu
	 * @param string $text the text to be displayed on the menu
	 */
	public function setText(string $text):void {
		$this->text = $text;
	}
	public function getHtml():string {
		$code = '<a href="'.$this->href.'"';
		if ($this->startLoadingAnimation) {
			$code .= ' onClick="ant_loading_start()"';
		}
		$code .= Internals::getHtmlIdCode($this->htmlId, $this->testId);
		$code .= '>'.$this->icon->getHtml($this->text).' '.htmlspecialchars($this->text).'</a>
		';
		return $code;
	}
}
