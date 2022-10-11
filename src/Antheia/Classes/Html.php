<?php
namespace Cosmin\Antheia\Classes;
use Cosmin\Antheia\Interfaces\HtmlCode;
/**
 * An element that can be added to a HTML page. The element is
 * a container for raw HTML code or some other objects that are implementing
 * the HtmlCode interface
 * @author Cosmin Staicu
 */
class Html extends AbstractClass implements HtmlCode {
	private $list;
	private $rawCode;
	/**
	 * The constructor for an element that can be added to a HTML page
	 * @param string $code (optional) raw HTML code that will be added to the
	 * element
	 */
	public function __construct(string $code = '') {
		parent::__construct();
		$this->list = [];
		$this->rawCode = '';
		$this->rawCode .= $code;
	}
	/**
	 * Adds an html element
	 * @param HtmlCode $element the added element
	 */
	public function addElement(HtmlCode $element):void {
		$this->list[] = $element;
	}
	/**
	 * Adds raw HTML code to the element
	 * @param string $code the code to be addes
	 */
	public function addRawCode($code):void {
		if (count($this->list) === 0) {
			$this->rawCode .= $code;
		} else {
			$code = new Html($code);
			$this->addElement($code);
		}
	}
	public function getHtml():string {
		$code = $this->rawCode;
		/** @var HtmlCode $element */
		foreach ($this->list as $element) {
			$code .= $element->getHtml();
		}
		return $code;
	}
}
?>