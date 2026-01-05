<?php
namespace Antheia\Antheia\Classes\Icon;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Internals;
/**
 * An square vector icon with a default 32px side
 * @author Cosmin Staicu
 */
class IconVector extends AbstractIcon {
	private static $imageFileList = null;
	private $size;
	/**
	 * The class constructor
	 * @param string $icon='flower' main image of the icon
	 * @param integer $size=32 the size of the icon
	 * @see AbstractIcon::setIcon()
	 */
	public function __construct(string $icon = 'flower', int $size = 32) {
		parent::__construct($icon);
		$this->setIconType(self::VECTOR);
		$this->setSize($size);
	}
	public static function imageExists(string $name):bool {
		return self::imageExistsInZip($name);
	}
	/**
	 * Checks if an image exists inside the icon archive.
	 * @param string $name the name of the image, without the .svg extension
	 * @return bool true if the image exists, false if not
	 */
	protected static function imageExistsInZip(string $name):bool {
		$imageListFile = Internals::getCachePath().'icons_vector.csv';
		if (self::$imageFileList === NULL) {
			if (!is_file($imageListFile)) {
				// creating a list with all svg files inside the library
				// so no zip extract is needed at each function call
				$zipPath = Internals::getFolder(['Media','Icons','Vector']).'icons.zip';
				if (!is_file($zipPath)) {
					throw new Exception('ZIP file is missing: '.$zipPath);
				}
				$csvFileContent = '';
				$archive = new \ZipArchive();
				if ($archive->open($zipPath)) {
					for ($i = 0; $i < $archive->numFiles; $i++) {
						$fileName = basename($archive->statIndex($i)['name']);
						if (substr($fileName, -4) !== '.svg') {
							continue;
						}
						if ($csvFileContent !== '') {
							$csvFileContent .= ',';
						}
						$csvFileContent .= substr($fileName, 0, -4);
					}
					file_put_contents($imageListFile, $csvFileContent);
				} else {
					throw new Exception('Unable to process '.$zipPath);
				}
			}
			self::$imageFileList = explode(',', file_get_contents($imageListFile));
		}
		if (in_array($name, self::$imageFileList)) {
			return true;
		}
		return false;
	}
	/**
	 * The size of the icon (it will be rendered as a square)
	 * @param int $size the size of the icon, in pixels
	 */
	public function setSize(int $size):void {
		$this->size = $size;
	}
	public function getSize():int {
		return $this->size;
	}
	/**
	 * Check if the cache folder contains the image. If not, then the image will
	 * be extracted from the zip file
	 */
	private function ensureCachedImage():void {
		$file = 'vector_'.$this->getIcon().'.svg';
		if (Internals::getFileContentFromCache($file) === NULL) {
			// file does not exists
			$zipPath = Internals::getFolder(['Media','Icons','Vector']).'icons.zip';
			if (!self::imageExistsInZip($this->getIcon())) {
				throw new Exception(
					'File not found in '.$zipPath.'#'.$this->getIcon().'.svg'
				);
			}
			$archive = new \ZipArchive();
			if ($archive->open($zipPath)) {
				file_put_contents(
					Internals::getCachePath($file),
					$archive->getFromName($this->getIcon().'.svg')
				);
			} else {
				throw new Exception('Unable to process '.$zipPath);
			}
		}	
	}
	public function getUrl():string {
		$this->ensureCachedImage();
		return Internals::getCacheUrl().'vector_'.$this->getIcon().'.svg';
	}
	public function getHtml():string {
		$this->ensureCachedImage();
		$code = "<svg preserveAspectRatio='xMidYMid meet' viewBox='0 0 24 24' "
				."width='".$this->size."' height='".$this->size."'";
		$code .= Internals::getHtmlIdCode($this->getHtmlId(), $this->getTestId());
		if (count($this->getClasses()) > 0) {
			$code .= ' class="'.implode(" ", array_unique($this->getClasses())).'" ';
		}
		foreach ($this->getAttributes() as $name => $value) {
			$code .= ' '.$name.'="'.$value.'"';
		}
		$code .= '>';
		$code .= Internals::getFileContentFromCache('vector_'.$this->getIcon().'.svg');
		$code .= '</svg>';
		return $code;
	}
}
?>
