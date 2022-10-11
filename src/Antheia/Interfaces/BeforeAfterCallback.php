<?php
namespace Antheia\Antheia\Interfaces;
/**
 * Interface for setting up a before and after callback function for a input
 * html element
 * @author Cosmin Staicu
 */
interface BeforeAfterCallback {
	/**
	 * Defines a javascript function that will be called before displaying
	 * the graphics for selecting a value for the input
	 * @param string $functionName the name (just the name) of the javascript 
	 * function that will be called, with the "this" parameter. If an empty string
	 * is provided then no function will be called.
	 */
	public function setBeforeCallback(string $functionName):void;
	/**
	 * Defines a javascript function that will be called after a value for the input
	 * has been selected
	 * @param string $functionName the name (just the name) of the javascript
	 * function that will be called, with the "this" parameter If an empty string
	 * is provided then no function will be called.
	 */
	public function setAfterCallback(string $functionName):void;
}
?>