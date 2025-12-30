<?php
namespace Antheia\Antheia\Interfaces;
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
}
?>