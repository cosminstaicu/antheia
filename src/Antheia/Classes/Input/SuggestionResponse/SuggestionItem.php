<?php
namespace Antheia\Antheia\Classes\Input\SuggestionResponse;
use Antheia\Antheia\Classes\AbstractClass;
/**
 * The class defines a suggestion for a text type input. This suggestion will
 * be loaded into a SuggestionList (along with others) then sent back to
 * the client
 * @author Cosmin Staicu
 */
class SuggestionItem extends AbstractClass {
	private $value;
	public function __construct() {
		$this->value = '';
	}
	/**
	 * Sets the value of the suggestion
	 * @param string $value the value of the suggestion
	 */
	public function setValue(string $value):void {
		$this->value = $value;
	}
	/**
	 * Returns the value of the suggestion
	 * @return string the value (the text) of the suggestion
	 */
	public function getValue():string {
		return $this->value;
	}
}
?>