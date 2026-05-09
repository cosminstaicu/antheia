<?php
use Antheia\Framework\Page\PageSearchResult;
require '../_utils/init.php';
$page = new PageSearchResult();
init_configurePage($page);
echo $page->getHtml();
?>
