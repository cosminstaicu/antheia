<?php
namespace Antheia\Antheia\Classes\Input\SuggestionResponse;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Interfaces\HtmlCode;
class SuggestionList extends AbstractClass implements HtmlCode {
	/**
	 * @var SuggestionItem[]
	 */
	private $suggestions;
	public function __construct() {
		$this->suggestions = [];
	}
	/**
	 * Adds a suggestion to this suggestion list
	 * @param SuggestionItem $suggestion (optional) the suggestion to be added
	 * to the list (if the parameter is not provided then a new suggestion will
	 * be created automatically)
	 * @return SuggestionItem the item that has been added to the list
	 */
	public function addSuggestion(SuggestionItem $suggestion = NULL):SuggestionItem {
		if ($suggestion === NULL) {
			$suggestion = new SuggestionItem();
		}
		$this->suggestions[] = $suggestion;
		return $suggestion;
	}
	public function getHtml():string {
		if (count($this->suggestions) === 0) {
			return '';
		}
		$code = '';
		foreach ($this->suggestions as $suggestion) {
			$code .= '<button onpointerdown="ant_inputText_selected(this)" type="button">'
					.htmlspecialchars($suggestion->getValue()).'</button>';
		}
		return $code;
	}
}
?>