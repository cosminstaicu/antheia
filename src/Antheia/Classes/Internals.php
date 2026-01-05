<?php
namespace Antheia\Antheia\Classes;
/**
 * This class is only used by the library and does not need to be called
 * by the user
 * @author Cosmin Staicu
 */
class Internals {
	private static $cachePath = NULL;
	private static $cacheUrl = NULL;
	private static $rootFolder = NULL;
	private static $fileContentCache = [];
	/**
	 * Returns the html code to be inserted into a html tag, for the id and testId
	 * valued
	 * @param string $id the id of the element or an empty string if no id
	 * is required
	 * @param string [$testId=''] the test id of the item (that will be returned
	 * only if test mode is enabled, using Globals::setTestMode()
	 * @return string the string with all required attributes, having a leading
	 * white space. If no attributes are needed, then an empty string is returned
	 * @see Globals::setTestMode()
	 */
	public static function getHtmlIdCode(string $id, string $testId = ''):string {
		$code = '';
		if ($id !== '') {
			$code .= ' id="'.$id.'"';
		}
		if (Globals::getTestMode()) {
			if (Globals::getHtmlTestModeAttribute() === '') {
				throw new Exception('Missing test mode attribute');
			}
			if ($testId !== '') {
				$code .= ' '.Globals::getHtmlTestModeAttribute().'="'.$testId.'"';
			}
		}
		return $code;
	}
	/**
	 * Checks if the content of a file (inside the cache folder) has been read
	 * and saved in RAM. If not, then the file will be loaded.
	 * Then the file content is returned. The method
	 * should only be used for text-based files (no binary files)
	 * @param string $fileName the filename (without any path, as only
	 * files inside the internal cache folder are checked)
	 * @return ?string the content of the file or null if the file does not
	 * exists (in cache or at $filePath)
	 */
	public static function getFileContentFromCache(string $fileName):?string {
		$filePath = self::getCachePath($fileName);
		if (!isset(self::$fileContentCache[$fileName])) {
			self::$fileContentCache[$fileName] = NULL;
		}
		if (self::$fileContentCache[$fileName] === NULL) {
			if (!file_exists($filePath)) {
				return NULL;
			}
			self::$fileContentCache[$fileName] = file_get_contents($filePath);
			if (self::$fileContentCache[$fileName] === false) {
				self::$fileContentCache[$fileName] = NULL;
				throw new Exception('Unable to read file '.$filePath);
			}
		}
		return self::$fileContentCache[$fileName];
	}
	/**
	 * Defines the location of the cache folder for the library
	 * @param string $url the url of the cache folder (probably an absolute
	 * location, relative to the root of the web server)
	 * @param string $path the path of the cache folder (probably an absolute
	 * location on the file system)
	 */
	public static function setCache(string $url, string $path):void {
		$version = NULL;
		$composerLockPath = dirname(__DIR__, 6).'/composer.lock';
		if (is_file($composerLockPath)) {
			// the library has been installed using composer
			// the library version will be read from the composer.lock file
			$packages = json_decode(file_get_contents($composerLockPath), true);
			if (isset($packages['packages'])) {
				foreach ($packages['packages'] as $package) {
					if ($package['name'] === 'antheia/antheia') {
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
