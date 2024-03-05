<?php
use Antheia\Antheia\Classes\Page\Login\PageLoginFailed;
use Antheia\Antheia\Classes\Globals;
/**
 * The login failed page
 */
// init.php is used for initializing the library
require '../_utils/init.php';
$page = new PageLoginFailed();
Globals::setLogo('../_utils/logo.svg');
$page->setUrl('index.php');
echo $page->getHtml();
?>