<?php
/**
 * This script will not be accessed directly by the user. The script is
 * automatically requested by the browser when the user is filling the "text field with
 * server suggestions" input inside the form.php example
 */
require '../_utils/init.php';
use Antheia\Antheia\Classes\Input\SuggestionResponse\SuggestionList;
use Antheia\Antheia\Classes\Exception;
if (!isset($_POST['value'])) {
	throw new Exception('Value is not set');
}
// all available suggestion values are defined below
$values = [
	'Andreea','Anthony','Anabella','Anetta','Anastasia', 'Angelica','Anna','Anne-Marie','Antonia',
	'Lisa','Lizzie','Livia','Lindsay','Lilianne','Lilly','Liana','Lindy','Liane','Liberty'
];
// making the post value lowercase, to make the comparation case insensitive
$postValue = strtolower($_POST['value']);
$length = strlen($postValue);
$suggestions = new SuggestionList();
foreach ($values as $value) {
	if (substr(strtolower($value), 0, $length) === $postValue) {
		$suggestion = $suggestions->addSuggestion();
		$suggestion->setValue($value);
	}
}
echo $suggestions->getHtml();
?>