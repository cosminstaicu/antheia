<?php
use Antheia\Framework\Globals;
use Antheia\Framework\Page\Login\PageLogin;
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
