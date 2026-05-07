<?php
use Antheia\Framework\Classes\Globals;
use Antheia\Framework\Classes\Page\Login\PageLoginFailed;
// init.php is used for initializing the library
require '../_utils/init.php';
$page = new PageLoginFailed();
Globals::setLogo('../_utils/logo.svg');
$page->setUrl('../login/');
echo $page->getHtml();
?>
