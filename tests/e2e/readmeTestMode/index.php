<?php

use Antheia\Antheia\Classes\Globals;
use Antheia\Antheia\Classes\Header\TopRightMenu\TopRightMenuUser;
use Antheia\Antheia\Classes\Page\PageEmpty;
// init.php is used for initializing the library
require '../_utils/init.php';
// create a new empty page
$page = new PageEmpty();
// creates a menu on the top right side
$option = new TopRightMenuUser();
// defines the testid value
$option->setTestId('topMenuUser');
$option->setName('User name here');
$option->setHref('#');
$page->addTopRightMenu($option);
// If Globals::setTestMode() is called then the HTML tag for
// the menu will contain data-testid = "topMenuUser"
// If the method is not called then the HTML tag will not
// have the attribute
Globals::setTestMode();
// output the page content
echo $page->getHtml();
?>
