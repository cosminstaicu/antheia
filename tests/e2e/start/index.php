<?php
use Antheia\Framework\Page\PageEmpty;
// init.php is used for initializing the framework
require '../_utils/init.php';
$page = new PageEmpty();
init_configurePage($page);
$page->setTitle('Start page');
echo $page->getHtml();
?>
