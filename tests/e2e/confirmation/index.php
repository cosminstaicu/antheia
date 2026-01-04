<?php
use Antheia\Antheia\Classes\Input\InputButton;
use Antheia\Antheia\Classes\Page\PageEmpty;
use Antheia\Antheia\Classes\Wireframe\Wireframe;
// init.php is used for initializing the framework
require '../_utils/init.php';
$page = new PageEmpty();
// this function is defined inside utils/init.php required file
init_configurePage($page);
$page->setTitle('Confirm messages');
$page->addJavascriptFile('script.js');
// the below message will be shown on load
$page->setInfoMessage('On load message', '../_utils/justAnImage.jpg');
$wireframe = new Wireframe();
$wireframe->setType($wireframe::TYPE_FIXED);
$row = $wireframe->addRow();
$cell = $row->addCell();
$panel = $cell->addPanel();
$panel->setTitle('Showing messages');
$button = new InputButton();
$button->setText('Full page message');
$button->setHtmlId('buttonFullPage');
$button->setOnClick("ant_message('A full page message','../_utils/justAnImage.jpg')");
$panel->addElement($button);
$button = new InputButton();
$button->setText('Full page message with close on click');
$button->setHtmlId('buttonFullPageCloseOnClick');
$button->setOnClick("ant_message('A full page message','../_utils/justAnImage.jpg',true)");
$panel->addElement($button);
$button = new InputButton();
$button->setText('Small message');
$button->setHtmlId('buttonSmallMessage');
$button->setOnClick("ant_message('Discreet message (toast type)')");
$panel->addElement($button);
$button = new InputButton();
$button->setText('Info type alert');
$button->setOnClick("alertInfo()");
$button->setHtmlId('buttonInfoAlert');
$panel->addElement($button);
$button = new InputButton();
$button->setText('Error type alert');
$button->setOnClick("alertError()");
$button->setHtmlId('buttonErrorAlert');
$panel->addElement($button);
$button = new InputButton();
$button->setText('Confirmation message');
$button->setHtmlId('buttonConfirm');
$button->setOnClick("confirmModal()");
$panel->addElement($button);
// adding the wireframe to the page
$page->addElement($wireframe);
// page export
echo $page->getHtml();
?>
