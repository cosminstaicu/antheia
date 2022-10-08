<?php
namespace Cosmin\Antheia\Classes\Input\Raw;
use Cosmin\Antheia\Classes\AbstractClass;
use Cosmin\Antheia\Interfaces\HtmlCode;
use Cosmin\Antheia\Interfaces\HtmlId;
use Cosmin\Antheia\Classes\InlineHelp\AbstractInlineHelp;
use Cosmin\Antheia\Classes\Input\AbstractInput;
use Cosmin\Antheia\Classes\Exception;
/**
 * Class for defining a label html tag, used by any input tag
 * @author Cosmin Staicu
 */
class InputRawLabel extends AbstractClass implements HtmlCode, HtmlId {
	private $input;
	private $exportForAttribute;
	private $htmlId;
	private $inlineHelp;
	public function __construct() {
		$this->input = null;
		$this->setExportAtributFor(true);
		$this->htmlId = '';
		$this->inlineHelp = null;
	}
	/**
	 * Defines the inline help element to be displayed near the label
	 * @param AbstractInlineHelp $inlineHelp the inline help element
	 * to be displayed near the label or NULL if no inline help in required
	 */
	public function setInlineHelp(AbstractInlineHelp $inlineHelp = null):void {
		$this->inlineHelp = $inlineHelp;
	}
	/**
	 * Returns the inline help object that will be displayed next to the label
	 * or null if no inline help is defined
	 * @return null | jsc_inlineHelp_abstract the inline help object 
	 * that will be displayed next to the label or null if no inline help
	 * is required
	 */
	public function getInlineHelp():void {
		return $this->inlineHelp;
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	/**
	 * Defines if the tag should include a "for" attribute, indicating the
	 * id of the input that is linked to the labes
	 * @param boolean $exportAtribut true if a for attribute will be generated,
	 * false if not
	 */
	public function setExportAtributFor(bool $export):void {
		$this->exportForAttribute = $export;
	}
	/**
	 * Defines the input that the label is generated for
	 * @param AbstractInput $input the input that the label is generated for
	 */
	public function setInput(AbstractInput $input):void {
		$this->input = $input;
	}
	public function getHtml():string {
		if ($this->input === null) {
			throw new Exception('Input element is undefined');
		}
		$code = '<label ';
		if ($this->exportForAttribute) {
			$code .= 'for="'.$this->input->getHtmlId().'" ';
		}
		if ($this->htmlId !== '') {
			$code .= ' id="'.$this->htmlId.'" ';
		}
		$code .= '>'.$this->input->getLabelText();
		$code .= '</label>';
		if ($this->inlineHelp != null) {
			$code .= ' '.$this->inlineHelp->getHtml();
		}
		return $code;
	}
}
?>