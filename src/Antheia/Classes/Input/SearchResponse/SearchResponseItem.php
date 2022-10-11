<?php
namespace Cosmin\Antheia\Classes\Input\SearchResponse;
use Cosmin\Antheia\Classes\AbstractClass;
use Cosmin\Antheia\Interfaces\HtmlCode;
use Cosmin\Antheia\Classes\Exception;
/**
 * The class defines an element resulted from a search input. This type 
 * of element will be added to a SearchResponseList instance.
 * @author Cosmin Staicu
 */
class SearchResponseItem extends AbstractClass implements HtmlCode {
	private $name;
	private $value;
	public function __construct() {
		parent::__construct();
		$this->name = null;
		$this->value = null;
	}
	/**
	 * Defines the name and the value of the element
	 * @param string $name the name of the element (the visible text)
	 * @param string $value the value that will be submitted to the server
	 * when the form, containing the input is submitted
	 */
	public function setNameValue(string $name, string $value):void {
		$this->name = $name;
		$this->value = $value;
	}
	public function getHtml():string {
		if ( $this->name === NULL ) {
			throw new Exception('Name is not defined');
		}
		if ( $this->value === NULL ) {
			throw new Exception('Value is not defined');
		}
		return '<a href="javascript:void(0)" data-value="'.$this->value
			.'" onClick="ant_inputSearch_selectItem(this)">'
			.$this->name.'</a>';
	}
}
?>