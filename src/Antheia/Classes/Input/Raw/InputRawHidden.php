<?php
namespace Antheia\Antheia\Classes\Input\Raw;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Internals;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Interfaces\HtmlAttribute;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
/**
 * A hidden input html tag
 * @author Cosmin Staicu
 */
class InputRawHidden extends AbstractClass 
implements HtmlCode, HtmlAttribute, HtmlId {
	private $htmlId;
	private $testId;
	private $name;
	private $value;
	private $attributes;
	public function __construct() {
		$this->htmlId = '';
		$this->testId = '';
		$this->name = '';
		$this->value = '';
		$this->attributes = [];
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	public function setTestId(string $id):void {
		$this->testId = $id;
	}
	/**
	 * Returns the html id for the input
	 * @return string $id the html id for the input
	 */
	public function getHtmlId():string {
		return $this->htmlId;
	}
	/**
	 * Defines the name of the input (the name attribute from the html tag)
	 * @param string $name the name of the input
	 */
	public function setName(string $name):void {
		$this->name = $name;
	}
	/**
	 * Defines the name and the html id for the element in a single method
	 * (the name attribute and the id attribute from the tag)
	 * @param string $nameId the value for the two properties
	 */
	public function setNameId(string $nameId):void {
		$this->setName($nameId);
		$this->setHtmlId($nameId);
	}
	/**
	 * Defines the value for the input
	 * @param string $value the value of the input
	 */
	public function setValue(string $value):void {
		$this->value = $value;
	}
	public function addAttribute(string $name, string $value):void {
		$this->attributes[] = ['name'=>$name, 'value'=>$value];
	}
	public function addTextAttribute(string $name, string $value):void {
		$this->addAttribute('data-text-'.$name, Texts::get($value));
	}
	public function getHtml():string {
		if ($this->name == '') {
			throw new Exception('setName');
		}
		$code = '<input type="hidden" name="'.htmlspecialchars($this->name)
				.'"	value="'.htmlspecialchars($this->value).'" ';
		$code .= Internals::getHtmlIdCode($this->htmlId, $this->testId);
		foreach ($this->attributes as $atribut) {
			$code .= ' '.$atribut['name'].'="'.$atribut['value'].'"';
		}
		$code .= '>';
		return $code;
	}
}
?>
