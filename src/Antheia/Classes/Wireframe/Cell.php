<?php
namespace Antheia\Antheia\Classes\Wireframe;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
use Antheia\Antheia\Classes\Panel\Panel;
use Antheia\Antheia\Classes\Panel\PanelInfo;
use Antheia\Antheia\Classes\Panel\PanelInput;
use Antheia\Antheia\Classes\Panel\PanelFileBrowser;
/**
 * A cell in one of the rows from a wireframe. The cells can be set up to
 * have different widths, according to the viewport width (responsive feature).
 * The cell has no border or visible background, it is only used as a container
 * for other visible elements.
 * @author Cosmin Staicu
 */
class Cell extends AbstractClass implements HtmlCode, HtmlId {
	private $elements;
	private $htmlId;
	private $widthIsDefined;
	private $classes;
	private $horizontalPadding;
	private $verticalPadding;
	const ALIGN_LEFT = 1;
	const ALIGN_CENTER = 2;
	const ALIGN_RIGHT = 3;
	public function __construct() {
		parent::__construct();
		$this->elements = [];
		$this->htmlId = '';
		$this->classes = [];
		$this->widthIsDefined = false;
		$this->horizontalPadding = true;
		$this->verticalPadding = true;
	}
	/**
	 * Defines if there will be a horizontal padding for the cell. If the
	 * method is not called then the default value is TRUE.
	 * @param boolean $status true for padding the cell, false for no padding
	 */
	public function setHorizontalPadding(bool $status):void {
		$this->horizontalPadding = $status;
	}
	/**
	 * Defines if there will be a vertical padding for the cell. If the
	 * method is not called then the default value is TRUE.
	 * @param boolean $status true for padding the cell, false for no padding
	 */
	public function setVerticalPadding(bool $status):void {
		$this->verticalPadding = $status;
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	/**
	 * Adds a width for a type of screen. The width will be used for the
	 * defined width and all larger screens, with higher widths, if no
	 * values are defined upstream.
	 * @param string $screen one of the values: xs (extra small), sm (small),
	 * md (medium), lg (large)
	 * @param integer $span the number of columns the cell will span
	 * (from 1 to 12)
	 */
	public function addWidth (string $screen, int $span):void {
		if (!in_array($screen, ['xs','sm','md','lg'])) {
			throw new Exception('Illegal screen width: '.$screen);
		}
		if (($span < 1) || ($span > 12)) {
			throw new Exception('Illegal column span: '.$span);
		}
		$this->widthIsDefined = true;
		$this->addClass('ant_wireframe-col-'.$screen.'-'.$span);
	}
	/**
	 * Adds a class to the cell tag definition
	 * @param string $class the name of the class to be addes
	 */
	public function addClass(string $class):void {
		$this->classes[] = $class;
	}
	/**
	 * Adds content to the cell
	 * @param HtmlCode $content the content to be added inside the cell
	 */
	public function addElement(HtmlCode $content):void {
		$this->elements[] = $content;
	}
	/**
	 * Adds a regular panel to the cell content and returns it
	 * @return Panel the added panel
	 */
	public function addPanel():Panel {
		$panel = new Panel();
		$this->addElement($panel);
		return $panel;
	}
	/**
	 * Adds an info panel to the cell content and returns it
	 * @return PanelInfo the added panel
	 */
	public function addInfoPanel():PanelInfo {
		$panel = new PanelInfo();
		$this->addElement($panel);
		return $panel;
	}
	/**
	 * Adds an edit panel to the cell content and returns it
	 * @return PanelInput the added panel
	 */
	public function addInputPanel():PanelInput {
		$panel = new PanelInput();
		$this->addElement($panel);
		return $panel;
	}
	/**
	 * Adds a file browser panel to the cell content and returns it
	 * @return PanelFileBrowser the added panel
	 */
	public function addFileBrowserPanel():PanelFileBrowser {
		$panel = new PanelFileBrowser();
		$this->addElement($panel);
		return $panel;
	}
	/**
	 * Defines the alignment for the content of the cell
	 * @param integer $align the align, as a constant like
	 * Cell:ALIGN_###
	 */
	public function setAlign(string $align):void{
		switch ($align) {
			case Cell::ALIGN_LEFT:
				$this->addClass('ant-left');
				break;
			case Cell::ALIGN_CENTER:
				$this->addClass('ant-center');
				break;
			case Cell::ALIGN_RIGHT:
				$this->addClass('ant-right');
				break;
			default:
				throw new Exception();
		}
	}
	public function getHtml():string {
		if (!$this->widthIsDefined) {
			$this->addWidth('xs', 12);
		}
		if ($this->horizontalPadding) {
			$this->addClass('ant-h-padding');
		}
		if ($this->verticalPadding) {
			$this->addClass('ant_v-padding');
		}
		$code = '<div class="'.implode(' ', array_unique($this->classes)).'"';
		if ($this->htmlId != '') {
			$code .= ' id="'.$this->htmlId.'"';
		}
		$code .= '>';
		/** @var HtmlCode $element */
		foreach ($this->elements as $element) {
			$code .= $element->getHtml();
		}
		$code .= '</div>';
		return $code;
	}
}
?>