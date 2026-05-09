<?php
namespace Antheia\Framework\InlineHelp;
use Antheia\Framework\AbstractClass;
use Antheia\Framework\Internals;
use Antheia\Framework\Icon\IconVector;
use Antheia\Framework\Interfaces\HtmlCode;
use Antheia\Framework\Interfaces\HtmlId;
/**
 * Class to be extended by all classes defining an inline help feature.
 * @author Cosmin Staicu
 */
abstract class AbstractInlineHelp extends AbstractClass implements HtmlCode, HtmlId {
	private $text;
	private $htmlId;
	private $testId;
	private $icon;
	public function __construct() {
		parent::__construct();
		$this->text = '';
		$this->htmlId = '';
		$this->testId = '';
		$this->icon = new IconVector();
		$this->icon->setIcon('circle-question-mark');
		$this->icon->setSize('24');
	}
	/**
	 * Defines the text shown when the item is clicked
	 * @param string $text the text shown when the item is clicked
	 */
	public function setText(string $text):void {
		$this->text = $text;
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	public function setTestId(string $id):void {
		$this->testId = $id;
	}
	/**
	 * Returns the displayed icon
	 * @return IconVector the displayed icon
	 */
	public function getIcon():IconVector {
		return $this->icon;
	}
	public function getHtml():string {
		$code = '<div class="ant_inlineHelp" onClick="ant_inlineHelp(this)"';
		$code .= Internals::getHtmlIdCode($this->htmlId, $this->testId);
		$code .= '><span>'.$this->text.'</span>';
		$code .= $this->icon->getHtml();
		$code .= '</div>';
		return $code;
	}
}
?>
