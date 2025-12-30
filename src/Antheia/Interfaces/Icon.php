<?php
namespace Antheia\Antheia\Interfaces;
/**
 * Defines the methods used in classes defining vector based icons, like
 * Material Icons.
 * @author Cosmin Staicu
 */
interface Icon extends HtmlCode {
	/**
	 * Defines the size of the icon
	 * @param integer $size the size of the icon using a constant
	 * like IconVector::SIZE_##
	 */
	public function setSize(int $size):void;
	/**
	 * Defines the icon to be displayed
	 * @param string $name the icon bo be displayed
	 * (a constant lik IconVector::ICON_##)
	 */
	public function setIcon(string $name):void;
	/**
	 * Returns the name of the element, like it is defined inside the icon library
	 * @return string the name of the element
	 */
	public function getIconName():string;
}
?>