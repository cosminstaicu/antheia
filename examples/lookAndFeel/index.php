<?php
use Antheia\Antheia\Classes\Header\TopRightMenu\TopRightMenuAlert;
use Antheia\Antheia\Classes\Menu\Item\NewMenu;
use Antheia\Antheia\Classes\Page\PageEmpty;
use Antheia\Antheia\Classes\Panel\Panel;
use Antheia\Antheia\Classes\Wireframe\Wireframe;
/**
 * This is just a simple page with some content, to get a look and feel of the
 * library. Further details for each component can be found in the next pages.
 */
// init.php is used for initializing the library
require '../_utils/init.php';
$page = new PageEmpty();
// checking the framework compatibility with the user browser
$page->checkCompatibility();
// adding an alert top right menu, as the first item,
// before the ones inside the init_configurePage() function
$alertMenu = new TopRightMenuAlert();
$alertMenu->setRender($alertMenu::BUTTON);
$alertMenu->setOnClick('alert()');
$alertMenu->setName('An alert');
$page->addTopRightMenu($alertMenu);
// this function is defined inside utils/init.php required file
init_configurePage($page);
// a background image for the header
$page->setHeaderBackgroundImage('../headerImage.jpg');
// if the following line is enables then the title will not have a background
// $page->getHeader()->disableTitleBackground();
// defining the page title
$page->setTitle('Look and feel');
// the page menu
$pageMenu = NewMenu::add();
$pageMenu->addClass('custom-css-class');
$pageMenu->setHref("javascript:alert('some action here')");
$page->addPageMenu($pageMenu);
$pageMenu = NewMenu::info();
$pageMenu->setRender($pageMenu::BUTTON);
$pageMenu->setOnClick("alert('some action here')");
$page->addPageMenu($pageMenu);
$pageMenu = NewMenu::delete();
$pageMenu->setHref("javascript:alert('some action here')");
$page->addPageMenu($pageMenu);
// some tabs
$tab = $page->addTab();
$tab->setTitle('Selected tab');
$tab->setHref('javascript:alert(1)');
$tab->setStatus($tab::STATUS_SELECTED);
$tab = $page->addTab();
$tab->setTitle('Another tab');
$tab->setHref('javascript:alert(2)');
// defining a responsive wireframe that will be inserted into the page
$wireframe = new Wireframe();
// the wireframe will have a fixed width, depending on the width of the window
$wireframe->setType($wireframe::TYPE_FIXED);
// the wireframe contains one or more rows, that can be instantiated like below
$row = $wireframe->addRow();
// each row can contain one ore more cells
$cell = $row->addCell();
// the cell will fill up the entire available width
$cell->addWidth('xs', 12);
// defining a panel to be displayed inside the wireframe
$panel = new Panel();
$panel->setTitle('What is Antheia Frontend');
$panel->addText('<p>Antheia is a frontend library for web apps, written in PHP,
fully compatible with mobile devices (responsive). It is designed to be
used by web apps as it contains features designed mainly for cloud services.</p>
<p>The library is hosted on
<a href="https://github.com/cosminstaicu/antheia" target="_blank">GitHub</a>.</p>
<p>The main project using this library is the Cloud PBX Service, called
Accolades and provided by
<a href="https://www.voipit.ro" target="_blank">VoIPIT România</a>.</p>');
$cell->addElement($panel);
// adding another row
$row = $wireframe->addRow();
// adding a cell
$cell = $row->addCell();
// on medium width and above, the cell will ocupy 6 of the 12 available column
// that means 50% of the row width
// on small screens the with will be 100% (default)
$cell->addWidth('md', 6);
// defining a panel to be displayed inside the wireframe
$panel = new Panel();
$panel->setTitle('Panel title');
// defining the menu for the panel
$panelMenu = NewMenu::add();
$panelMenu->setHref("javascript:alert('some action here')");
$panel->addMenu($panelMenu);
$panelMenu = NewMenu::info();
$panelMenu->setHref("javascript:alert('some action here')");
$panel->addMenu($panelMenu);
$panelMenu = NewMenu::delete();
$panelMenu->setRender($panelMenu::BUTTON);
$panelMenu->setOnClick("alert('some action here')");
$panel->addMenu($panelMenu);
$playbackMenu = NewMenu::play();
$playbackMenu->setRender($panelMenu::BUTTON);
$playbackMenu->setOnClick("alert('some action here')");
$panel->addMenu($playbackMenu);
$panel->addText('This is a panel with a menu');
// adding the container to the cell of the wireframe
$cell->addElement($panel);
// defining a new cell
$cell = $row->addCell();
$cell->addWidth('md', 6);
// a panel can be directly instantiated from the cell that will host it
$panel = $cell->addPanel();
$panel->addText('<p>another panel, with no menu or title</p>');
$panel->addText(
	'<p><a href="https://unsplash.com/photos/2xU7rYxsTiM">Header background photo</a>'
		.' by <a href="https://unsplash.com/@skabrera?utm_source=unsplash&'
		.'utm_medium=referral&utm_content=creditCopyText">'
		.'Sergi Kabrera</a>'
		.' on <a href="https://unsplash.com/photos/2xU7rYxsTiM?'
		.'utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">'
		.'Unsplash</a>.</p>'
);
// adding the wireframe to the page
$page->addElement($wireframe);
// adding a panel to display page source info
// the function is defined inside the utils/init.php file
init_insertPageSource($page, 'lookAndFeel', [
		['name' => 'index.php', 'info' => 'main']
], 'Example%3A-Look-and-feel');
// exporting the html code from the page
echo $page->getHtml();
?>