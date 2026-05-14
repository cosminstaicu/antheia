<?php
namespace Antheia\Framework\Search\Views;
use Antheia\Framework\Exception;
use Antheia\Framework\Html;
use Antheia\Framework\Icon\IconVector;
use Antheia\Framework\Panel\Panel;
/**
 * The HTML code that is displayed when no items are available, as a search result
 * @author Cosmin Staicu
 */
class SearchViewEmpty extends Panel {
	private $text;
	public function __construct() {
		parent::__construct();
		$this->text = null;
	}
	/**
	 * Defines the displayed text (something like -no results found-)
	 * @param string $text textul the displayed text
	 */
	public function setText(string $text):void {
		$this->text = $text;
	}
	public function getHtml():string {
		if ($this->text == null) {
			throw new Exception('Text is not defined');
		}
		$icon = new IconVector();
		$icon->setSize(48);
		$icon->setIcon('triangle-alert');
		$code = '<p style="font-weight: bold; text-align: center">';
		$code .= $icon->getHtml().'<br>'.$this->text.'</p>';
		$this->addElement(new Html($code));
		return parent::getHtml();
	}
}
?>
