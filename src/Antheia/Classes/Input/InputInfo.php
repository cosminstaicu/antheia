<?php
namespace Antheia\Antheia\Classes\Input;
use Antheia\Antheia\Classes\Internals;
/**
 * The class defines an info, that can be used to display some information
 * inside a form. The html elemen has no attached data to be sent to the server
 * @author Cosmin Staicu
 */
class InputInfo extends AbstractInput {
	public function __construct() {
		parent::__construct();
		$this->setLabelExport(self::LABEL_TEXT);
	}
	public function getHtml():string {
		$code = '<span';
		$code .= Internals::getHtmlIdCode($this->getHtmlId(), $this->getTestId());
		$code .= $this->getAttributesAsText();
		$code .= '>'.$this->getValue().'</span>';
		parent::setHtmlCode($code);
		return parent::getHtml();
	}
}
?>