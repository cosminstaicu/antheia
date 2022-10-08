<?php
namespace Cosmin\Antheia\Classes;
/**
 * This class is only used by the library and does not need to be called
 * by the user
 * @author Cosmin Staicu
 */
class Internals {
	private static $rootPath = '';
	private static $version = '';
	/**
	 * Defines the version of the library. The version is used for naming
	 * the files in the cache folder, to force the browser to reload them
	 * when the library is updated
	 * @param string $version the version of the library
	 */
	public static function setVersion(string $version):void {
		self::$version = $version;
	}
	/**
	 * Returns the version of the library. The version is used for naming
	 * the files in the cache folder, to force the browser to reload them
	 * when the library is updated
	 * @return string the version of the library
	 */
	public static function getVersion():string {
		return self::$version;
	}
	/**
	 * Defines the path to the library root folder (called Antheia)
	 * @param string $path the path to the library root folder, without
	 * a path separator at the end
	 */
	public static function setRootPath(string $path):void {
		self::$rootPath = $path;
	}
	/**
	 * Returns the path to the library root folder (called Antheia)
	 * @return string the absolute path to the library root folder, without
	 * a path separator at the end
	 */
	public static function getRootPath():string {
		return self::$rootPath;
	}
	/**
	 * Returns the absolute path to the cache folder of the library
	 * (Antheia/Cache/). It is a string used by the file manager, not
	 * an URL.
	 * @return string the absolute path to the cache folder of the app, ending
	 * with the file separator
	 */
	public static function getCachePath():string {
		return self::getRootPath().DIRECTORY_SEPARATOR.'Cache'.DIRECTORY_SEPARATOR;
	}
	/**
	 * Returns the url of the cache folder for the app
	 * @return string the url of the cache folder of the app, ending with the
	 * file separator
	 */
	public static function getCacheUrl():string {
		return JIGSAW_FRAMEWORK_URL.'/cache/';
	}
}
?>