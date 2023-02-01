<?php
namespace Antheia\Antheia\Classes\Header\Tabs;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\LinkButtonRender;
/**
 * Defines a tab to be displayed below the header section of the page
 * @author Cosmin Staicu
 */
class HeaderTab extends AbstractClass implements HtmlCode, LinkButtonRender {
	const STATUS_DEFAULT = 1;
	const STATUS_SELECTED = 2;
	private $title;
	private $href;
	private $onClick;
	private $onClickClose;
	private $status;
	private $htmlId;
	private $startLoadOnClick;
	private $accent;
	private $classList;
	private $renderType;
	public function __construct() {
		parent::__construct();
		$this->title = '';
		$this->href = '';
		$this->onClick = '';
		$this->onClickClose = '';
		$this->status = self::STATUS_DEFAULT;
		$this->htmlId = '';
		$this->startLoadOnClick = false;
		$this->accent = false;
		$this->classList = [];
		$this->renderType = self::LINK;
	}
	/**
	 * Adds a class to the tab html class list
	 * @param string $className the class to be added
	 */
	public function addClass(string $className):void {
		$this->classList[] = $className;
	}
	public function setRender(string $type):void {
		$this->renderType = $type;
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
	public function setHref(string $href):void {
		$this->href = $href;
	}
	public function setOnClick(string $code):void {
		$this->onClick = $code;
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
	 * @param string $code the code to be inserted into the onClick attribute
	 * for the close button. If an empty string is provided then no close link
	 * will be rendered
	 */
	public function setOnClickClose(string $code):void {
		$this->onClickClose = $code;
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
		$code .= '>';
		switch ($this->renderType) {
			case self::LINK:
				$code .= '<a href="'.$this->href.'" ';
				break;
			case self::BUTTON:
				$code .= '<button type="button" ';
				break;
			default:
				throw new Exception('Invalid type '.$this->renderType);
		}
		
		if ($this->startLoadOnClick || ($this->onClick !== '')) {
			$onClick = '';
			if ($this->startLoadOnClick) {
				$onClick .= 'ant_loading_start();';
			}
			if ($this->onClick !== '') {
				$onClick .= $this->onClick;
			}
			$code .= ' onclick="'.$onClick.'"';
		}
		$code .= '>'.$this->title;
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
		if ($this->onClickClose !== '') {
			$icon = new IconVector();
			$icon->setIcon(IconVector::ICON_CLOSE);
			$icon->setSize(IconVector::SIZE_SMALL);
			$code .= '<button type="button" onclick="'
					.$this->onClickClose.'">'.$icon->getHtml().'</button>';
		}
		$code .= '</div>';
		return $code;
	}
}
?>