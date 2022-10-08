<?php
namespace Cosmin\Antheia\Classes\AppMenu;
use Cosmin\Antheia\Classes\AbstractClass;
use Cosmin\Antheia\Interfaces\HtmlCode;
use Cosmin\Antheia\Interfaces\HtmlId;
use Cosmin\Antheia\Classes\Icon\IconPixelBig;
/**
 * A menu item from the main menu of the page (the sliding one on the left
 * side of the page)
 * @author Cosmin Staicu
 *
 */
class AppMenuPrimary extends AbstractClass implements HtmlCode, HtmlId {
	private $icon;
	private $text;
	private $href;
	private $submenus;
	private $startLoadingAnimation;
	private $htmlId;
	public function __construct() {
		$this->icon = new IconPixelBig('default');
		$this->text = 'undefined';
		$this->setHref('#');
		$this->submenus = [];
		$this->startLoadingAnimation = true;
		$this->htmlId = '';
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	/**
	 * Defines if a loading animation will be triggered when the user clicks
	 * on this menu. If the menu contains submenus then this method is ignored
	 * (a menu with submenus will never show a loading animation on click)
	 * @param boolean $status true if the animation will start, false if not
	 */
	public function startLoadingOnClick(bool $status):void {
		$this->startLoadingAnimation = $status;
	}
	/**
	 * Defines the href for the menu link. If the menu contains submenus then
	 * this method is ignored, as a specific action is triggered for showing
	 * submenus
	 * @param string $href the location to be loaded on click
	 */
	public function setHref(string $href):void {
		$this->href = $href;
	}
	/**
	 * Returns the submenu list for this menu
	 * @return AppMenuSecondary[] a list with all defined submenus for
	 * this menu
	 */
	public function getSubmenus():array {
		return $this->submenus;
	}
	/**
	 * Adds a submenu item to this menu
	 * @param AppMenuSecondary $submenu the submenu item to be added
	 * to the menu
	 */
	public function addSubmeniu(AppMenuSecondary $submenu):void {
		$this->submenus[] = $submenu;
	}
	/**
	 * Defines the icon for the menu.
	 * @param string $icon the icon for the menu (the name of the png icon
	 * located in the 32x32 folder
	 */
	public function setIcon(string $icon):void {
		$this->icon->setIcon($icon);
	}
	/**
	 * Returns the icon linked to the menu (placed on the left side of the menu)
	 * @return IconPixelBig the icon linked to the menu
	 */
	public function getIcon():IconPixelBig {
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
		$code = '';
		if (count($this->submenus) > 0) {
			$this->href = 'javascript:void(0)';
		}
		$code .= '<a href="'.$this->href.'" ';
		if ($this->htmlId !== '') {
			$code .= ' id="'.$this->htmlId.'"';
		}
		if (count($this->submenus) === 0) {
			if ($this->startLoadingAnimation) {
				$code .= ' onClick="jsf_loading_start()"';
			}
		} else {
			$code .= ' onClick="jsf_appMenu_toggleSubmenu(this)"';
		}
		$code .= '><img src="'.$this->icon->getUrl()
			.'" width="32" height="32" alt="'
			.htmlspecialchars($this->text).'"> '
			.htmlspecialchars($this->text).'</a>';
		if (count($this->submenus) > 0) {
			$code .= '<div>';
			/** @var AppMenuSecondary $item */
			foreach ($this->submenus as $item) {
				$code .= $item->getHtml();
			}
			$code .= '</div>';
		}
		return $code;
	}
}