<?php
use Antheia\Antheia\Classes\Globals;
use Antheia\Antheia\Classes\Page\Login\PageLogin;
/**
 * The login page
 */
// init.php is used for initializing the library
require '../_utils/init.php';
$page = new PageLogin();
Globals::setLogo('../_utils/logo.svg');
// in production, this url should redirect to a login script
// this is just an example, so it redirects to a login failed page
$page->setUrl('failed.php');
echo $page->getHtml();
?>