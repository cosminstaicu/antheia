<?php
namespace Antheia\Antheia\Classes\Input;
/**
 * The class defines an info, that can be used to display some information
 * inside a form. The html elemen has no attached data to be sent to the server
 * @author Cosmin Staicu
 */
class InputInfo extends AbstractInput {
	public function __construct() {
		parent::__construct();
		$this->exportForAttributeInLabel(false);
	}
	public function getHtml():string {
		$code = '<span';
		if ($this->getHtmlId() !== '') {
			$code .= ' id="'.$this->getHtmlId().'"';
		}
		$code .= $this->getAttributesAsText();
		$code .= '>'.$this->getValue().'</span>';
		parent::setHtmlCode($code);
		return parent::getHtml();
	}
}
?>