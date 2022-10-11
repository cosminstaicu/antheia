<?php
namespace Antheia\Antheia\Classes\Header;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Classes\Header\Tabs\HeaderTab;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Menu\Item\AbstractMenu;
use Antheia\Antheia\Classes\Menu\Container;
/**
 * The header of the page. The class is controlled internally by the library
 * so no new instances for this class are required
 * @author Cosmin Staicu
 */
class Header implements HtmlCode {
	private $title;
	private $titleContainer;
	private $tabs;
	public function __construct() {
		$this->title = '';
		$this->tabs = [];
		$this->titleContainer = null;
	}
	/**
	 * Defines the title of the page
	 * @param string $titlu the title of the page
	 */
	public function setTitle(string $title):void {
		$this->title = $title;
	}
	/**
	 * Adds a menu item to the page title (a secondary menu)
	 * @param AbstractMenu $item the menu to be added
	 */
	public function addMenu(AbstractMenu $item):void {
		if ($this->titleContainer === null) {
			$this->titleContainer = new Container();
		}
		$this->titleContainer->addItem($item);
	}
	/**
	 * Adds a tab to the tab list of the page
	 * @param HeaderTab $tab the tab to be added to the page
	 */
	public function addTab(HeaderTab $tab):void {
		$this->tabs[] = $tab;
	}
	public function getHtml():string {
		$code = '<div id="ant_header">';
		if ($this->titleContainer !== null) {
			$this->titleContainer->setVisible(new Html(
					'<h1>'.htmlspecialchars($this->title).'</h1>'
			));
			$code .= $this->titleContainer->getHtml();
		} else {
			$code .= '<h1>'.htmlspecialchars($this->title).'</h1>';
		}
		$code .= '</div>';
		if (count($this->tabs) > 0) {
			$code .= '<div id="ant_header-tabs">';
			/** @var HeaderTab $element */
			foreach ($this->tabs as $tab) {
				$code .= $tab->getHtml();
			}
			$code .= '</div>';
		}
		return $code;
	}
}
?>