<?php
namespace Cosmin\Antheia\Classes\Icon;
use Cosmin\Antheia\Classes\Exception;
use Cosmin\Antheia\Classes\Internals;
/**
 * Class to be extended by all classes defining an image icon.
 * The icon will be first checked in the cache folder and if it is not found there
 * then it will be generated and saved into the cache folder.
 * @author Cosmin Staicu
 */
abstract class AbstractPixelIcon {
	private static $imageFileList = [16 => NULL, 32 => NULL];
	private $icon;
	/**
	 * The class constructor with the name of the main image inside the icon
	 * @param string $icon the name of the image to be used inside the ocon
	 * @see AbstractPixelIcon::setIcon()
	 */
	public function __construct(string $icon) {
		$this->setIcon($icon);
	}
	/**
	 * Defines the name of the main image, to be used inside the icon. The name
	 * must have a coresponding .png file inside the .zip library (the folder
	 * Media/Icons from the library).
	 * @param string $icon the name of the image from the library file
	 * (no .png extension required)
	 */
	public function setIcon(string $icon):void {
		$this->icon = $icon;
	}
	/**
	 * Returns the name of the main image used for generating the icon
	 * @return string the name of the main image used for generating the icon
	 * without any extension
	 */
	protected function getIcon():string {
		return $this->icon;
	}
	/**
	 * Returns a transparent image of a defined size
	 * @param integer $width the width of the resulting image
	 * @param integer $height the height of the resulting image
	 * @return resource the generated image
	 */
	protected function getTransparentImage(int $width, int $height) {
		$image = imagecreatetruecolor($width, $height);
		imagesavealpha($image, true);
		$color = imagecolorallocatealpha($image, 0, 0, 0, 127);
		imagefill($image, 0, 0, $color);
		return $image;
	}
	/**
	 * Returns a generated image based on a .png file from the .zip archive
	 * inside the media/icons folder
	 * @param string $name the name of the .png file inside the library
	 * @param integer $size size of the generated image. It can be
	 * 16 or 32 (32x32 px or 16x16 px, corresponding to the folder inside the
	 * .zip archive)
	 * @return resource the generated image
	 * @throws Exception if the image can not be generated
	 */
	protected function getLibraryImage(string $name, int $size) {
		switch ($size) {
			case 16:
			case 32:
				break;
			default:
				throw new Exception('Incorect value: '.$size);
		}
		$zipPath = Internals::getFolder(['Media','Icons']).$size.'.zip';
		if (!is_file($zipPath)) {
			throw new Exception('ZIP file is missing from media/icons');
		}
		$archive = new \ZipArchive();
		if ($archive->open($zipPath)) {
			$imageContent = $archive->getFromName($name.'.png');
			if ($imageContent === false) {
				throw new Exception('File not found: '.$name.'.png');
			}
			$image = imagecreatefromstring($imageContent);
			if ($image === false) {
				throw new Exception('File is not valid: '.$name.'.png');
			}
			return $image;
		} else {
			throw new Exception('Unable to process zip file in media/icons');
		}
	}
	/**
	 * Returns the url for the selected image
	 * @return string the url for the selected image
	 */
	abstract public function getUrl():string;
	/**
	 * Checks if an image exists inside the icon archive.
	 * @param string $name the name of the image
	 * @return bool true if the image exists, false if not
	 */
	abstract public static function imageExists(string $name):bool;
	/**
	 * Checks if an image exists inside the icon archive.
	 * @param string $name the name of the image
	 * @param int $size the size of the image (16 or 32)
	 * @return bool true if the image exists, false if not
	 */
	protected static function imageExistsInZip(string $name, int $size):bool {
		if (($size !== 16) && ($size !== 32)) {
			throw new Exception('Unknown image size '.$size);
		}
		$imageFile = 'icons_'.$size.'.csv';
		$imageListFile = Internals::getCachePath().$imageFile;
		if (self::$imageFileList[$size] === NULL) {
			if (!is_file($imageListFile)) {
				// creating a list with all png files inside the library
				// so no zip extract is needed at each function call
				$zipPath = Internals::getFolder(['Media','Icons']).$size.'.zip';
				if (!is_file($zipPath)) {
					throw new Exception('ZIP file is missing: '.$zipPath);
				}
				$csvFileContent = '';
				$archive = new \ZipArchive();
				if ($archive->open($zipPath)) {
					for ($i = 0; $i < $archive->numFiles; $i++) {
						$fileName = basename($archive->statIndex($i)['name']);
						if (substr($fileName, -4) !== '.png') {
							continue;
						}
						if ($csvFileContent !== '') {
							$csvFileContent .= ',';
						}
						$csvFileContent .= substr($fileName, 0, -4);
					}
					file_put_contents($imageListFile, $csvFileContent);
				} else {
					throw new Exception('Unable to process zip file in media/icons');
				}
			}
			self::$imageFileList[$size] = explode(',', file_get_contents($imageListFile));
		}
		if (in_array($name, self::$imageFileList[$size])) {
			return true;
		}
		return false;
	}
}
?>