<?php
namespace Antheia\Antheia\Interfaces;
/**
 * A class containing HTML code that can be added to a page or to another
 * html element
 * @author Cosmin Staicu
 */
interface HtmlCode {
	/**
	 * Returns the code to be inserted into the HTML page output.
	 * @return string the html code to be inserted into the html page output
	 */
	public function getHtml():string;
}
?>
