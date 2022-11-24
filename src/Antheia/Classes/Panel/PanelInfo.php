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
	 */
	public function addNameValue(string $name, string $value):void {
		$this->wireframe->addNameValue($name, $value);
	}
	/**
	 * Adds name-value pair to the content of the panel
	 * @param string $name the name of the value to be displayed
	 * @param HtmlCode $element the element to be displayed
	 */
	public function addNameElement(string $name, HtmlCode $element):void {
		$this->wireframe->addNameElement($name, $element);
	}
	/**
	 * Adds a text to be displayed on the full width of the panel
	 * @param string $text the added text (can contain HTML code,
	 * as text is not escapes)
	 */
	public function addValue(string $text):void {
		$this->wireframe->addValue($text);
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