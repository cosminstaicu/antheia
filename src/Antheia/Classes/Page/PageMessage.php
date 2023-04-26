<?php
namespace Antheia\Antheia\Classes\Page;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Interfaces\HtmlCode;
/**
 * A page with a message in a panel
 * @author Cosmin Staicu
 */
class PageMessage extends PageEmpty {
	private $title;
	private $message;
	private $panel;
	public function __construct() {
		parent::__construct();
		$this->title = null;
		$this->message = null;
		$this->panel = $this->addWireframe()->addRow()->addCell()->addPanel();
	}
	/**
	 * Defines the message shown in the center of the page
	 * @param string $description the message shown in the center of the page.
	 * The message can have HTML tags, as it is unescaped
	 * @param string $title (optional) if defined then the container showing
	 * the message will have this title
	 */
	public function setMessage(string $description, string $title = null):void {
		$this->message = $description;
		$this->title = $title;
	}
	/**
	 * Adds html code to the footer of the message panel
	 * @param HtmlCode $element the HTML element to be added
	 * @see \Antheia\Antheia\Classes\Panel\AbstractPanel::addFooterElement
	 */
	public function addMessageFooter(HtmlCode $element):void {
		$this->panel->addFooterElement($element);
	}
	public function getHtml():string {
		if ($this->message === null) {
			throw new Exception('Message is undefined');
		}
		if ($this->title !== null) {
			$this->panel->setTitle($this->title);
		}
		$this->panel->addText($this->message);
		return parent::getHtml();
	}
}
?>