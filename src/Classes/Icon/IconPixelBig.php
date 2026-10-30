<?php
namespace Antheia\Framework\Icon;
use Antheia\Framework\Internals;
/**
 * An square image icon with a 32px side
 * @author Cosmin Staicu
 */
class IconPixelBig extends AbstractIconPixel {
	private $bottomLeftAddon;
	private $bottomRightAddon;
	/**
	 * The class constructor
	 * @param string $icon='default' main image of the icon
	 * @param string $bottomRight='' a small image, to be placed on the bottom right side
	 * of the main image or an empty string if no image is needed
	 * @param string $bottomLeft='' a small image, to be placed on the bottom left side
	 * of the main image  or an empty string if no image is needed
	 * @see AbstractIconPixel::setIcon()
	 */
	public function __construct(string $icon = 'default', string $br = '', string $bl = '') {
		parent::__construct($icon);
		$this->setBottomRightIcon($br);
		$this->setBottomLeftIcon($bl);
	}
	public static function imageExists(string $name):bool {
		return self::imageExistsInZip($name, 32);
	}
	/**
	 * An addon image that will be places on the bottom right side of the main image.
	 * @param string $name the name of the image used as an addon or an empty string for no image
	 */
	public function setBottomRightIcon(string $name):void {
		$this->bottomRightAddon = $name;
	}
	/**
	 * An addon image that will be places on the bottom left side of the main image.
	 * @param string $name the name of the image used as an addon or an empty string for no image
	 */
	public function setBottomLeftIcon(string $name):void {
		$this->bottomLeftAddon = $name;
	}
	public function getSize():int {
		return 32;
	}
	public function getUrl():string {
		$file = '32px_'.$this->getIcon();
		if (($this->bottomRightAddon.$this->bottomLeftAddon) !== '') {
			// the icon has at least one addon
			$file .= '-'.$this->bottomRightAddon;
			if ($this->bottomLeftAddon !== '') {
				$file .= '-'.$this->bottomLeftAddon;
			}
		}
		$file .= '.png';
		$cachePath = Internals::getCachePath().$file;
		if (!is_file($cachePath)) {
			$result = $this->getTransparentImage(32,32);
			imagecopy($result, self::getLibraryImage($this->getIcon(), 32),0, 0, 0, 0, 32, 32);
			if ($this->bottomRightAddon !== '') {
				imagecopy(
					$result, self::getLibraryImage($this->bottomRightAddon, 16), 16, 16, 0, 0, 16, 16
				);
			}
			if ($this->bottomLeftAddon !== '') {
				imagecopy(
					$result, self::getLibraryImage($this->bottomLeftAddon, 16), 0, 16, 0, 0, 16, 16
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
