<?php
namespace Antheia\Antheia\Classes\Panel;
use Antheia\Antheia\Classes\Wireframe\WireframeInfo;
use Antheia\Antheia\Interfaces\HtmlCode;
/**
 * A pannel for displaying name value pairs. This type of panel is best used when
 * showing info about an entity in an app (for example, info about a user:
 * name = John Doe, username = johndoe
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
	 * @param string $value the value to be added (can contain HTML code,
	 * as text is not escaped)
	 * @param string $id (optional) (default '') the html id of the
	 * entire row (in the wireframe) containing the input
	 * @param string[] $classes (optional) a list of html classes to be added to the
	 * row html tag of the wireframe
	 */
	public function addNameValue(string $name, string $value, 
			string $id = '', array $classes = []):void {
		$this->wireframe->addNameValue($name, $value, $id, $classes);
	}
	/**
	 * Adds name-value pair to the content of the panel
	 * @param string $name the name of the value to be displayed
	 * @param HtmlCode $element the element to be displayed
	 * @param string $id (optional) (default '') the html id of the
	 * entire row (in the wireframe) containing the input
	 * @param string[] $classes (optional) a list of html classes to be added to the
	 * row html tag of the wireframe
	 */
	public function addNameElement(string $name, HtmlCode $element,
			string $id = '', array $classes = []):void {
		$this->wireframe->addNameElement($name, $element, $id, $classes);
	}
	/**
	 * Adds a text to be displayed on the full width of the panel
	 * @param string $text the added text (can contain HTML code,
	 * as text is not escapes)
	 * @param string $id (optional) (default '') the html id of the
	 * entire row (in the wireframe) containing the input
	 * @param string[] $classes (optional) a list of html classes to be added to the
	 * row html tag of the wireframe
	 */
	public function addValue(string $text,
			string $id = '', array $classes = []):void {
		$this->wireframe->addValue($text, $id, $classes);
	}
	/**
	 * Adds a divider (a horizontal line) spanning the entire width of the
	 * wireframe
	 */
	public function addDivider():void {
		$this->wireframe->addDivider();
	}
}
?>