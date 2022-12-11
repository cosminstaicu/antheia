<?php
use Antheia\Antheia\Classes\Input\InputButton;
use Antheia\Antheia\Classes\Page\PageEmpty;
// init.php is used for initializing the framework
require '../_utils/init.php';
$page = new PageEmpty();
// this function is defined inside utils/init.php required file
init_configurePage($page);
$page->setTitle('Page tabs');
// the first tab (selected)
$tab = $page->addTab();
$tab->setTitle('Link with close');
$tab->setStatus($tab::STATUS_SELECTED);
$tab->setHtmlId('tab1');
$tab->setHref("javascript:alert('click on 1')");
$tab->setOnClickClose("alert('close action for 1')");
// the second tab
$tab = $page->addTab();
$tab->setTitle('Link without close');
$tab->setHtmlId('tab2');
$tab->setHref("javascript:alert('click on 2')");
// the third tab
$tab = $page->addTab();
$tab->setTitle('Button with close');
$tab->setHtmlId('tab3');
$tab->setRender($tab::BUTTON);
// $tab->setAccent();
$tab->setOnClick("alert('click on 3')");
$tab->setOnClickClose("alert('close action for 3')");
// the 4th tab
$tab = $page->addTab();
$tab->setTitle('Button without close');
$tab->setHtmlId('tab4');
$tab->setRender($tab::BUTTON);
$tab->setAccent();
$tab->setOnClick("alert('click on 3')");
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