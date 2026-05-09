<?php
use Antheia\Framework\Page\PageSearchResult;
require '../_utils/init.php';
$page = new PageSearchResult();
init_configurePage($page);
init_configureSearchResultPage($page);
$page->setTitle('Search results');
$page->setListType($page::LIST_TYPE_TABLE);
echo $page->getHtml();
?>
