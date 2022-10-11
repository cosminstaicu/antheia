<?php
namespace Antheia\Antheia\Classes;
/**
 * Main extending class for the library
 * @author Cosmin Staicu
 */
abstract class AbstractClass {
	private static $htmlId = NULL;
	public function __construct() {
		
	}
	/**
	 * The method generates an unique value, unique per session
	 * @return string an unique value for the entire session
	 */
	public static function uniqid():string {
		if (self::$htmlId === null) {
			self::$htmlId = uniqid();
		}
		return self::$htmlId;
	}
}
?>