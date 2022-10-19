<?php
use Antheia\Antheia\Classes\Page\PageEmpty;
use Antheia\Antheia\Classes\Input\InputButton;

// init.php is used for initializing the framework
require '../_utils/init.php';
$page = new PageEmpty();
// this function is defined inside utils/init.php required file
init_configurePage($page);
$page->setTitle('Page tabs');
// the first tab (selected)
$tab = $page->addTab();
$tab->setTitle('First tab');
$tab->setStatus($tab::STATUS_SELECTED);
$tab->setHtmlId('tab1');
$tab->setHref("javascript:alert('click on 1')");
$tab->setHrefClose("javascript:alert('close action')");
// the second tab
$tab = $page->addTab();
$tab->setTitle('Second tab');
$tab->setHtmlId('tab2');
$tab->setHref("javascript:alert('click on 2')");
// the third tab
$tab = $page->addTab();
$tab->setTitle('Third tab');
$tab->setHtmlId('tab3');
$tab->setAccent();
$tab->setHref("javascript:alert('click on 3')");
// define a wireframe to add a panel with controls
$wireframe = $page->addWireframe();
$row = $wireframe->addRow();
$cell = $row->addCell();
$panel = $cell->addPanel();
$panel->setTitle('Tab controls');
$button = new InputButton();
$button->setText('Select 1');
$button->setOnClick("ant_tab_select('tab1')");
$panel->addElement($button);
$button = new InputButton();
$button->setText('Select 2');
$button->setOnClick("ant_tab_select('tab2')");
$panel->addElement($button);
$button = new InputButton();
$button->setText('Select 3');
$button->setOnClick("ant_tab_select('tab3')");
$panel->addElement($button);
$button = new InputButton();
$button->setText('Rename tab 1');
$button->setOnClick("ant_tab_rename('tab1','Renamed')");
$panel->addElement($button);
$button = new InputButton();
$button->setText('Hide tab 2');
$button->setOnClick("ant_tab_hide('tab2')");
$panel->addElement($button);
$button = new InputButton();
$button->setText('Show tab 2');
$button->setOnClick("ant_tab_show('tab2')");
$panel->addElement($button);
// adding a panel to display page source info
// the function is defined inside the utils/init.php file
init_insertPageSource($page, 'tabs', [
		['name' => 'index.php', 'info' => 'main']
], 'Example%3A-Tabs');
// page export
echo $page->getHtml();
?>