<?php
namespace Antheia\Antheia\Classes\Icon;
use Antheia\Antheia\Classes\Internals;
/**
 * An square image icon with a 32px side
 * @author Cosmin Staicu
 */
class IconPixelBig extends AbstractIconPixel {
	private $addon;
	/**
	 * The class constructor
	 * @param string $icon='default' main image of the icon
	 * @param string $addon='' a seconday image, to be placed on the
	 * bottom right side of the main image
	 * @see AbstractIconPixel::setIcon()
	 */
	public function __construct(string $icon = 'default', string $addon = '') {
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
	public function getSize():int {
		return 32;
	}
	public function getUrl():string {
		$file = '32px_'.$this->getIcon();
		if ($this->addon !== '') {
			$file .= '-'.$this->addon;
		}
		$file .= '.png';
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
	public function getHtml(string $altText = ''):string {
		$code = '<img src="'.$this->getUrl().'" width="32" height="32"';
		if ($altText !== '') {
			$code .= ' alt="'.$altText.'"';
		}
		$code .= Internals::getHtmlIdCode($this->getHtmlId(), $this->getTestId());
		if (count($this->getClasses()) > 0) {
			$code .= ' class="'.implode(" ", array_unique($this->getClasses())).'"';
		}
		foreach ($this->getAttributes() as $name => $value) {
			$code .= ' '.$name.'="'.$value.'"';
		}
		$code .= '>';
		return $code;
	}
}
?>
