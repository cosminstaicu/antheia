<?php
use Antheia\Antheia\Classes\Globals;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\AppMenu\AppMenuPrimary;
use Antheia\Antheia\Classes\AppMenu\AppMenuSecondary;
use Antheia\Antheia\Classes\Header\TopRightMenu\TopRightMenuExit;
use Antheia\Antheia\Classes\Header\TopRightMenu\TopRightMenuHelp;
use Antheia\Antheia\Classes\Header\TopRightMenu\TopRightMenuUser;
use Antheia\Antheia\Classes\Page\AbstractPage;
use Antheia\Antheia\Classes\Page\PageEmpty;
use Antheia\Antheia\Classes\Theme\ThemeRetroOrangeGray;
use Antheia\Antheia\Classes\Icon\AbstractIcon;
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
	$autoloadFile = dirname(__DIR__, 2).DIRECTORY_SEPARATOR
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
 * The function configures a page, injecting all the common elements, like
 * menus, buttons etc
 * @param AbstractPage $page the page to be configured
 */
function init_configurePage(AbstractPage $page):void {
	// set the app logo
	Globals::setLogo('../_utils/logo.svg');
	//******************************************************************** THEME
	$page->setTheme(new ThemeRetroOrangeGray());
	//******************************************************** TOP RIGHT OPTIONS
	// this can be a link for info about the logged user
	$option = new TopRightMenuUser();
	$option->setName('User name here');
	$option->setHtmlId('topMenuUserName');
	$option->setHref('../lookAndFeel');
	$page->addTopRightMenu($option);
	// a menu redered like a button
	$option = new TopRightMenuHelp();
	$option->setName('Button type menu');
	$option->setOnClick('alert()');
	$option->setRender($option::BUTTON);
	$page->addTopRightMenu($option);
	// this can be a link for the user to logout
	$option = new TopRightMenuExit();
	$option->setName('Exit');
	$option->setHref("javascript:alert('close action')");
	$page->addTopRightMenu($option);
	//************************************************************* PRIMARY MENU
	// simple content
	$menu = new AppMenuPrimary();
	$menu->setText('Look and feel');
	$menu->setHref('../lookAndFeel');
	$menu->setIconName('page');
	$menu->getIcon()->setBottomRightIcon('accept');
	$page->addNavigationMenu($menu);
	// positioning elements responsive
	$menu = new AppMenuPrimary();
	$menu->setText('Wireframes');
	$menu->setHref('../wireframe');
	$menu->setIconName('layouts_4');
	$page->addNavigationMenu($menu);
	// panels
	$menu = new AppMenuPrimary();
	$menu->setText('Panels');
	$menu->setHref('../panels');
	$menu->setIconName('new_window');
	$page->addNavigationMenu($menu);
	// forms
	$menu = new AppMenuPrimary();
	$menu->setText('Form');
	$menu->setHref('../forms');
	$menu->setIconName('application_form');
	$page->addNavigationMenu($menu);
	// tables
	$menu = new AppMenuPrimary();
	$menu->setText('Tables');
	$menu->setHref('../tables');
	$menu->setIconName('table');
	$page->addNavigationMenu($menu);
	// searches (with 2 submenus)
	$menu = new AppMenuPrimary();
	$menu->setText('Search');
	$menu->setIconName('user', AbstractIcon::VECTOR);
	$submenu = new AppMenuSecondary();
	$submenu->setIconName('search_field');
	$submenu->setText('Start');
	$submenu->setHref('../search');
	$menu->addSubmenu($submenu);
	$submenu = new AppMenuSecondary();
	$submenu->setIconName('text_list_bullets');
	$submenu->setText('Results');
	$submenu->setHref('../search/results.php');
	$menu->addSubmenu($submenu);
	$submenu = new AppMenuSecondary();
	$submenu->setIconName('search_field');
	$submenu->setText('Global search');
	$submenu->setHref('../search/topBarSearch.php');
	$menu->addSubmenu($submenu);
	$page->addNavigationMenu($menu);
	// message
	$menu = new AppMenuPrimary();
	$menu->setText('Message');
	$menu->setHref('../message');
	$menu->setIconName('calendar_view_day');
	$page->addNavigationMenu($menu);
	// confirmation messages
	$menu = new AppMenuPrimary();
	$menu->setText('Confirm messages');
	$menu->setHref('../confirmation');
	$menu->setIconName('tooltip');
	$page->addNavigationMenu($menu);
	// loading animations
	$menu = new AppMenuPrimary();
	$menu->setText('Loading');
	$menu->setHref('../loadingAnimation');
	$menu->setIconName('clock_select_remain');
	$page->addNavigationMenu($menu);
	// tabs
	$menu = new AppMenuPrimary();
	$menu->setText('Tabs');
	$menu->setHref('../tabs');
	$menu->setIconName('tab');
	$page->addNavigationMenu($menu);
	// modal
	$menu = new AppMenuPrimary();
	$menu->setText('Modal');
	$menu->setHref('../modal');
	$menu->setIconName('new_data');
	$page->addNavigationMenu($menu);
	// themes
	$menu = new AppMenuPrimary();
	$menu->setText('Themes');
	$menu->setIconName('color_wheel');
	$submenu = new AppMenuSecondary();
	$submenu->setIconName('color_swatches');
	$submenu->setText('Default');
	$submenu->setHref('../themes/default.php');
	$menu->addSubmenu($submenu);
	$submenu = new AppMenuSecondary();
	$submenu->setIconName('color_swatches');
	$submenu->setText('Dark aesthetics');
	$submenu->setHref('../themes/darkAesthetics.php');
	$menu->addSubmenu($submenu);
	$submenu = new AppMenuSecondary();
	$submenu->setIconName('color_swatches');
	$submenu->setText('Dusk');
	$submenu->setHref('../themes/dusk.php');
	$menu->addSubmenu($submenu);
	$submenu = new AppMenuSecondary();
	$submenu->setIconName('color_swatches');
	$submenu->setText('The Raven');
	$submenu->setHref('../themes/theRaven.php');
	$menu->addSubmenu($submenu);
	$submenu = new AppMenuSecondary();
	$submenu->setIconName('color_swatches');
	$submenu->setText('Retro Orange Gray');
	$submenu->setHref('../themes/retroOrangeGray.php');
	$menu->addSubmenu($submenu);
	$submenu = new AppMenuSecondary();
	$submenu->setIconName('color_swatches');
	$submenu->setText('Soft Warm');
	$submenu->setHref('../themes/softWarm.php');
	$menu->addSubmenu($submenu);
	$submenu = new AppMenuSecondary();
	$submenu->setIconName('color_swatches');
	$submenu->setText('Warm Rustic');
	$submenu->setHref('../themes/warmRustic.php');
	$menu->addSubmenu($submenu);
	$submenu = new AppMenuSecondary();
	$submenu->setIconName('color_swatches');
	$submenu->setText('Custom');
	$submenu->setHref('../themes/custom.php');
	$menu->addSubmenu($submenu);
	$page->addNavigationMenu($menu);
}
/**
 * Adds source info about the current page.
 * @param PageEmpty $page the page where the panel will be inserted
 * @param string $rootSource the name of the folder (on github) that contains
 * all source files for the page
 * @param array[] $sources a list with all page sources (hosted on github)
 * for the current page
 * @param string $wikipage the name of the github wiki page
 */
function init_insertPageSource(
		PageEmpty $page,
		string $rootSource,
		array $sources,
		string $wikipage):void {
	$code = '<p>Github page sources:</p><ul>';
	foreach ($sources as $sourceInfo) {
		$description = $sourceInfo['info'];
		switch ($sourceInfo['info']) {
			case 'main':
				$description = 'Main file for this page';
				break;
			case 'js':
				$description = 'JavaScript file for page actions';
				break;
		}
		$code .= '<li>'
			.'<a href="https://github.com/cosminstaicu/antheia/blob/main/examples/'
			.$rootSource.'/'.$sourceInfo['name'].'">'.$sourceInfo['name']
			.'</a>: '.$description.'</li>';
	}
	$code .= '</ul>';
	$code .= '<p>Find mode details about this page on the '
		.'<a href="https://github.com/cosminstaicu/antheia/wiki/'
		.$wikipage.'">GitHub Wiki Page</a>.</p>';
	$page->addWireframe()->addRow()->addCell()->addPanel()->addElement(new Html($code));
}
?>