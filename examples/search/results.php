<?php
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Input\NewInput;
use Antheia\Antheia\Classes\Page\PageSearchResult;
use Antheia\Antheia\Classes\Search\SearchOptionBarButton;
use Antheia\Antheia\Classes\Search\SearchResult;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\InlineButton\InlineButton;
// init.php is used for initializing the framework
require '../_utils/init.php';
$page = new PageSearchResult();
// this function is defined inside utils/init.php required file
init_configurePage($page);
$page->setTitle('Search results');
$page->showSelectOptions();
$selectedItemsAction = new SearchOptionBarButton();
$selectedItemsAction->setIcon(IconVector::ICON_DELETE);
$selectedItemsAction->setText('Delete');
$selectedItemsAction->setHref('javascript:alert()');
$page->addSelectButton($selectedItemsAction);
// adding the filters (they are the same as the ones inside the startSearch page)
$filter = NewInput::text();
$filter->setLabel('Given name');
$filter->setPlaceholder('given name');
$filter->setName('givenName');
$filter->setDefaultValue('');
if (isset($_POST['givenName'])) {
	$filter->setValue($_POST['givenName']);
}
$page->addInput($filter);
// adding a text filter
$filter = NewInput::text();
$filter->setLabel('Family name');
$filter->setPlaceholder('family name');
$filter->setNameId('familyName');
$filter->setDefaultValue('');
if (isset($_POST['familyName'])) {
	$filter->setValue($_POST['familyName']);
}
$page->addInput($filter);
// adding a select filter
$filter = NewInput::select();
$filter->setLabel('Status');
$filter->setNameId('status');
$filter->addOption('Does not matter', 'doesNotMatter', true);
$filter->addOption('Active', 'active');
$filter->addOption('Inactive', 'inactive');
$filter->setDefaultValue('doesNotMatter');
if (isset($_POST['status'])) {
	$filter->setValue($_POST['status']);
}
// adding the search sorting options
$page->setSortBy([
		'name' => 'Name',
		'date' => 'Date of issue',
		'size' => 'Size of the item'
], 'date');
$page->addInput($filter);
// defining the total number of pages and the current page
if (isset($_POST['page'])) {
	$currentPage = $_POST['page'];
} else {
	$currentPage = 1;
}
$page->setPagination($currentPage, 5);
// adding some results to the list
for ($i = 0; $i < 5; $i++) {
	$element = new SearchResult();
	$element->setName('Result '.($i + 1));
	$element->addProperty('Property 1', 'Value 1');
	$element->addProperty('Property 2', 'Value 2');
	$element->addProperty('Property 3', '<a href="javascript:alert()">A link</a>');
	$element->setImageLink('javascript:alert(\'click on image\')');
	// used only by LIST_TYPE_ACCORDION
	if ($i === 1) {
		$element->setIcon('user');
	}
	if ($i === 2) {
		$element->setIcon('user', 'accept');
		$element->addButton('A button', "alert('clicked')");
		$element->addButton('Another button', "alert('clicked')");
		$element->addButton('The third button', "alert('clicked')");
	}
	// a link for accesing the details page for this result can be defined
	// used when the results are displayed using 
	// LIST_TYPE_CARDS and LIST_TYPE_ACCORDION
	$element->setAccessHref("javascript:alert('code for access')");
	// used when the results are displayed using LIST_TYPE_CARDS
	$element->setAccessText('Details');
	$element->setDescription('Item description here');
	$element->setImageUrl('../background.jpg');
	if ($i === 1) {
		$element->setImageArea($element::IMAGE_AREA_FILL);
	}
	if ($i === 2 || $i === 4) {
		$element->setImageSize($element::IMAGE_SIZE_MAXIMUM);
		$element->setImageArea($element::IMAGE_AREA_FILL);
		$element->setAccessRender($element::BUTTON);
		$element->setAccessOnClick('alert()');
	}
	$inlineButton = new InlineButton();
	$inlineButton->setText('Inline button');
	$inlineButton->setOnClick("alert('clicked')");
	$inlineButton->setIcon('warning');
	$element->addProperty('Inline button', $inlineButton->getHtml());
	$page->addResult($element);
}
// defining the current and total number of results
$page->setResultIndex(1, 5, 25);
// the results can be shown using different renders
$page->setListType($page::LIST_TYPE_CARDS);
// $page->setListType($page::LIST_TYPE_TABLE);
// $page->setListType($page::LIST_TYPE_ACCORDION);
// adding a panel to display page source info
// the function is defined inside the utils/init.php file
init_insertPageSource($page, 'search', [
		['name' => 'results.php', 'info' => 'main']
], 'Example%3A-Search-result');
// page export
echo $page->getHtml();
?>