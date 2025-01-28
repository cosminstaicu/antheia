<?php
use Antheia\Antheia\Classes\Page\PageSearch;
use Antheia\Antheia\Classes\Input\InputText;
use Antheia\Antheia\Classes\Input\InputSelect;
use Antheia\Antheia\Classes\Page\PageEmpty;
require '../_utils/init.php';
$page = new PageEmpty();
// this function is defined inside utils/init.php required file
init_configurePage($page);
$page->setTitle('Global search');
$topSearch = $page->getTopSearchForm();
$topSearch->setFormAction('topBarSearch.php');
$topSearch->setOnSubmit('ant_loading_start(true)');
$topSearch->setInputPlaceholder('search here');
$panel = $page->addWireframe()->addRow()->addCell()->addPanel();
$panel->addText(
	'This page has a search input field, placed on the top bar.
	The input is contained inside a form.'
);
// adding a panel to display page source info
// the function is defined inside the utils/init.php file
init_insertPageSource($page, 'search', [
		['name' => 'topBarSearch.php', 'info' => 'main']
], 'Example%3A-Search-global');
// page export
echo $page->getHtml();
?>