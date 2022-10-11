<?php
namespace Cosmin\Antheia\Classes;
/**
 * This class is only used by the library and does not need to be called
 * by the user
 * @author Cosmin Staicu
 */
class Internals {
	private static $cachePath = NULL;
	private static $cacheUrl = NULL;
	private static $rootFolder = NULL;
	/**
	 * Defines the location of the cache folder for the library
	 * @param string $url the url of the cache folder (probably an absolute
	 * location, relative to the root of the web server)
	 * @param string $path the path of the cache folder (probably an absolute
	 * location on the file system)
	 */
	public static function setCache(string $url, string $path):void {
		$version = NULL;
		$composerLockPath = dirname(__DIR__, 4).'/composer.lock';
		if (is_file($composerLockPath)) {
			// the library has been installed using composer
			// the library version will be read from the composer.lock file
			$packages = json_decode(file_get_contents($composerLockPath), true);
			if (isset($packages['packages'])) {
				foreach ($packages['packages'] as $package) {
					if ($package['name'] === 'cosmin/antheia') {
						$version = $package['version'];
					}
				}
			}
		}
		if ($version === NULL) {
			// it the version is not available, it will fallback to 0.0.0
			$version = '0.0.0';
		}
		$versionFolder = str_replace('.', '-', $version);
		self::$cacheUrl = $url;
		if (substr(self::$cacheUrl, -1) !== '/') {
			self::$cacheUrl .= '/';
		}
		self::$cacheUrl .= $versionFolder.'/';
		self::$cachePath = $path;
		if (substr(self::$cachePath, -1) !== DIRECTORY_SEPARATOR) {
			self::$cachePath .= DIRECTORY_SEPARATOR;
		}
		self::$cachePath .= $versionFolder.DIRECTORY_SEPARATOR;
		if (!is_dir(self::$cachePath)) {
			mkdir(self::$cachePath, 0755);
		}
	}
	/**
	 * Returns the absolute path to the cache folder of the library
	 * @param string $fileName (optional) if defined then the returned path
	 * points to the file defined here
	 * It is a string used by the file manager, not an URL.
	 * @return string the absolute path to the cache folder of the app, ending
	 * with the file separator (if no particular file was defined using the
	 * $fileName parameter)
	 * @throws Exception if the cache path is not defined
	 */
	public static function getCachePath(string $fileName = ''):string {
		if (self::$cachePath === NULL) {
			throw new Exception(
				'Cache path not defined - set it up with the Globals::setCache()'
			);
		}
		return self::$cachePath.$fileName;
	}
	/**
	 * Returns the url of the cache folder for the app
	 * @return string the url of the cache folder of the app, ending with the
	 * folder separator
	 * @throws Exception if the cache path is not defined
	 */
	public static function getCacheUrl():string {
		if (self::$cacheUrl === NULL) {
			throw new Exception(
				'Cache path not defined - set it up with the Globals::setCache()'
			);
		}
		return self::$cacheUrl;
	}
	/**
	 * Returns the absolute path for a folder inside the library
	 * @param array $folders (optional) a list with additional folders that will
	 * be added to the root of the library
	 * @return string the absolute path for the defined folders, with the
	 * directory separator as a trailing character (if no folders
	 * were provided then the path for the root folder will be returned)
	 */
	public static function getFolder(array $folders = []):string {
		if (self::$rootFolder === NULL) {
			self::$rootFolder = dirname(__DIR__, 1).DIRECTORY_SEPARATOR;
		}
		$computedPath = self::$rootFolder;
		foreach ($folders as $folder) {
			$computedPath .= $folder.DIRECTORY_SEPARATOR;
		}
		return $computedPath;
	}
}
?>