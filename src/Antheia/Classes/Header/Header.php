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
	const BK_FIT = 'fit';
	const BK_FILL = 'fill';
	const BK_POSITION_CENTER = 'center';
	const BK_POSITION_N = 'n';
	const BK_POSITION_S = 's';
	const BK_POSITION_W = 'w';
	const BK_POSITION_E = 'e';
	const BK_POSITION_NE = 'ne';
	const BK_POSITION_NW = 'nw';
	const BK_POSITION_SW = 'sw';
	const BK_POSITION_SE = 'se';
	private $title;
	private $type;
	private $titleContainer;
	private $tabs;
	private $backgroundUrl;
	private $backgroundFill;
	private $backgroundPosition;
	private $noTitleBackground;
	public function __construct() {
		$this->title = '';
		$this->type = self::TYPE_FIXED;
		$this->tabs = [];
		$this->titleContainer = NULL;
		$this->backgroundUrl = NULL;
		$this->backgroundFill = self::BK_FILL;
		$this->backgroundPosition = self::BK_POSITION_CENTER;
		$this->noTitleBackground = false;
	}
	/**
	 * Defines the title of the page
	 * @param string $titlu the title of the page
	 */
	public function setTitle(string $title):void {
		$this->title = $title;
	}
	/**
	 * Disables the title background (only used when a background image is used
	 */
	public function disableTitleBackground():void {
		$this->noTitleBackground = true;
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
	 * Defines the url to be used for the header background image
	 * @param string|NULL $url the url to be uses for the header background image
	 * or NULL if no background image is used
	 */
	public function setBackgroundImage(?string $url):void {
		$this->backgroundUrl = $url;
	}
	/**
	 * Defines the background fill type, if a background image is used for
	 * the header
	 * @param string $fillType the background fill type for the background image:
	 * - Header::BK_FIT the image will be displayed as large as possible,
	 * with no hidden areas even if empty areas inside the header will ve visible.
	 * - Header::BK_FILL the entire header area will be covered by the image
	 * even if parts of the image are hidden, to preserve the aspect ratio.
	 */
	public function setBackgroundFill(string $fillType):void {
		$this->backgroundFill = $fillType;
	}
	/**
	 * Defines the position of the image background
	 * @param string $position the position of the background image as one
	 * of the constants:
	 * - Header::BK_POSITION_CENTER
	 * - Header::BK_POSITION_N
	 * - Header::BK_POSITION_S
	 * - Header::BK_POSITION_W
	 * - Header::BK_POSITION_E
	 * - Header::BK_POSITION_NE
	 * - Header::BK_POSITION_NW
	 * - Header::BK_POSITION_SW
	 * - Header:: BK_POSITION_SE;
	 * Symbols N S E W corespond to north, south, west, east
	 */
	public function setBackgroundPosition(string $position):void {
		$this->backgroundPosition = $position;
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
		if ($this->backgroundUrl !== NULL) {
			if (!$this->noTitleBackground) {
				$code .= ' ant-background-enabled';
			}
			switch ($this->backgroundFill) {
				case self::BK_FILL:
				case self::BK_FIT:
					$code .= ' ant-'.$this->backgroundFill;
					break;
				default:
					throw new Exception('Unknown fill type: '.$this->backgroundFill);
			}
			switch ($this->backgroundPosition) {
				case self::BK_POSITION_CENTER:
				case self::BK_POSITION_N:
				case self::BK_POSITION_S:
				case self::BK_POSITION_E:
				case self::BK_POSITION_W:
				case self::BK_POSITION_NE:
				case self::BK_POSITION_NW:
				case self::BK_POSITION_SE:
				case self::BK_POSITION_SW:
					$code .= ' ant-'.$this->backgroundPosition;
					break;
				default:
					throw new Exception('Unknown position: '.$this->backgroundPosition);
			}
		}
		$code .='"';
		if ($this->backgroundUrl !== NULL) {
			$code .= ' style="background-image: url('.$this->backgroundUrl.');"';
		}
		$code .='>';
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