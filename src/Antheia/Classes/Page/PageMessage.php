<?php
namespace Antheia\Antheia\Classes\Page;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Wireframe\Wireframe;
use Antheia\Antheia\Classes\Panel\Panel;
/**
 * A page with a message in the center
 * @author Cosmin Staicu
 *
 */
class PageMessage extends PageEmpty {
	private $message;
	public function __construct() {
		parent::__construct();
		$this->message = null;
	}
	/**
	 * Defines the message shown in the center of the page
	 * @param string $mesaj the message shown in the center of the page
	 */
	public function setMessage(string $mesaj):void {
		$this->message = $mesaj;
	}
	public function getHtml():string {
		if ($this->message === null) {
			throw new Exception('Message is undefined');
		}
		$wireframe = new Wireframe();
		$row = $wireframe->addRow();
		$cell = $row->addCell();
		$cell->addWidth('xs', 12);
		$panel = new Panel();
		$panel->addText(
			'<p style="text-align: center; font-size: 25px;">'
			.$this->message.'</p>');
		$cell->addElement($panel);
		$this->addElement($wireframe);
		return parent::getHtml();
	}
}
?>