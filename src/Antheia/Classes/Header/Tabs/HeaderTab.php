<?php
namespace Antheia\Antheia\Classes\Header\Tabs;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Classes\Icon\IconVector;
/**
 * Defines a tab to be displayed below the header section of the page
 * @author Cosmin Staicu
 */
class HeaderTab extends AbstractClass implements HtmlCode {
	const STATUS_DEFAULT = 1;
	const STATUS_SELECTED = 2;
	private $title;
	private $href;
	private $hrefClose;
	private $status;
	private $htmlId;
	private $startLoadOnClick;
	private $accent;
	private $classList;
	public function __construct() {
		parent::__construct();
		$this->title = '';
		$this->href = '';
		$this->hrefClose = '';
		$this->status = self::STATUS_DEFAULT;
		$this->htmlId = '';
		$this->startLoadOnClick = false;
		$this->accent = false;
		$this->classList = [];
	}
	/**
	 * Adds a class to the tab html class list
	 * @param string $className the class to be added
	 */
	public function addClass(string $className):void {
		$this->classList[] = $className;
	}
	/**
	 * Enables the loading animation when the tab is clicked
	 */
	public function startLoadOnClick():void {
		$this->startLoadOnClick = true;
	}
	/**
	 * Defines the id for the HTML element (the attribute from the tag).
	 * @param string $id the id for the HTML element or an empty string if no
	 * id is required
	 */
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	/**
	 * Defines the title for the tab (the text that is displayed)
	 * @param string $title the title of the tab
	 */
	public function setTitle(string $title):void {
		$this->title = $title;
	}
	/**
	 * Defines the href attribute for the link of the tab (the action that
	 * will be triggered when the user clicks on the tab)
	 * @param string $href the href attribute for the link of the tab.
	 */
	public function setHref(string $href):void {
		$this->href = $href;
	}
	/**
	 * Defines the status of the tab (default or selected)
	 * @param integer $status the status of the tab, as one of the constants:
	 * - HeaderTab::STATUS_DEFAULT
	 * - HeaderTab::STATUS_SELECTED
	 */
	public function setStatus(string $status):void {
		$this->status = $status;
	}
	/**
	 * Defines if the tab will be rendered with a bold text or not
	 * @param bool $accent true to enable the text accent, false if not
	 */
	public function setAccent(bool $accent = true):void {
		$this->accent = $accent;
	}
	/**
	 * Defines if a close option will be rendered to the tab and the action
	 * for the close event
	 * @param string $href the code to be inserted into the href attribute
	 * for the close link. If an empty string is provided then no close link
	 * will be rendered
	 */
	public function setHrefClose(string $href):void {
		$this->hrefClose = $href;
	}
	public function getHtml():string {
		if ($this->status == self::STATUS_SELECTED) {
			$this->addClass('ant-selected');
		}
		if ($this->accent) {
			$this->addClass('ant-accent');
		}
		$code = '<div';
		if (count($this->classList) > 0) {
			$code .= ' class="'.implode(' ', array_unique($this->classList)).'"';
		}
		if ($this->htmlId !== '') {
			$code .= ' id="'.$this->htmlId.'"';
		}
		$code .= '><a href="'.$this->href.'"';
		if ($this->startLoadOnClick) {
			$code .= ' onclick="ant_loading_start()"';
		}
		$code .= '>'.$this->title.'</a>';
		if ($this->hrefClose !== '') {
			$icon = new IconVector();
			$icon->setIcon(IconVector::ICON_CLOSE);
			$icon->setSize(IconVector::SIZE_SMALL);
			$code .= '<a href="'.$this->hrefClose.'">'.$icon->getHtml().'</a>';
		}
		$code .= '</div>';
		return $code;
	}
}
?>