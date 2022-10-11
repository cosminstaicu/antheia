<?php
use Antheia\Antheia\Classes\Page\PageEmpty;
use Antheia\Antheia\Classes\Input\InputButton;

// init.php is used for initializing the framework
require '../utils/init.php';
$page = new PageEmpty();
// this function is defined inside utils/init.php required file
init_configurePage($page);
$page->addJavascriptFile('script.js');
$page->setTitle('Modal example');
$wireframe = $page->addWireframe();
$row = $wireframe->addRow();
// simple modal
$cell = $row->addCell();
$cell->addWidth('md', 6);
$panel = $cell->addPanel();
$panel->setTitle('Simple modal');
$panel->addText(
	'<p>A simple modal with no special features. Closes when clicked outside.</p>');
$button = new InputButton();
$button->setText('Show modal');
$button->setOnClick('simpleModal()');
$panel->addElement($button);
// html elements content and live modal content changes
$cell = $row->addCell();
$cell->addWidth('md', 6);
$panel = $cell->addPanel();
$panel->setTitle('Live content update');
$panel->addText(
	'<p>Opens a modal and updates it after 2 seconds by changing the
	content and removing the footer. After 2 more seconds, a button is inserted
	into the footer.</p>');
$button = new InputButton();
$button->setText('Show modal');
$button->setOnClick('contentUpdateModal()');
$panel->addElement($button);
// loading animation modal
$row = $wireframe->addRow();
// simple modal
$cell = $row->addCell();
$cell->addWidth('md', 6);
$panel = $cell->addPanel();
$panel->setTitle('Loading animation');
$panel->addText(
	'<p>A simple modal that starts a loading animation after 2 seconds. The animation
	lasts 3 seconds, while the modal content is updated. After the animation
	finishes, the new content is displayed.</p>');
$button = new InputButton();
$button->setText('Show modal');
$button->setOnClick('loadingModal()');
$panel->addElement($button);
// adding a panel to display page source info
// the function is defined inside the utils/init.php file
init_insertPageSource($page, '09_modal', [
		['name' => 'index.php', 'info' => 'main'],
		['name' => 'script.js', 'info' => 'js'],
], 'Example-9%3A-Modals');
echo $page->getHtml();
?>