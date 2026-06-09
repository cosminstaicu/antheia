<?php
namespace Antheia\Framework\Panel;
use Antheia\Framework\Input\AbstractInput;
use Antheia\Framework\Interfaces\HtmlCode;
use Antheia\Framework\Wireframe\WireframeInput;
/**
 * A panel that contains form inputs, vertically stacked. It is best used
 * when editing data, since all the positioning is done automatically
 * @author Cosmin Staicu
 */
class PanelInput extends Panel {
	private $wireframe;
	public function __construct() {
		parent::__construct();
		$this->wireframe = new WireframeInput();
		$this->addElement($this->wireframe);
	}
	/**
	 * Inserts the row that toggles the advanced options. If the method is not
	 * called then the row will be added at the end of the wireframe
	 * @param string $id (optional) (default '') the id of the button
	 * @param string[] $classes a list of classes to be added to the button
	 * @param string $testid (optional) (default '') the value of the testid attribute or an empty
	 * string if no id is required
	 * @see https://playwright.dev/docs/locators#locate-by-test-id
	 */
	public function addMoreOptionsToggle(string $id = '', array $classes = [], string $testid = ''):void {
		$this->wireframe->addMoreOptionsToggle($id, $classes, $testid);
	}
	/**
	 * Adds a form input to the panel
	 * @param AbstractInput $input the input to be added
	 * @param string $id (optional) (default '') the html id of the
	 * entire row (in the wireframe) containing the input
	 * @param string[] $classes (optional) a list of html classes to be added to the
	 * row html tag of the wireframe
	 * @param int $position (optional) the column where the item should be added,
	 * as a constant like WireframeInput::COLUMN_##. If it not defined
	 * then the input will have the label on the left column and the input
	 * control in the right column
	 * @param string $testid (optional) (default '') the value of the row testid attribute or an empty
	 * string if no id is required
	 * @see https://playwright.dev/docs/locators#locate-by-test-id
	 */
	public function addInput(
			AbstractInput $input,
			string $id = '',
			array $classes = [],
			int $position = WireframeInput::REGULAR_ITEM,
			string $testid = ''):void {
		$this->wireframe->addInput($input, $id, $classes, $position, $testid);
	}
	/**
	 * Adds a html item to a column (the right or the left one)
	 * @param HtmlCode $item the added item
	 * @param integer $position a constant like WireframeInput::COLUMN_##
	 * @param string id (optional) (default '') the id of the row (from the
	 * wireframe) containing the item
	 * @param string $testid (optional) (default '') the value of the row testid attribute or an empty
	 * string if no id is required
	 * @see https://playwright.dev/docs/locators#locate-by-test-id
	 */
	public function addHtml(HtmlCode $item, int $position, string $id = '', string $testid = ''):void {
		$this->wireframe->addHtml($item, $position, $id);
	}
	/**
	 * Adds a divider (a horizontal line) spanning the entire width of the wireframe
	 * @param string $id (optional) (default '') the id of the row containing the item to be added
	 * @param string[] $classes a list of classes to be added to the row definition
	 * @param string $testid (optional) (default '') the value of the testid attribute or an empty
	 * string if no id is required
	 * @see https://playwright.dev/docs/locators#locate-by-test-id
	 */
	public function addDivider(string $id = '', array $classes = [], string $testid = ''):void {
		$this->wireframe->addDivider($id, $classes, $testid);
	}
}
?>
