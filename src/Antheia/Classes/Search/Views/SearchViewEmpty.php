<?php
namespace Cosmin\Antheia\Classes\Search\Views;
use Cosmin\Antheia\Classes\Panel\Panel;
use Cosmin\Antheia\Classes\Exception;
use Cosmin\Antheia\Classes\Icon\IconVector;
use Cosmin\Antheia\Classes\Html;
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
		$icon->setSize(IconVector::SIZE_XL);
		$icon->setIcon(IconVector::ICON_ALERT);
		$code = '<p style="font-weight: bold; text-align: center">';
		$code .= $icon->getHtml().'<br>'.$this->text.'</p>';
		$this->addElement(new Html($code));
		return parent::getHtml();
	}
}
?>