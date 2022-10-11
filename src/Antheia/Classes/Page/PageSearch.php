<?php
namespace Antheia\Antheia\Classes\Page;
use Antheia\Antheia\Classes\Form;
use Antheia\Antheia\Classes\Panel\PanelInput;
use Antheia\Antheia\Classes\Wireframe\Wireframe;
use Antheia\Antheia\Classes\Input\InputSubmit;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Input\AbstractInput;

/**
 * The template of a page for starting a search. The user can add inputs to the
 * page that will be sent to the redirect target.
 * @author Cosmin Staicu
 *
 */
class PageSearch extends PageEmpty {
	private $form;
	private $panel;
	private $button;
	public function __construct() {
		parent::__construct();
		$this->form = new Form();
		$this->form->setMethod($this->form::METHOD_POST);
		$this->panel = new PanelInput();
		$wireframe = new Wireframe();
		$wireframe->setType(Wireframe::TYPE_FIXED);
		$this->button = new InputSubmit();
		$this->button->setText(Texts::get('SEARCH'));
		$row = $wireframe->addRow();
		$cell = $row->addCell();
		$cell->addWidth('xs', 12);
		$cell->addElement($this->panel);
		$this->form->addElement($wireframe);
		parent::addElement($this->form);
		$this->setOnSubmit('ant_loading_start(true)');
	}
	/**
	 * Adds a search filter (a for input) to the page
	 * @param AbstractInput $input the added input
	 * @param string $id (optional) if defined then the row (from the wireframe)
	 * containing the filter will have this id
	 * @param string[] $classes (optional) a list of html classes to be added to the
	 * row html tag of the wireframe
	 */
	public function addInput(
			AbstractInput $input,
			string $id = '',
			array $classes = []):void {
		$this->panel->addInput($input, $id, $classes);
	}
	/**
	 * Defines the location where the search parameter sill be sent
	 * (the action attribute for the form)
	 * @param string $url the url for the html form
	 */
	public function setUrl(string $url):void {
		$this->form->setAction($url);
	}
	/**
	 * Defines the text to be displayed on the search button 
	 * @param string $text the text to be displayed on the search button
	 */
	public function setButtonText(string $text):void {
		$this->button->setText($text);
	}
	/**
	 * Defines the javascript code to be executed just before the form
	 * is submitted. The code will be exported into the onSubmit attribute
	 * of the form tag
	 * @param string $code the javascript code
	 */
	public function setOnSubmit(string $code):void {
		$this->form->setOnSubmit($code);
	}
	public function getHtml():string {
		$this->panel->addInput($this->button);
		return parent::getHtml();
	}
}
?>