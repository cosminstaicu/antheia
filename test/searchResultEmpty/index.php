<?php
use Antheia\Antheia\Classes\Globals;
use Antheia\Antheia\Classes\Page\Login\PageLogin;
use Antheia\Antheia\Classes\Page\PageSearchResult;
require '../_utils/init.php';
$page = new PageSearchResult();
init_configurePage($page);
echo $page->getHtml();
?>