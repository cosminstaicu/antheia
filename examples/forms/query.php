<?php
use Antheia\Antheia\Classes\Input\SearchResponse\SearchResponseList;
use Antheia\Antheia\Classes\Input\SearchResponse\SearchResponseItem;

/**
 * This script will not be accessed directly by the user. The script is 
 * automatically requested by the browser when the user is filling the "search"
 * input inside the form.php example
 */
require '../_utils/init.php';
$values = [
	'selectMaria' => 'Maria',
	'selectAndreea' => 'Andreea',
	'selectGeorge' => 'George',
	'selectJojn' => 'John'
];
$list = new SearchResponseList();
foreach ($values as $index => $answer) {
	if ($_POST['value'] === '') {
		$item = new SearchResponseItem();
		$item->setNameValue($answer, $index);
		$list->addItem($item);
		continue;
	}
	if (stripos($answer, $_POST['value']) !== false) {
		$item = new SearchResponseItem();
		$item->setNameValue($answer, $index);
		$list->addItem($item);
	}
}
echo $list->getHtml();
?>