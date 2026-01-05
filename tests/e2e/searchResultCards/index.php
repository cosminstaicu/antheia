<?php
use Antheia\Antheia\Classes\Page\PageSearchResult;
// init.php is used for initializing the framework
require '../_utils/init.php';
$page = new PageSearchResult();
init_configurePage($page);
init_configureSearchResultPage($page);
$page->setTitle('Search results');
$page->setListType($page::LIST_TYPE_CARDS);
echo $page->getHtml();
?>
