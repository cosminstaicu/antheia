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
	/**
	 * Defines an id that will be inserted into the html tag, only if test mode
	 * is enabled, using Globals::setTestMode(). The name of the attribute can
	 * be set up using Globals::setHtmlTestModeAttribute() (defaults to data-testid)
	 * @param string $id the value of the attribute or an empty string if no
	 * id is required
	 * @see https://playwright.dev/docs/locators#locate-by-test-id
	 */
	public function setTestId(string $id):void;
}
?>
