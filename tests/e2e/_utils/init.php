<?php
use Antheia\Antheia\Classes\Globals;
use Antheia\Antheia\Classes\AppMenu\AppMenuPrimary;
use Antheia\Antheia\Classes\Icon\AbstractIcon;
use Antheia\Antheia\Classes\Page\AbstractPage;
use Antheia\Antheia\Classes\Page\PageSearchResult;
use Antheia\Antheia\Classes\Search\SearchResult;
use Antheia\Antheia\Classes\Icon\IconPixelBig;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\InlineButton\InlineButton;
use Antheia\Antheia\Classes\Search\SearchOptionBarButton;
use Antheia\Antheia\Classes\Form;
use Antheia\Antheia\Classes\Search\SearchForm;
use Antheia\Antheia\Classes\Input\NewInput;
use Antheia\Antheia\Classes\Page\PageEmpty;
use Antheia\Antheia\Classes\Header\TopRightMenu\TopRightMenuExit;
use Antheia\Antheia\Classes\Header\TopRightMenu\TopRightMenuUser;
// setting an exception handler to send a 500 http status on exceptions
set_exception_handler(function ($exception) {
	if (!headers_sent()) {
		http_response_code(500);
	}
	throw $exception;
});
$autoloadFile = dirname(__DIR__, 5).DIRECTORY_SEPARATOR
	.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
if (!is_file($autoloadFile)) {
	// library is not installed using composer
	$autoloadFile = dirname(__DIR__, 3).DIRECTORY_SEPARATOR
		.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
	require_once $autoloadFile;
	Globals::setCache(
		'../_cache/',
		dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'_cache'
	);
} else {
	require_once $autoloadFile;
	Globals::setCache(
		'/vendor/antheia/antheia/examples/_cache/',
		dirname(__DIR__, 1).DIRECTORY_SEPARATOR.'_cache'
	);
}
/**
 * Configures a page (inserts a logo and some menus)
 * @param PageEmpty $page the page to be configured
 */
function init_configurePage(PageEmpty $page):void {
	// set the app logo
	Globals::setLogo('../_utils/logo.svg');
	$page->addHeadText(
		'<link rel="icon" type="image/png" href="../_utils/favicon.png">'
	);
	Globals::setTestMode();
	// inserts menus into the header bar, on the right
	$userMenu = new TopRightMenuUser();
	$userMenu->setRender($userMenu::BUTTON);
	$userMenu->setName('Username');
	$page->addTopRightMenu($userMenu);
	$exitMenu = new TopRightMenuExit();
	$exitMenu->setRender($exitMenu::LINK);
	$page->addTopRightMenu($exitMenu);
	// inserts some menus
	// *************************************************************** login
	$menu = new AppMenuPrimary();
	$page->addNavigationMenu($menu);
	$menu->setText('Login');
	$menu->setIconName('key-square', AbstractIcon::VECTOR);
	// login
	$subMenu = $menu->addSubmenu();
	$subMenu->setText('Login input');
	$subMenu->setHref('../login');
	$subMenu->setIconName('textfield_password');
	// loginFailed
	$subMenu = $menu->addSubmenu();
	$subMenu->setText('Login failed');
	$subMenu->setHref('../loginFailed');
	$subMenu->setIconName('exclamation');
	// ********************************************************** empty page
	$menu = new AppMenuPrimary();
	$page->addNavigationMenu($menu);
	$menu->setText('Readme example');
	$menu->setHref('../emptyPage');
	$menu->setIconName('picture_empty');
	// *************************************************************** start
	$menu = new AppMenuPrimary();
	$page->addNavigationMenu($menu);
	$menu->setText('Start testing');
	$menu->setHref('../start');
	$menu->setIconName('control_play');
	// ******************************************************** confirmation
	$menu = new AppMenuPrimary();
	$page->addNavigationMenu($menu);
	$menu->setText('Confirmation');
	$menu->setHref('../confirmation');
	$menu->setIconName('infocard');
	// **************************************************************** form
	$menu = new AppMenuPrimary();
	$page->addNavigationMenu($menu);
	$menu->setText('Forms');
	$menu->setHref('../forms');
	$menu->setIconName('form');
	// *************************************************************** modal
	$menu = new AppMenuPrimary();
	$page->addNavigationMenu($menu);
	$menu->setText('Modals');
	$menu->setHref('../modals');
	$menu->setIconName('app-window', AbstractIcon::VECTOR);
	// ************************************************************** panels
	$menu = new AppMenuPrimary();
	$page->addNavigationMenu($menu);
	$menu->setText('Panels');
	$menu->setHref('../panels');
	$menu->setIconName('form(2)');
	// ************************************************************** search
	$menu = new AppMenuPrimary();
	$menu->setText('Search');
	$menu->setIconName('page');
	$subMenu = $menu->addSubmenu();
	$subMenu->setText('Start');
	$subMenu->setHref('../searchStart');
	$subMenu->setIconName('page');
	// searchResultEmpty
	$subMenu = $menu->addSubmenu();
	$subMenu->setText('Empty result');
	$subMenu->setHref('../searchResultEmpty');
	$subMenu->setIconName('page');
	// searchResultAccordion
	$subMenu = $menu->addSubmenu();
	$subMenu->setText('Accordion');
	$subMenu->setHref('../searchResultAccordion');
	$subMenu->setIconName('page');
	// searchResultCards
	$subMenu = $menu->addSubmenu();
	$subMenu->setText('Cards');
	$subMenu->setHref('../searchResultCards');
	$subMenu->setIconName('page');
	// searchResultTable
	$subMenu = $menu->addSubmenu();
	$subMenu->setText('Table');
	$subMenu->setHref('../searchResultTable');
	$subMenu->setIconName('page');
	// **************************************************************** tabs
	$menu = new AppMenuPrimary();
	$page->addNavigationMenu($menu);
	$menu->setText('Tabs');
	$menu->setHref('../tabs');
	$menu->setIconName('tab');
	// *********************************************************** wireframe
	$menu = new AppMenuPrimary();
	$page->addNavigationMenu($menu);
	$menu->setText('Wireframe');
	$menu->setHref('../wireframe');
	$menu->setIconName('page');
}
/**
 * Configure a search result page. Defines some filters and insert items into
 * the result list
 * @param PageSearchResult $page the page to be configured
 */
