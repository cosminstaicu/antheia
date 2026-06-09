<?php
namespace Antheia\Framework\Panel;
use Antheia\Framework\Wireframe\WireframeInfo;
use Antheia\Framework\Interfaces\HtmlCode;
/**
 * A pannel for displaying name value pairs. This type of panel is best used when showing info about
 * an entity in an app (for example, info about a user: name = John Doe, username = johndoe
 * @author Cosmin Staicu
 */
class PanelInfo extends Panel {
	private $wireframe;
	public function __construct() {
		parent::__construct();
		$this->wireframe = new WireframeInfo();
		$this->addElement($this->wireframe);
	}
	/**
	 * Adds a name value pair to the content of the panel
	 * @param string $name the name of the value
	 * @param string $value the value to be added (can contain HTML code, as text is not escaped)
	 * @param string $id (optional) (default '') the html id of theentire row (in the wireframe)
	 * containing the input
	 * @param string[] $classes (optional) a list of html classes to be added to the row html tag
	 * of the wireframe
	 * @param string $testid (optional) (default '') the value of the row testid attribute or
	 * an empty string if no id is required
	 * @see https://playwright.dev/docs/locators#locate-by-test-id
	 */
	public function addNameValue(
			string $name,
			string $value, 
			string $id = '',
			array $classes = [],
			string $testid = ''):void {
		$this->wireframe->addNameValue($name, $value, $id, $classes, $testid);
	}
	/**
	 * Adds name-value pair to the content of the panel
	 * @param string $name the name of the value to be displayed
	 * @param HtmlCode $element the element to be displayed
	 * @param string $id (optional) (default '') the html id of the entire row (in the wireframe)
	 * containing the input
	 * @param string[] $classes (optional) a list of html classes to be added to the row html tag
	 * of the wireframe
	 * @param string $testid (optional) (default '') the value of the row testid attribute or an empty
	 * string if no id is required
	 * @see https://playwright.dev/docs/locators#locate-by-test-id
	 */
	public function addNameElement(
			string $name,
			HtmlCode $element,
			string $id = '',
			array $classes = [],
			string $testid = ''):void {
		$this->wireframe->addNameElement($name, $element, $id, $classes, $testid);
	}
	/**
	 * Adds a text to be displayed on the full width of the panel
	 * @param string $text the added text (can contain HTML code, as text is not escapes)
	 * @param string $id (optional) (default '') the html id of the entire row (in the wireframe)
	 * containing the input
	 * @param string[] $classes (optional) a list of html classes to be added to the row html tag
	 * of the wireframe
	 * @param string $testid (optional) (default '') the value of the row testid attribute or an empty
	 * string if no id is required
	 * @see https://playwright.dev/docs/locators#locate-by-test-id
	 */
	public function addValue(
			string $text,
			string $id = '',
			array $classes = [],
			string $testid = ''):void {
		$this->wireframe->addValue($text, $id, $classes, $testid);
	}
	/**
	 * Adds a divider (a horizontal line) spanning the entire width of the wireframe
	 * @param string $id (optional) (default '') the id of the row containing the item to be added
	 * @param string[] $classes a list of classes to be added to the row definition
	 * @param string $testid (optional) (default '') the value of the row testid attribute or
	 * an empty string if no id is required
	 * @see https://playwright.dev/docs/locators#locate-by-test-id
	 */
	public function addDivider(string $id = '', array $classes = [], string $testid = ''):void {
		$this->wireframe->addDivider($id, $classes, $testid);
	}
}
?>
