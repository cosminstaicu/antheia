<?php
namespace Antheia\Antheia\Classes\Wireframe;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Interfaces\HtmlCode;
/**
 * A wireframe with two columns for displaying name=value pairs. One column
 * contains a label, the other contains the value for that label.
 * The wireframe is responsive. On smaller screens only one column is displayed
 * with each label on top of its value.
 * Usually this structure is not directly called by the user.
 * The PanelInfo class should be used (that is a panel with this
 * type of structure already in content)
 * @author Cosmin Staicu
 */
class WireframeInfo extends Wireframe {
	public function __construct() {
		parent::__construct();
		$this->setType(self::TYPE_FLUID);
	}
	/**
	 * Adds a name-value pair to be displayed inside the wireframe
	 * @param string $label the label of the value displayed
	 * @param string $value the value being displayed
	 */
	public function addNameValue(string $label, string $value):void {
		$this->addNameElement($label, new Html($value));	
	}
	/**
	 * Adds name-value pair to be displayed inside the wireframe
	 * @param string $label the label of the value to be displayed
	 * @param HtmlCode $element the element to be displayed
	 */
	public function addNameElement(string $label, HtmlCode $element):void {
		$row = $this->addRow();
		$cell = $row->addCell();
		$cell->addWidth('sm', 4);
		$cell->setVerticalPadding(false);
		$cell->addElement(new Html(
				'<div class="ant_info-name">'.$label.'</div>'
				));
		$cell = $row->addCell();
		$cell->addWidth('sm', 8);
		$cell->setVerticalPadding(false);
		$cell->addElement(new Html('<div class="ant_info-value">'));
		$cell->addElement($element);
		$cell->addElement(new Html('</div>'));
	}
	/**
	 * Adds just a value to the wireframe, that will span over 2 columns (a value
	 * without a label, spanning over the label column)
	 * @param string $text the text to be added
	 */
	public function addValue(string $text):void {
		$row = $this->addRow();
		$cell = $row->addCell();
		$cell->addWidth('sm', 12);
		$cell->setVerticalPadding(false);
		$cell->addElement(new Html(
			'<div class="ant_info-only-value">'.$text.'</div>'
		));
	}
	/**
	 * Adds a divider (a horizontal line) spanning the entire width of the
	 * wireframe
	 */
	public function addDivider():void {
		$row = $this->addRow();
		$cell = $row->addCell();
		$cell->addWidth('sm', 12);
		$cell->setVerticalPadding(false);
		$cell->addElement(new Html('<hr>'));
	}
}
?>