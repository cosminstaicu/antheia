<?php
namespace Antheia\Antheia\Classes\Header;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Header\Tabs\HeaderTab;
use Antheia\Antheia\Classes\Menu\Container;
use Antheia\Antheia\Classes\Menu\Item\AbstractMenu;
use Antheia\Antheia\Interfaces\HtmlCode;
/**
 * The header of the page. The class is controlled internally by the library
 * so no new instances for this class are required
 * @author Cosmin Staicu
 */
class Header implements HtmlCode {
	const TYPE_FIXED = 'fixed';
	const TYPE_FLUID = 'fluid';
	private $title;
	private $type;
	private $titleContainer;
	private $tabs;
	public function __construct() {
		$this->title = '';
		$this->type = self::TYPE_FIXED;
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
	 * Defines the width of the header.
	 * @param string $type one of the constants: Header::TYPE_FIXED (default)
	 * the page title, along with the page manu (if available) will align with
	 * a fixed wireframe
	 * Header::FLUID the page title will always be on the left edge of the document
	 */
	public function setType(string $type):void {
		$this->type = $type;
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
		$code = '<div id="ant_header" class="';
		switch ($this->type) {
			case self::TYPE_FIXED:
				$code .= 'ant-fixed';
				break;
			case self::TYPE_FLUID:
				$code .= 'ant-fluid';
				break;
			default:
				throw new Exception('Invalid header type '.$this->type);
		}
		$code .='">';
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