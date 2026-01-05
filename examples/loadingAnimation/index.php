<?php
use Antheia\Antheia\Classes\Input\InputButton;
use Antheia\Antheia\Classes\Page\PageEmpty;
// init.php is used for initializing the framework
require '../_utils/init.php';
$page = new PageEmpty();
// this function is defined inside utils/init.php required file
init_configurePage($page);
$page->addJavascriptFile('script.js');
$page->setFixedTopMenu();
$page->setTitle('Loading animation');
$wireframe = $page->addWireframe();
$row = $wireframe->addRow();
$cell = $row->addCell();
$panel = $cell->addPanel();
$panel->setTitle('Start and control loading animation');
$button = new InputButton();
$button->setText('Load (only for 3 seconds)');
$button->setOnClick('load3seconds()');
$panel->addElement($button);
$button = new InputButton();
$button->setText('Load (steps with progress)');
$button->setOnClick('loadSteps()');
$panel->addElement($button);
$button = new InputButton();
$button->setText('Load (steps and cancel button)');
$button->setOnClick('loadStepsWithCancelButton()');
$panel->addElement($button);
// adding a panel to display page source info
// the function is defined inside the utils/init.php file
init_insertPageSource($page, 'loadingAnimation', [
		['name' => 'index.php', 'info' => 'main'],
		['name' => 'script.js', 'info' => 'js'],
], 'Example%3A-Loading-animation');
echo $page->getHtml();
?>
