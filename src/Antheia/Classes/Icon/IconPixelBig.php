<?php
namespace Cosmin\Antheia\Classes\Icon;
use Cosmin\Antheia\Classes\Internals;
/**
 * An square image icon with a 32px side
 * @author Cosmin Staicu
 */
class IconPixelBig extends AbstractPixelIcon {
	private $addon;
	/**
	 * The class constructor
	 * @param string $icon main image of the icon
	 * @param string $addon (optional) a seconday image, to be places on the
	 * bottom right side of the main image
	 * @see AbstractPixelIcon::setIcon()
	 */
	public function __construct(string $icon, string $addon = '') {
		parent::__construct($icon);
		$this->setBottomRightIcon($addon);
	}
	public static function imageExists(string $name):bool {
		return self::imageExistsInZip($name, 32);
	}
	/**
	 * An addon image that will be places on the bottom right side of the
	 * main image.
	 * @param string $name the name of the image used as an addon or an empty
	 * string if no image is required 
	 */
	public function setBottomRightIcon(string $name):void {
		$this->addon = $name;
	}
	public function getUrl():string {
		$file = '32px_'.md5($this->getIcon().$this->addon).'.png';
		$cachePath = Internals::getCachePath().$file;
		if (!is_file($cachePath)) {
			$result = $this->getTransparentImage(32,32);
			imagecopy(
				$result,
				self::getLibraryImage($this->getIcon(), 32),
				0, 0, 0, 0, 32, 32
			);
			if ($this->addon !== '') {
				imagecopy(
					$result,
					self::getLibraryImage($this->addon, 16),
					16, 16, 0, 0, 16, 16
				);
			}
			// saving the generated file into cache
			imagepng($result, $cachePath, 0);
		}
		return Internals::getCacheUrl().$file;
	}
	/**
	 * Returns the html code for the icon
	 * @return string the html code for the icon
	 */
	public function getHtml(string $altText = ''):string {
		$code = '<img src="'.$this->getUrl().'" width="32" height="32"';
		if ($altText !== '') {
			$code .= ' alt="'.$altText.'"';
		}
		$code .= '>';
		return $code;
	}
}
?>