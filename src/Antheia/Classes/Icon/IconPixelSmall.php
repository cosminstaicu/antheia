<?php
namespace Antheia\Antheia\Classes\Icon;
use Antheia\Antheia\Classes\Internals;
/**
 * An square image icon with a 16px side
 * @author Cosmin Staicu
 */
class IconPixelSmall extends AbstractIconPixel {
	/**
	 * The class constructor
	 * @param string $icon='default' main image of the icon
	 * @see AbstractIconPixel::setIcon()
	 */
	public function __construct(string $icon='default') {
		parent::__construct($icon);
	}
	public static function imageExists(string $name):bool {
		return self::imageExistsInZip($name, 16);
	}
	public function getSize():int {
		return 16;
	}
	public function getUrl():string {
		$file = '16px_'.$this->getIcon().'.png';
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
	public function getHtml(string $altText = ''):string {
		$code = '<img src="'.$this->getUrl().'" width="16" height="16"';
		if ($altText !== '') {
			$code .= ' alt="'.addslashes($altText).'"';
		}
		$code .= Internals::getHtmlIdCode($this->getHtmlId(), $this->getTestId());
		if (count($this->getClasses()) > 0) {
			$code .= ' class="'.implode(" ", array_unique($this->getClasses())).'" ';
		}
		foreach ($this->getAttributes() as $name => $value) {
			$code .= ' '.$name.'="'.$value.'"';
		}
		$code .= '>';
		return $code;
	}
}
?>