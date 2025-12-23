<?php
namespace Antheia\Antheia\Classes;
/**
 * A class that is used for various operations inside the library
 * @author Cosmin Staicu
 */
class Globals {
	// the LANGUAGE_## is used as a file name for the class that contains
	// the texts for the language
	const LANGUAGE_ENGLISH = '\\Antheia\\Antheia\\Classes\\Language\\English';
	const LANGUAGE_ROMANA = '\\Antheia\\Antheia\\Classes\\Language\\Romana';
	private static $logoUrl = NULL;
	private static $appName = 'Antheia';
	private static $undefinedDate = '00000000';
	private static $undefinedTime = '9999';
	private static $language = self::LANGUAGE_ENGLISH;
	private static $debugMode = false;
	/**
	 * Defines the location of the cache folder for the library
	 * @param string $url the url of the cache folder (as an absolute
	 * location, relative to the root of the web server)
	 * @param string $path the path of the cache folder (an absolute
	 * location on the file system)
	 */
	public static function setCache(string $url, string $path):void {
		Internals::setCache($url, $path);
	}
	/**
	 * Defines if the library runs in debugging mode. If debuggin mode
	 * is enabled then the css and js files in the cache folder are always
	 * generated on each run.
	 * @param boolean $mode (optional) (default true) true if debugging mode
	 * is enabled, false if the debugging mode is disables
	 */
	public static function setDebug(bool $mode = true):void {
		self::$debugMode = $mode;
	}
	/**
	 * Returns if the library runs in debugging mode. If debuggin mode
	 * is enabled then the css and js files in the cache folder are always
	 * generated on each run.
	 * @return boolean true if debugging mode is enabled, false if the
	 * debugging mode is disables
	 */
	public static function getDebug():bool {
		return self::$debugMode;
	}
	/**
	 * Defines the language used by the library
	 * @param string $language the language used by the library as a constant
	 * like Globals::LANGUAGE_####
	 */
	public static function setLanguage(string $language):void {
		self::$language = $language;
	}
	/**
	 * Returns the language used by the library
	 * @return string the language used by the library as a constant like
	 * Globals::LANGUAGE_####
	 */
	public static function getLanguage():string {
		return self::$language;
	}
	/**
	 * Defines the value used for an undefined date
	 * (for example, the value to be inserted into a date input, when the
	 * user clicks the Undefined button)
	 * @param string $undefinedDate the value for the undefined date
	 * (default 00000000)
	 */
	public static function setUndefinedDate(string $undefinedDate):void {
		self::$undefinedDate = $undefinedDate;
	}
	/**
	 * Returns the value used for an undefined date
	 * (for example, the value to be inserted into a date input, when the
	 * user clicks the Undefined button)
	 * @return string the value for the undefined date (default 00000000)
	 */
	public static function getUndefinedDate():string {
		return self::$undefinedDate;
	}
	/**
	 * Defines the value used for an undefined time
	 * (for example, the value to be inserted into a time input, when the
	 * user clicks the Undefined button)
	 * @param string $undefinedTime the value for the undefined time
	 * (default 9999)
	 */
	public static function setUndefinedTime(string $undefinedTime):void {
		self::$undefinedTime = $undefinedTime;
	}
	/**
	 * Returns the value used for an undefined time
	 * (for example, the value to be inserted into a time input, when the
	 * user clicks the Undefined button)
	 * @return string the value for the undefined time (default 9999,
	 * if the value has not been altered by the setUndefinedTime method)
	 */
	public static function getUndefinedTime():string {
		return self::$undefinedTime;
	}
	/**
	 * Defines the name of the current app
	 * @param string $appName the name of the current app
	 */
	public static function setAppName(string $appName):void {
		self::$appName = $appName;
	}
	/**
	 * Returns the name of the current app
	 * @return string the name of the current app
	 */
	public static function getAppName():string {
		return self::$appName;
	}
	/**
	 * Defines the path to the app logo (used as a URL)
	 * @param string $logoUrl the absolute path to the app logo, to be used
	 * as an URL
	 */
	public static function setLogo(string $logoUrl):void {
		self::$logoUrl = $logoUrl;
	}
	/**
	 * Returns the absolute path for the app logo
	 * @return string the absolute path for the app logo
	 */
	public static function getLogo():string {
		if (self::$logoUrl === null) {
			self::setLogo(Internals::getCacheUrl().'logo.svg');
		}
		return self::$logoUrl;
	}
	/**
	 * Removes any tabs and spaces from the edge of each row inside the
	 * provided text and returns the formatted text
	 * @param string $text the text to be formatted
	 * @return string the formatted text
	 */
	public static function trimText(string $text):string {
		$text = '';
		foreach (explode("\n", $text) as $value) {
			$row = trim($value);
			if ($row != '') {
				$text .= $row."\n";
			}
		}
		return $text;
	}
}
?>