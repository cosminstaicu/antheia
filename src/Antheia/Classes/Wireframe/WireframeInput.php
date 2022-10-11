<?php
namespace Cosmin\Antheia\Classes\Wireframe;
use Cosmin\Antheia\Classes\Html;
use Cosmin\Antheia\Classes\Exception;
use Cosmin\Antheia\Interfaces\HtmlCode;
use Cosmin\Antheia\Classes\Input\AbstractInput;
/**
 * A custom wireframe for forms. Contains 2 columns, one for the label of
 * the input and the other for the input. When the viewport width is too small,
 * the label will be stacked on top of the input.
 * Usually this structure is not directly called by the user.
 * The PanelInput class should be used (that is a panel with this
 * type of structure already in content)
 * @author Cosmin Staicu
 */
class WireframeInput extends Wireframe {
	const REGULAR_ITEM = 1;
	const COLUMN_LEFT = 2;
	const COLUMN_RIGHT = 3;
	const COLUMN_BOTH = 4;
	private $items;
	private $labelWidth;
	public function __construct() {
		parent::__construct();
		$this->setType(self::TYPE_FLUID);
		$this->labelWidth = 4;
		$this->items = [];
	}
	/**
	 * Defines the width of the label column. The width of the value column
	 * is computed by substracting the length of the label column from 12.
	 * @param integer $width the width of the column, between 
	 * 1 and 11
	 */
	public function setLabelWidth(int $width):void {
		if ( ($width < 1) || ($width > 11) ) {
			throw new Exception('Illegal width (must be between 1 and 11');
		}
		$this->labelWidth = $width;
	}
	/**
	 * Adds an input to the wireframe
	 * @param AbstractInput $input the input to be added
	 * @param string $id (optional) (default '') the html id of the
	 * row containing the input and the label
	 * @param string[] $classes (optional) a list of classes to be added to the row
	 * definition (the rows contains the label of the input and the input)
	 * @param int $position (optional) the column where the item should be added,
	 * as a constant like WireframeInput::COLUMN_##. If it not defined
	 * then the input will have the label on the left column and the input
	 * control in the right column
	 * 
	 */
	public function addInput(
			AbstractInput $input, 
			string $id = '', 
			array $classes = [],
			int $position = self::REGULAR_ITEM):void {
		$this->items[] = [
				'type' => $position,
				'input' => $input, 
				'id' => $id,
				'classes' => $classes
		];
	}
	/**
	 * Adds a html item to the wireframe, but in only one column, the left
	 * of the right one
	 * @param HtmlCode $item the item to be addes
	 * @param integer $position the column where the item should be added,
	 * as a constant like WireframeInput::COLUMN_##
	 * @param string $id (optional) (default '') the id of the row containing
	 * the item to be added
	 * @param string[] $classes a list of classes to be added to the row definition
	 */
	public function addHtml(
			HtmlCode $item, 
			int $position, 
			string $id = '',
			array $classes = []):void {
		$this->items[] = [
				'type' => $position,
				'input' => $item,
				'id' => $id,
				'classes' => $classes
		];
	}
	/**
	 * Adds a divider (a horizontal line) spanning the entire width of the
	 * wireframe
	 */
	public function addDivider():void {
		$this->addHtml(new Html('<hr>'), self::COLUMN_BOTH);
	}
	public function getHtml():string {
		$labelWidth = $this->labelWidth;
		$valuesWidth = 12 - $labelWidth;
		foreach ($this->items as $inputInfo) {
			$input = $inputInfo['input'];
			$id = $inputInfo['id'];
			switch ($inputInfo['type']) {
				case self::COLUMN_RIGHT:
					$row = $this->addRow();
					if ($id !== '') {
						$row->setHtmlId($id);
					}
					$cell = $row->addCell();
					$cell->addWidth('sm', $labelWidth);
					$cell = $row->addCell();
					$cell->addWidth('sm', $valuesWidth);
					$cell->addElement($input);
					break;
				case self::COLUMN_LEFT:
					$row = $this->addRow();
					if ($id !== '') {
						$row->setHtmlId($id);
					}
					$cell = $row->addCell();
					$cell->addWidth('sm', $labelWidth);
					$cell->addElement($input);
					$cell = $row->addCell();
					$cell->addWidth('sm', $valuesWidth);
					break;
				case self::COLUMN_BOTH:
					$row = $this->addRow();
					if ($id !== '') {
						$row->setHtmlId($id);
					}
					$cell = $row->addCell();
					$cell->addWidth('xs', 12);
					
					$cell->addElement($input);
					break;
				case self::REGULAR_ITEM:
					$row = $this->addRow();
					if ($id !== '') {
						$row->setHtmlId($id);
					}
					$cell = $row->addCell();
					$cell->addWidth('sm', $labelWidth);
					$code = new Html(
							'<div class="ant_form-label-container">');
					if ($input->getLabelExport()) {
						$code->addElement($input->getLabel());
					}
					$code->addRawCode('</div>');	
					$input->setLabelExport(false);
					$cell->addElement($code);
					$cell = $row->addCell();
					$cell->addWidth('sm', $valuesWidth);
					$cell->addElement($input);
					break;
				default:
					throw new Exception($inputInfo['type']);
			}
			foreach ($inputInfo['classes'] as $class) {
				$row->addClass($class);
			}
		}
		return parent::getHtml();
	}
}
?>