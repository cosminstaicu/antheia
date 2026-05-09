<?php
use Antheia\Framework\Globals;
use Antheia\Framework\Page\Login\PageLoginFailed;
// init.php is used for initializing the library
require '../_utils/init.php';
$page = new PageLoginFailed();
Globals::setLogo('../_utils/logo.svg');
$page->setUrl('../login/');
echo $page->getHtml();
?>
