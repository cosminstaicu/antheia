<?php
namespace Antheia\Antheia\Interfaces;
/**
 * An html element that can have classed attached to it
 * @author Cosmin Staicu
 */
interface HtmlClass {
	/**
	 * Adds a class to the html tag definition
	 * @param string $class the class to be added
	 */
	public function addClass(string $class):void;
}
?>