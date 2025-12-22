<?php
namespace Antheia\Antheia\Classes\Icon;
use Antheia\Antheia\Interfaces\HtmlAttribute;
use Antheia\Antheia\Interfaces\HtmlClass;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
/**
 * Class to be extended by all classes defining an .svg or .png icon.
 * @author Cosmin Staicu
 */
abstract class AbstractIcon implements HtmlCode, HtmlId, HtmlAttribute, HtmlClass {
	/**
	 * The class defines a pixel icon (.png)
	 * @var string
	 */
	const PIXEL = 'pixel';
	/**
	 * The class defines a vector icon (.svg)
	 * @var string
	 */
	const VECTOR = 'vector';
	private $icon;
	private $iconType;
	private $htmlId;
	private $classes;
	private $attributes;
	public function __construct(string $icon) {
		$this->setIcon($icon);
		$this->htmlId = '';
		$this->classes = [];
		$this->attributes = [];
	}
	/**
	 * Defines the icon type for the class
	 * @param string $type the icon type for the class, using one of the constants
	 * AbstractIcon::PIXEL or AbstractIcon::VECTOR
	 */
	protected function setIconType(string $type):void {
		$this->iconType = $type;
	}
	/**
	 * Return the icon type for the class as one of the constants
	 * AbstractIcon::PIXEL or AbstractIcon::VECTOR
	 * @return string the icon type for the class as one of the constants
	 * AbstractIcon::PIXEL or AbstractIcon::VECTOR
	 */
	public function getIconType():string {
		return $this->iconType;
	}
	/**
	 * Defines the name of the main image, to be used inside the icon. The name
	 * must have a coresponding .svg or .png file inside the .zip library
	 * (the folder Media/Icons/<libraryType> from the library).
	 * @param string $icon the name of the image from the library file
	 * (no extension required)
	 */
	public function setIcon(string $icon):void {
		$this->icon = $icon;
	}
	/**
	 * Returns the name of the main image used for generating the icon
	 * @return string the name of the main image used for generating the icon
	 * without any extension
	 */
	public function getIcon():string {
		return $this->icon;
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	/**
	 * Returns the html ID for the tag
	 * @return string the html id for the tag or an empty string if no htmlId
	 * is needed
	 */
	protected function getHtmlId():string {
		return $this->htmlId;
	}
	public function addClass(string $class):void {
		$this->classes[] = $class;
	}
	/**
	 * Returns a list with all classes that must be included inside the tag
	 * definition
	 * @return string[] a list with all classes that must be included inside
	 * the tag definition
	 */
	protected function getClasses():array {
		return $this->classes;
	}
	public function addAttribute(string $name, string $value):void {
		$this->attributes[$name] = addslashes($value);
	}
	/**
	 * Returns a list with all attributes that must be included inside the tag
	 * definition
	 * @return string[] a list with all attributes that must be included inside
	 * the tag definition
	 */
	protected function getAttributes():array {
		return $this->attributes;
	}
	/**
	 * Returns the final size of the icon, when rendered
	 * @return integer the final size of the icon, when rendered
	 */
	abstract public function getSize():int;
	/**
	 * Returns the url for the selected image
	 * @return string the url for the selected image
	 */
	abstract public function getUrl():string;
	/**
	 * Checks if an image exists inside the icon archive.
	 * @param string $name the name of the image
	 * @return bool true if the image exists, false if not
	 */
	abstract public static function imageExists(string $name):bool;
}
?>