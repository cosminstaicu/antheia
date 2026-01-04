<?php
namespace Antheia\Antheia\Classes\Input\Raw;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Internals;
use Antheia\Antheia\Classes\InlineHelp\AbstractInlineHelp;
use Antheia\Antheia\Classes\Input\AbstractInput;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
/**
 * Class for defining a label html tag, used by any input tag
 * @author Cosmin Staicu
 */
class InputRawLabel extends AbstractClass implements HtmlCode, HtmlId {
	private $input;
	private $htmlId;
	private $testId;
	private $inlineHelp;
	public function __construct() {
		$this->input = null;
		$this->htmlId = '';
		$this->testId = '';
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
	 * @return null | AbstractInlineHelp the inline help object 
	 * that will be displayed next to the label or null if no inline help
	 * is required
	 */
	public function getInlineHelp():?AbstractInlineHelp {
		return $this->inlineHelp;
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	public function setTestId(string $id):void {
		$this->testId = $id;
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
		$code = '';
		switch ($this->input->getLabelExport()) {
			case $this->input::LABEL_NONE:
				break;
			case $this->input::LABEL_NORMAL:
				$code .= '<label ';
				if ($this->input->getIdForLabel() !== '') {
					$code .= 'for="'.$this->input->getIdForLabel().'" ';
				}
				$code .= Internals::getHtmlIdCode($this->htmlId, $this->testId);
				$code .= '>'.$this->input->getLabelText();
				$code .= '</label>';
				if ($this->inlineHelp != null) {
					$code .= ' '.$this->inlineHelp->getHtml();
				}
				break;
			case $this->input::LABEL_TEXT:
				$code .= '<p class="ant_form-text-label">'
					.$this->input->getLabelText()
					.'</p>';
				if ($this->inlineHelp != null) {
					$code .= ' '.$this->inlineHelp->getHtml();
				}
				break;
			default:
				throw new Exception('Invalid value: '.$this->input->getLabelExport());
		}
		return $code;
	}
}
?>
