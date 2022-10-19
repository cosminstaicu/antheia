<?php
use Antheia\Antheia\Classes\Page\PageSearch;
use Antheia\Antheia\Classes\Input\InputText;
use Antheia\Antheia\Classes\Input\InputSelect;
require '../_utils/init.php';
$page = new PageSearch();
// this function is defined inside utils/init.php required file
init_configurePage($page);
$page->setTitle('Start search');
$page->setUrl('results.php');
// adding a text input
$filter = new InputText();
$filter->setLabel('Given name');
$filter->setPlaceholder('given name');
$filter->setName('givenName');
$page->addInput($filter);
// adding another text input
$filter = new InputText();
$filter->setLabel('Family name');
$filter->setPlaceholder('family name');
$filter->setName('familyName');
$page->addInput($filter);
// adding a select input
$filter = new InputSelect();
$filter->setLabel('Status');
$filter->setName('status');
$filter->addOption('Does not matter', 'doesNotMatter', true);
$filter->addOption('Active', 'active');
$filter->addOption('Inactive', 'inactive');
$page->addInput($filter);
// (optional) defining the start search button text
$page->setButtonText('Start searching');
// adding a panel to display page source info
// the function is defined inside the utils/init.php file
init_insertPageSource($page, 'search', [
		['name' => 'index.php', 'info' => 'main']
], 'Example%3A-Search-start');
// page export
echo $page->getHtml();
?>