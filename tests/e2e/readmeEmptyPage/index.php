<?php
use Antheia\Antheia\Classes\Page\PageEmpty;
// init.php is used for initializing the library
require '../_utils/init.php';
$page = new PageEmpty();
echo $page->getHtml();
?>