function init_configureSearchResultPage(PageSearchResult $page):void {
	// adding the filters
	$filter = NewInput::text();
	$filter->setLabel('Given name');
	$filter->setPlaceholder('given name');
	$filter->setName('givenName');
	$filter->setDefaultValue('');
	$filter->setValue('John');
	$page->addInput($filter);
	// adding a text filter
	$filter = NewInput::text();
	$filter->setLabel('Family name');
	$filter->setPlaceholder('family name');
	$filter->setNameId('familyName');
	$filter->setDefaultValue('');
	$filter->setValue('Doe');
	$page->addInput($filter);
	// adding a select filter
	$filter = NewInput::select();
	$filter->setLabel('Status');
	$filter->setNameId('status');
	$filter->addOption('Does not matter', 'doesNotMatter', true);
	$filter->addOption('Active', 'active');
	$filter->addOption('Inactive', 'inactive');
	$filter->setDefaultValue('doesNotMatter');
	$page->addInput($filter);
	// adding the search sorting options
	$page->setSortBy([
			'name' => 'Name',
			'date' => 'Date of issue',
			'size' => 'Size of the item'
	], 'date');
	$page->setOrder(SearchForm::SORT_ASC);
	// defining the total number of pages and the current page
	$page->setPagination(1, 5);
	// adding the select options
	$page->showSelectOptions();
	$selectedItemsAction = new SearchOptionBarButton();
	$selectedItemsAction->setIcon('x');
	$selectedItemsAction->setText('Delete');
	$selectedItemsAction->setHref('index.php');
	$page->addSelectButton($selectedItemsAction);
	// adding the items
	for ($i = 0; $i < 5; $i++) {
		$element = new SearchResult();
		switch ($i) {
			case 2:
			case 3:
				$element->setName('Result<br> number'.($i + 1));
				break;
			default:
				$element->setName('Result '.($i + 1));
		}
		$element->addProperty('Property 1', 'Value 1');
		$element->addProperty('Property 2', 'Value 2');
		$element->addProperty('Property 3', '<a href="index.php">A link</a>');
		$element->setImageLink('index.php');
		if ($i === 1) {
			$icon = new IconVector('user');
			$element->setIcon($icon);
		}
		if ($i === 2) {
			$icon = new IconPixelBig('user');
			$element->setIcon($icon);
			// used only by LIST_TYPE_ACCORDION
			$element->addButton('A button', "alert('clicked')");
			$element->addButton('Another button', "alert('clicked')");
			$element->addButton('The third button', "alert('clicked')");
		}
		if ($i === 3) {
			$icon = new IconPixelBig('user','accept');
			$element->setIcon($icon);
		}
		// a link for accesing the details page for this result can be defined
		// used when the results are displayed using
		// LIST_TYPE_CARDS and LIST_TYPE_ACCORDION
		$element->setAccessHref("index.php");
		// used when the results are displayed using LIST_TYPE_CARDS
		$element->setAccessText('Details');
		$element->setDescription('Item description here');
		$element->setImageUrl('../_utils/justAnImage.jpg');
		if ($i === 1) {
			$element->setImageArea($element::IMAGE_AREA_FILL);
		}
		if ($i === 2 || $i === 4) {
			$element->setImageSize($element::IMAGE_SIZE_MAXIMUM);
			$element->setImageArea($element::IMAGE_AREA_FILL);
			$element->setAccessRender($element::BUTTON);
			$element->setAccessOnClick('alert()');
		}
		$inlineButton = new InlineButton();
		if ($i === 3) {
			$inlineButton->setText(
				'This is a really long name for an item, so long that it needs to be trimmed'
			);
		} else {
			$inlineButton->setText('Inline button');
		}
		$inlineButton->setOnClick("alert('clicked')");
		$inlineButton->setIcon('warning');
		$element->addProperty('Inline button', $inlineButton->getHtml());
		$page->addResult($element);
	}
	$page->setResultIndex(1, 5, 5);
}
?>