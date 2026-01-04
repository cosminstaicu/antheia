<?php
use Antheia\Antheia\Classes\Page\PageSearchResult;
require '../_utils/init.php';
$page = new PageSearchResult();
// this function is defined inside utils/init.php required file
init_configurePage($page);
init_configureSearchResultPage($page);
$page->setTitle('Search results');
$page->setListType($page::LIST_TYPE_ACCORDION);
echo $page->getHtml();
?>
