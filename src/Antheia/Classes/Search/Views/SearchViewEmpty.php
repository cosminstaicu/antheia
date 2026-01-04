<?php
namespace Antheia\Antheia\Classes\Search\Views;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Panel\Panel;
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
