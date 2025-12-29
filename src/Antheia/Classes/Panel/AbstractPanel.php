<?php
namespace Antheia\Antheia\Classes\Panel;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Internals;
use Antheia\Antheia\Classes\Menu\Container;
use Antheia\Antheia\Classes\Menu\Item\AbstractMenu;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
/**
 * Abstract class to be extended by all panels defined in the library
 * @author Cosmin Staicu
 */
abstract class AbstractPanel extends AbstractClass
implements HtmlCode, HtmlId {
	const ALIGN_LEFT = 1;
	const ALIGN_CENTER = 2;
	const ALIGN_RIGHT = 3;
	private $content;
	private $footerItems;
	private $showHeader;
	private $title;
	private $menu;
	private $htmlId;
	private $testId;
	private $maxHeight;
	private $classes;
	private $tabs;
	public function __construct() {
		parent::__construct();
		$this->content = [];
		$this->footerItems = [];
		$this->title = new Html();
		$this->showHeader = false;
		$this->menu = null;
		$this->maxHeight = false;
		$this->classes = [];
		$this->htmlId = '';
		$this->testId = '';
		$this->tabs = [];
	}
	/**
	 * Adds a class to the container html tag
	 * @param string $class the name of the class to be added to the html tab
	 */
	public function addClass(string $class):void {
		$this->classes[] = $class;
	}
	/**
	 * Sets the panel to be rendered directly with a loading animation started
	 */
	public function setLoadingAnimation():void {
		$this->addClass('ant-loading');
	}
	/**
	 * Defines if the panel will have the full available height or just enough
	 * to show it's content
	 * @param boolean $status (optional) (default true) if true then the
	 * panel will occupy the entire available space
	 */
	public function setFullHeight(bool $status = true):void {
		$this->maxHeight = $status;
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	public function setTestId(string $id):void {
		$this->testId = $id;
	}
	/**
	 * Defines the title of the panel.
	 * The method removes any code defined using setHtmlTitle()
	 * @param string $text the title of the panel
	 * @param boolean $smallFont (optional) (default false) if true then the title
	 * will have a smaller font
	 */
	public function setTitle(string $text, bool $smallFont = false):void {
		$tag = 'h2';
		if ($smallFont) {
			$tag = 'h3';
		}
		$this->title = new Html('<'.$tag.'>'.$text.'</'.$tag.'>');
		$this->showHeader = true;
	}
	/**
	 * Defines some html code to be used as a title for the panel
	 * The method removes any code defined using setTitle()
	 * @param HtmlCode $code the html code
	 */
	public function setHtmlTitle(HtmlCode $code):void {
		$this->title = $code;
		$this->showHeader = true;
	}
	/**
	 * Adds a menu button to the panel header
	 * @param AbstractMenu $item the menu item to be added
	 */
	public function addMenu(AbstractMenu $item):void {
		if ($this->menu === null) {
			$this->menu = new Container();
		}
		$this->menu->addItem($item);
		$this->showHeader = true;
	}
	/**
	 * Adds a html element to the panel
	 * @param HtmlCode $code the html code to be added
	 */
	public function addElement(HtmlCode $code):void {
		$this->content[] = $code;
	}
	/**
	 * Adds a html element to the footer of the panel
	 * @param HtmlCode $code the html code to be added to the footer of the
	 * panel
	 */
	public function addFooterElement(HtmlCode $code):void {
		$this->footerItems[] = $code;
	}
	/**
	 * Adds a text to the content of the panel
	 * @param string $text the text to be added
	 */
	public function addText(string $text):void {
		$this->content[] = new Html($text);
	}
	/**
	 * Adds a tab to the tab list of the panel
	 * @param Tab $tab (optional) the tab to be added to the panel.
	 * If no tab is provided, a new one will be created
	 * @return Tab the added tab
	 */
	public function addTab(?Tab $tab = NULL):Tab {
		if ($tab === NULL) {
			$tab = new Tab();
		}
		$this->tabs[] = $tab;
		return $tab;
	}
	public function getHtml():string {
		$this->addClass('ant_panel');
		if ($this->maxHeight) {
			$this->addClass('ant-max-height');
		}
		$code = '<div class="';
		$code .= implode(' ', array_unique($this->classes));
		$code .='"';
		$code .= Internals::getHtmlIdCode($this->htmlId, $this->testId);
		$code .= '>';
		if ($this->showHeader) {
			$code .= '<div class="ant-header">';
			if ($this->menu === null) {
				$code .= $this->title->getHtml();
			} else {
				$this->menu->setVisible($this->title);
				$code .= $this->menu->getHtml();
			}
			$code .= '</div>';
		}
		$code .= '<div class="ant-tabs">';
		foreach ($this->tabs as $tab) {
			$code .= $tab->getHtml();
		}
		$code .= '</div>';
		$code .= '<div class="ant-content">';
		/** @var HtmlCode $item */
		foreach ($this->content as $item) {
			$code .= $item->getHtml();
		}
		$code .= '</div>';
		if (count($this->footerItems) > 0) {
			$code .= '<div class="ant-footer">';
			foreach ($this->footerItems as $item) {
				$code .= $item->getHtml();
			}
			$code .= '</div>';
		}
		$code .= '</div>';
		return $code;
	}
}
?>