<?php
namespace Cosmin\Antheia\Interfaces;
/**
 * An html element that can have custom attributes
 * @author Cosmin Staicu
 */
interface HtmlAttribute {
	/**
	 * Adds an name=value attribute to the html tag
	 * @param string $name attribute name (for custom attributes you should
	 * use "data-XXXX" template)
	 * @param string $value attribute value
	 */
	public function addAttribute(string $name, string $value):void;
	/**
	 * Add an name=value attribute to the html tag where the name will have
	 * a "data-text-" prefix and the value will be read from the library
	 * translation file
	 * @param string $name the name of the attribute, without the data-text prefix
	 * @param string $value the name of the constant defining the text, as it
	 * is defined in the translation file
	 */
	public function addTextAttribute(string $name, string $value):void;
}
?>