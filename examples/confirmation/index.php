<?php
use Antheia\Antheia\Classes\Page\PageEmpty;
use Antheia\Antheia\Classes\Wireframe\Wireframe;
use Antheia\Antheia\Classes\Input\InputButton;
use Antheia\Antheia\Classes\Html;
// init.php is used for initializing the framework
require '../_utils/init.php';
$page = new PageEmpty();
// this function is defined inside utils/init.php required file
init_configurePage($page);
$page->setTitle('Confirm messages');
$page->addJavascriptFile('script.js');
// the below message will be shown on load
$page->setInfoMessage('On load message', '../background.jpg');
$wireframe = new Wireframe();
$wireframe->setType($wireframe::TYPE_FIXED);
$row = $wireframe->addRow();
$cell = $row->addCell();
$panel = $cell->addPanel();
$panel->setTitle('Showing messages');
$button = new InputButton();
$button->setText('Full page message');
$button->setOnClick("ant_message('A full page message','../background.jpg')");
$panel->addElement($button);
$button = new InputButton();
$button->setText('Full page message with close on click');
$button->setOnClick("ant_message('A full page message','../background.jpg',true)");
$panel->addElement($button);
$panel->addElement(new Html(
	'<p><a href="https://unsplash.com/photos/z0nVqfrOqWA">Background photo</a>'
		.' by <a href="https://unsplash.com/@dnevozhai?'
		.'utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">'
		.'Denys Nevozhai</a>'
		.' on <a href="https://unsplash.com/?utm_source=unsplash&'
		.'utm_medium=referral&utm_content=creditCopyText">Unsplash</a></p>'
));
$button = new InputButton();
$button->setText('Small message');
$button->setOnClick("ant_message('Discreet message (toast type)')");
$panel->addElement($button);
$button = new InputButton();
$button->setText('Info type alert');
$button->setOnClick("alertInfo()");
$panel->addElement($button);
$button = new InputButton();
$button->setText('Error type alert');
$button->setOnClick("alertError()");
$panel->addElement($button);
$button = new InputButton();
$button->setText('Confirmation message');
$button->setOnClick("confirmModal()");
$panel->addElement($button);
// adding the wireframe to the page
$page->addElement($wireframe);
// adding a panel to display page source info
// the function is defined inside the utils/init.php file
init_insertPageSource($page, 'confirmation', [
		['name' => 'index.php', 'info' => 'main'],
		['name' => 'script.js', 'info' => 'js'],
], 'Example%3A-Confirm-messages');
// page export
echo $page->getHtml();
?>