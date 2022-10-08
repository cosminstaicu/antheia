<?php
namespace Cosmin\Antheia\Classes\Icon;
use Cosmin\Antheia\Classes\Internals;
/**
 * An square image icon with a 32px side
 * @author Cosmin Staicu
 */
class IconPixelSmall extends AbstractPixelIcon {
	/**
	 * The class constructor
	 * @param string $icon main image of the icon
	 * @see AbstractPixelIcon::setIcon()
	 */
	public function __construct(string $icon) {
		parent::__construct($icon);
	}
	public static function imageExists(string $name):bool {
		return self::imageExistsInZip($name, 16);
	}
	public function getUrl():string {
		$file = '16px_'.md5($this->getIcon()).'.png';
		$cachePath = Internals::getCachePath().$file;
		if (!is_file($cachePath)) {
			$result = $this->getTransparentImage(16,16);
			imagecopy(
					$result,
					self::getLibraryImage($this->getIcon(), 16),
					0, 0, 0, 0, 16, 16
			);
			// saving the generated file into cache
			imagepng($result, $cachePath, 0);
		}
		return Internals::getCacheUrl().$file;
	}
}
?>