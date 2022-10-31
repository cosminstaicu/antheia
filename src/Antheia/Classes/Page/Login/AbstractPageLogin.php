<?php
namespace Antheia\Antheia\Classes\Page\Login;
use Antheia\Antheia\Classes\Globals;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Page\AbstractPage;
use Antheia\Antheia\Classes\Panel\Panel;
use Antheia\Antheia\Classes\Wireframe\Cell;
use Antheia\Antheia\Classes\Wireframe\Wireframe;
/**
 * Class to be extende by all pages used by the authentication process
 * @author Cosmin Staicu
 */
abstract class AbstractPageLogin extends AbstractPage {
	private $rightWireframe;
	public function __construct() {
		parent::__construct();
		$this->addBodyClass('ant_login');
		$this->rightWireframe = new Cell();
		$this->rightWireframe->addWidth('xs', 12);
		$this->rightWireframe->addWidth('sm', 7);
	}
	/**
	 * Returns the object with the page content
	 * @return Cell the page content
	 */
	protected function getContent():Cell {
		return $this->rightWireframe;
	}
	public function getHtml():string {
		$this->addHtmlClass('ant_other_full-height');
		$mainPanel = new Panel();
		$mainPanel->setHtmlId('ant_panel-centered');
		$wireframe = new Wireframe();
		$row = $wireframe->addRow();
		$leftWireframe = $row->addCell();
		$leftWireframe->addWidth('xs', 12);
		$leftWireframe->addWidth('sm', 5);
		$leftWireframe->addElement(new Html(
			'<p style="text-align: center"><img src="'.Globals::getLogo()
			.'" width="200" height="200" alt="Logo"></p>'));
		$row->addCell($this->rightWireframe);
		$mainPanel->addElement($wireframe);
		$this->addElement($mainPanel);
		return parent::getHtml();
	}
}
?>