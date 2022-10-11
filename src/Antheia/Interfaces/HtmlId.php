<?php
namespace Antheia\Antheia\Interfaces;
/**
 * An html element that can have an id attribute
 * @author Cosmin Staicu
 */
interface HtmlId {
	/**
	 * Defines the id for the HTML element (the id attribute from the tag).
	 * @param string $id the id for the HTML element or an empty string if no
	 * id is required
	 */
	public function setHtmlId(string $id):void;
}
?>