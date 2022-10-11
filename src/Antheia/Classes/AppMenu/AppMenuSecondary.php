<?php
namespace Cosmin\Antheia\Classes\AppMenu;
use Cosmin\Antheia\Classes\AbstractClass;
use Cosmin\Antheia\Interfaces\HtmlCode;
use Cosmin\Antheia\Classes\Icon\IconPixelSmall;
/**
 * A submenu item (that will be displayed when the parent menu is clicked)
 * @author Cosmin Staicu
 */
class AppMenuSecondary extends AbstractClass implements HtmlCode {
	private $icon;
	private $text;
	private $href;
	private $startLoadingAnimation;
	public function __construct() {
		$this->icon = new IconPixelSmall('default');
		$this->text = 'undefined';
		$this->href = '#';
		$this->startLoadingAnimation = true;
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
	 * @param string $icon the icon for the menu (the name of the png image
	 * located in the 16x16 folder
	 */
	public function setIcon($icon):void {
		$this->icon->setIcon($icon);
	}
	/**
	 * Returns the image linked to the menu (placed on the left side of the menu)
	 * @return IconPixelSmall the image linked to the menu
	 */
	public function getIcon():IconPixelSmall {
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
		$cod = '<a href="'.$this->href.'" ';
		if ($this->startLoadingAnimation) {
			$cod .= ' onClick="ant_loading_start()"';
		}
		$cod .= '><img src="'.$this->icon->getUrl()
			.'" width="16" height="16" alt="'.$this->text.'">'
			.htmlspecialchars($this->text).'</a>
		';
		return $cod;
	}
}