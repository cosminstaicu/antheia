<?php
namespace Antheia\Antheia\Classes\Page;
use Antheia\Antheia\Classes\Form;
use Antheia\Antheia\Classes\Globals;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\AppMenu\AppMenuPrimary;
use Antheia\Antheia\Classes\FixedButton\AbstractFixedButton;
use Antheia\Antheia\Classes\Header\Header;
use Antheia\Antheia\Classes\Header\Tabs\HeaderTab;
use Antheia\Antheia\Classes\Header\TopRightMenu\AbstractTopRightMenu;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Menu\Item\AbstractMenu;
use Antheia\Antheia\Classes\Wireframe\Wireframe;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Classes\Header\Search\TopSearch;
/**
 * An empty page, with a menu. HtmlCode instances can be added to the class
 * @author Cosmin Staicu
 */
class PageEmpty extends PageBlank {
	private $displayTitle;
	private $codeElements;
	private $header;
	private $fixedButtons;
	private $infoText;
	private $infoTextBackgroundImage;
	private $closeFullPageMessageOnClick;
	private $topRightItems;
	private $menu;
	private $fixedTopMenu;
	private $topSearch;
	public function __construct() {
		parent::__construct();
		$this->codeElements = [];
		$this->header = new Header();
		$this->fixedButtons = [];
		$this->setInfoMessage('');
		$this->topRightItems = [];
		$this->displayTitle = true;
		$this->menu = [];
		$this->fixedTopMenu = false;
		$this->topSearch = null;
	}
	/**
	 * Returns the global search object that will be displayed on the top bar.
	 * If this method is not called, then no top search is displayed
	 */
	public function getTopSearchForm():TopSearch {
		if ($this->topSearch === NULL) {
			$this->topSearch = new TopSearch();
		}
		return $this->topSearch;
	}
	/**
	 * Defines if the top bar of the page (with the main menu toogle button
	 * and the right side buttons) is fixed to the viewport (always visible) or
	 * fixed to the body of the page (visible only when the upper part of the
	 * page is visible)
	 * @param bool $status true if the top menu should be always visible, false
	 * if the top menu should be visible only when the top part of the page is
	 * visible (0 scroll)
	 */
	public function setFixedTopMenu(bool $status = true):void {
		$this->fixedTopMenu = $status;
	}
	/**
	 * Defines if the app name is displayed under the logo, or not
	 * @param boolean $status true for the name to be displayed, false if not
	 */
	public function displayAppName(bool $status):void {
		$this->displayTitle = $status;
	}
	/**
	 * Defines the width of the header.
	 * @param string $type one of the constants: 
	 * \Antheia\Antheia\Classes\Header\Header::TYPE_FIXED (default)
	 * the page title, along with the page manu (if available) will align with
	 * a fixed wireframe
	 * \Antheia\Antheia\Classes\Header\Header::TYPE_FLUID the page title will always
	 * be on the left edge of the document
	 * @see \Antheia\Antheia\Classes\Header\Header::setType()
	 * @param string $type
	 */
	public function setHeaderType(string $type):void {
		$this->header->setType($type);
	}
	/**
	 * Defines the url to be used for the header background image
	 * @param string $url the url to be used for the header background image
	 * @see \Antheia\Antheia\Classes\Header\Header::setBackgroundImage()
	 */
	public function setHeaderBackgroundImage(string $url):void {
		$this->header->setBackgroundImage($url);
	}
	/**
	 * Returns the header of the page
	 * @return Header the header of the page, for further set up
	 */
	public function getHeader():Header {
		return $this->header;
	}
	/**
	 * Sets up a message to be displayed after the page has been loaded.
	 * @param string $text the text to be displayed or an empty string if
	 * no message is needed
	 * @param string $imageUrl (optional) the url for a image that will be used
	 * as a full screen background for the message (a fullscreen message) or
	 * NULL for the message to be rendered as a discreet one (toast type)
	 * @param boolean $closeOnClick (optional) (default false) if set to true
	 * then a full page confirmation message can be closed by clicking on it
	 */
	public function setInfoMessage(
			string $text, string $imageUrl = NULL, bool $closeOnClick = false):void {
		$this->infoText = $text;
		$this->infoTextBackgroundImage = $imageUrl;
		$this->closeFullPageMessageOnClick = $closeOnClick;
	}
	/**
	 * Adds a fixed button to the bottom right side of the page, that will
	 * slide in after the page has been loaded.
	 * @param AbstractFixedButton $button the button to be added
	 */
	public function addFixedButton(AbstractFixedButton $button):void {
		$this->fixedButtons[] = $button;
	}
	/**
	 * Adds a menu item to the top-right side of the page
	 * @param AbstractTopRightMenu $item the menu item to be added
	 */
	public function addTopRightMenu(AbstractTopRightMenu $item):void {
		$this->topRightItems[] = $item;
	}
	/**
	 * Add a navigation item to the main menu of the app (the menu that slides
	 * from the left side of the page)
	 * @param AppMenuPrimary $item the menu to be added to the page
	 */
	public function addNavigationMenu (AppMenuPrimary $item):void {
		$this->menu[] = $item;
	}
	/**
	 * Adds an item to the page menu (the menu available when pressing the menu
	 * button to the left of the title)
	 * @param AbstractMenu $item the menu item to be added
	 */
	public function addPageMenu(AbstractMenu $item):void {
		$this->header->addMenu($item);
	}
	/**
	 * Adds a tab to the page
	 * @param HeaderTab $tab (optional) the tab to be added (if the parameter
	 * is not defined, then a new tab will be instantiated and added to the page)
	 * @return HeaderTab the added tab
	 */
	public function addTab(HeaderTab $tab = NULL):HeaderTab {
		if ($tab === NULL) {
			$tab = new HeaderTab();
		}
		$this->header->addTab($tab);
		return $tab;
	}
	public function addElement(HtmlCode $codHtml):void {
		$this->codeElements[] = $codHtml;
	}
	/**
	 * Adds a new wireframe to the page and returns the new wireframe instance
	 * @string $type (optional) (default Wireframe::TYPE_FIXED)
	 * the wireframe type, as a constant like Wireframe::TYPE_XXXX
	 * @return \Antheia\Antheia\Classes\Wireframe\Wireframe the added wireframe
	 */
	public function addWireframe(string $type = Wireframe::TYPE_FIXED):Wireframe {
		$wireframe = new Wireframe();
		$wireframe->setType($type);
		$this->addElement($wireframe);
		return $wireframe;
	}
	/**
	 * Adds a form to the page and returns the new form instance
	 * @return Form the added form instance
	 */
	public function addForm():Form {
		$form = new Form();
		$this->addElement($form);
		return $form;
	}
	public function getHtml():string {
		// body tab setup
		if ($this->fixedTopMenu) {
			$this->addBodyClass('ant_topBarFixed');
		}
		// ***************************************************** JAVASCRIPT HEAD
		$this->addHtmlClass('ant_tags_bottom-bar');
		$this->addBodyClass('ant_tags_bottom-bar');
		if ($this->infoTextBackgroundImage !== null) {
			$this->addBodyClass('ant_message-active');
		}
		if (count($this->fixedButtons) > 0) {
			$this->addBodyClass('ant-has-fixed-buttons');
		}
		// *********************************************************** UPPER BAR
		
		$upperBar = new Html();
		$upperBar->addRawCode('<div id="ant_topBar">');
		$upperBar->addRawCode(
			'<button onClick="ant_appMenu_toggle()" type="button">'
		);
		$menuButton = new IconVector();
		$menuButton->setIcon(IconVector::ICON_MENU);
		$upperBar->addElement($menuButton);
		$upperBar->addRawCode('<span>'.Texts::get('MENU').'</span></button>');
		if ($this->topSearch !== NULL) {
			$upperBar->addElement($this->topSearch);
		}
		$upRight = '<ul>';
		/** @var HtmlCode $element */
		foreach ($this->topRightItems as $item) {
			$upRight .= '<li>';
			$upRight .= $item->getHtml();
			$upRight .= '</li>';
		}
		$upRight .= '</ul>';
		$upperBar->addElement(new Html($upRight));
		$upperBar->addRawCode('</div>');
		parent::addElement($upperBar);
		// ****************************************************** TITLE AND TABS
		$this->header->setTitle($this->getTitle());
		parent::addElement($this->header);
		// ************************************************************* CONTENT
		$code = '<div id="ant_content">';
		parent::addElement(new Html($code));
		foreach ($this->codeElements as $item) {
			parent::addElement($item);
		}
		$code = '</div>';
		// ******************************************************* FIXED BUTTONS
		if (count($this->fixedButtons) > 0) {
			$code .= '<div id="ant_fixedButton">';
			/** @var AbstractFixedButton $element */
			foreach ($this->fixedButtons as $item) {
				$code .= $item->getHtml();
			}
			$code .= '</div>';
			$code .= '<script id="ant_fixedButtonScript">
				setTimeout(() => {
					document.getElementById("ant_fixedButton").classList.add("ant-enabled");
					document.getElementById("ant_fixedButtonScript").remove();
				}, 1000);
			</script>';
		}
		parent::addElement(new Html($code));
		// main menu
		$code = '
			<div id="ant_appMenu">
			<div onClick="ant_appMenu_toggle()"></div>
			<nav>
			<img src="'.Globals::getLogo()
			.'" width="150" height="150" alt="Logo">';
		if ($this->displayTitle) {
			$code .= '<p>'.htmlspecialchars(Globals::getAppName()).'</p>';
		}
		/** @var AppMenuPrimary $element */
		foreach ($this->menu as $item) {
			$code .= $item->getHtml();
		}
		$code .= '</nav></div>';
		parent::addElement(new Html($code));
		if ($this->infoText !== '') {
			$showMessageCode = 'ant_message("'.$this->infoText.'"';
			if ($this->infoTextBackgroundImage !== NULL) {
				$showMessageCode .= ',"'.$this->infoTextBackgroundImage.'"';
				if ($this->closeFullPageMessageOnClick) {
					$showMessageCode .= ',true';
				}
			}
			$showMessageCode .= ');
			setTimeout(() => {
				document.getElementById("ant-messageOnLoadScript").remove();
			}, 500);';
			parent::addJavascriptBody($showMessageCode, 'ant-messageOnLoadScript');
		}
		return parent::getHtml();
	}
}
?>