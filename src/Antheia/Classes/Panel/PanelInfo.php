<?php
namespace Cosmin\Antheia\Classes\Panel;
use Cosmin\Antheia\Classes\Wireframe\WireframeInfo;
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
	 * @param string $value the value
	 */
	public function addNameValue(string $name, string $value):void {
		$this->wireframe->addNameValue($name, $value);
	}
	/**
	 * Adds a text to be displayed on the full width of the panel
	 * @param string $text the added text
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