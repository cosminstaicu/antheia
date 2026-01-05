<?php
use Antheia\Antheia\Classes\Input\NewInput;
use Antheia\Antheia\Classes\Page\PageSearch;
require '../_utils/init.php';
$page = new PageSearch();
init_configurePage($page);
$page->setTitle('Search start page');
$page->setUrl('index.php');
// adding a text input
$filter = NewInput::text();
$filter->setLabel('Given name');
$filter->setPlaceholder('given name');
$filter->setName('givenName');
$page->addInput($filter);
// this input will get the focus after the page has been loaded
$page->setAutofocus($filter);
// adding another text input
$filter = NewInput::text();
$filter->setLabel('Family name');
$filter->setPlaceholder('family name');
$filter->setName('familyName');
$page->addInput($filter);
// adding a select input
$filter = NewInput::select();
$filter->setLabel('Status');
$filter->setName('status');
$filter->addOption('Does not matter', 'doesNotMatter', true);
$filter->addOption('Active', 'active');
$filter->addOption('Inactive', 'inactive');
$page->addInput($filter);
$page->setButtonText('Start searching');
// exporting the page
echo $page->getHtml();
?>
