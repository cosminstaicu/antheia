<?php
namespace Antheia\Antheia\Classes\Input;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Internals;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Interfaces\BeforeAfterCallback;
/**
 * Defines an area where the user can drag and drop single or multiple files
 * to be uploaded to the server
 * @author Cosmin Staicu
 */
class InputFileDrop extends AbstractInput implements BeforeAfterCallback {
	private $extensionList;
	private $maximumFiles;
	private $url;
	private $beforeCallback;
	private $afterCallback;
	private $maximumTotalSize;
	private $maximumFileSize;
	private $infoText;
	private $browserButton;
	private $displayBrowser;
	private $fullPageDrop;
	private static $totalItems = 0;
	public function __construct() {
		parent::__construct();
		$this->beforeCallback = '';
		$this->afterCallback = '';
		$this->extensionList = [];
		$this->maximumFiles = 1;
		$this->url = '';
		$this->maximumTotalSize = 0;
		$this->maximumFileSize = 0;
		$this->setLabelExport(self::LABEL_NONE);
		$this->infoText = Texts::get('DROP_FILE_HERE');
		$this->browserButton = new InputFile();
		$this->browserButton->setLabelExport(self::LABEL_NONE);
		$this->browserButton->setOnChange(
			'ant_inputFileDrop_fileSelected(this)'
		);
		$this->displayBrowser = true;
		$this->fullPageDrop = false;
	}
	/**
	 * Defines the text to be displayed inside the drop area, below the
	 * upload icon
	 * @param string $text the text to be displayed inside the drop area,
	 * below the upload icon
	 */
	public function setText(string $text):void {
		$this->infoText = $text;
	}
	/**
	 * Defines if a file select button will be displayed inside the drop area.
	 * When clicked, the button will display a file browser from where the user
	 * can select a file that will be uploaded to the server.
	 * @param bool $status true if the button should be displayed, false if not
	 */
	public function setDisplayBrowser(bool $status):void {
		$this->displayBrowser = $status;
	}
	/**
	 * Defines if the drop area should be limited (and displayed) or full page
	 * drop is enabled (and no specific drop area is displayed)
	 * @param bool $status (optional) (default true) true if full page drop is
	 * enabled, false if a defined area for drop should be rendered.
	 */
	public function setFullPageDrop(bool $status = true):void {
		$this->fullPageDrop = $status;
	}
	/**
	 * Returns the file select button. The button visibility (default visible)
	 * can be set using the setDisplayBrowser method
	 * @return InputFile the file browser button
	 */
	public function getBrowserButton():InputFile {
		return $this->browserButton;
	}
	/**
	 * Defines the upload size limit. If one of the limits is exceeded then no
	 * upload will start and an alert will be triggered
	 * @param int $totalSize total size for all uploades files, in MB. If the
	 * value is 0 then no limit is required
	 * @param int $file (optional) (default 0) maximum size for one file, in MB.
	 * If the value is 0 then no limit is required
	 */
	public function setMaxSize(int $totalSize, int $fileSize = 0):void {
		$this->maximumTotalSize = $totalSize;
		$this->maximumFileSize = $fileSize;
	}
	/**
	 * Adds an extension to the accepted extensions list
	 * @param string $extension the extension
	 */
	public function addExtension(string $extension):void {
		if (substr($extension, 0, 1) !== '.') {
			$extension = '.'.$extension;
		}
		$this->extensionList[] = strtolower($extension);
	}
	/**
	 * Defines the maximum number of files that can be dropped on the area.
	 * Dropping more files will trigger an error
	 * @param int $maxFiles maximum number of files or 0 if no limit is required
	 */
	public function setMaxFiles(int $maxFiles):void {
		$this->maximumFiles = $maxFiles;
	}
	/**
	 * Defines the url where the files will be uploaded
	 * @param string $url
	 */
	public function setUrl(string $url):void {
		$this->url = $url;
	}
	/**
	 * In the fileDrop case, the javascript function must return true for the
	 * upload to start. If the javascript function returns anything but true
	 * then the upload will not start.
	 * @see BeforeAfterCallback::setBeforeCallback()
	 */
	public function setBeforeCallback(string $functionName):void {
		$this->beforeCallback = $functionName;
	}
	public function setAfterCallback(string $functionName):void {
		$this->afterCallback = $functionName;
	}
	public function setValidation(string $javascriptFunction):void {
		throw new Exception('Drop file inputs can not be validated');
	}
	public function getHtml():string {
		if ($this->url === '') {
			throw new Exception('URL for fileDrop is not defined');
		}
		if ($this->afterCallback === '') {
			throw new Exception('AfterCallback function is not defined');
		}
		if ($this->fullPageDrop) {
			if (self::$totalItems !== 0) {
				throw new Exception(
					'Multiple file drops not allowed when full page drop is enabled'
				);
			}
			self::$totalItems++;
		}
		$code = '<div class="ant_inputFileDrop';
		if ($this->fullPageDrop) {
			$code .= ' ant_fullPage';
		} else {
			$code .= ' ant_local';
		}
		$code .= '"';
		$this->addAttribute('data-name', $this->getName());
		$this->addAttribute('data-max-files', $this->maximumFiles);
		$this->addAttribute('data-max-file-size', $this->maximumFileSize);
		$this->addAttribute('data-max-total-size', $this->maximumTotalSize);
		$this->addAttribute('data-url', $this->url);
		$this->addTextAttribute('extension', 'EXTENSION_NOT_ALLOWED');
		$this->addTextAttribute('total-size', 'MAXIMUM_UPLOAD_SIZE_ERROR');
		$this->addTextAttribute('total-files', 'TOO_MANY_FILES');
		$this->addTextAttribute('file-size', 'FILE_SIZE_ERROR');
		$code .= Internals::getHtmlIdCode($this->getHtmlId(), $this->getTestId());
		if ($this->beforeCallback !== '') {
			$this->addAttribute('data-pre', $this->beforeCallback);
		}
		$this->addAttribute('data-post', $this->afterCallback);
		if (count($this->extensionList) > 0) {
			$this->addAttribute('data-extensions', implode(',', $this->extensionList));
		}
		$code .= $this->getAttributesAsText();
		$code .= '>';
		$icon = new IconVector();
		$icon->setIcon('cloud-upload');
		$icon->setSize(48);
		if ($this->fullPageDrop) {
			$code .= '<p>';
			$code .= $icon->getHtml();
			if ($this->infoText !== '') {
				$code .= '<br>'.$this->infoText;
			}
			$code .= '</p>';
		} else {
			$code .= $icon->getHtml();
			if ($this->infoText !== '') {
				$code .= '<p>'.$this->infoText.'</p>';
			}
		}
		if ($this->displayBrowser) {
			// file select button is enabled
			foreach ($this->extensionList as $extension) {
				$this->browserButton->addExtension($extension);
			}
		}
		if (($this->displayBrowser) && (!$this->fullPageDrop)) {
			$this->browserButton->getButton()->setText(Texts::get('OR_JUST_BROWSE'));
			$code .= $this->browserButton->getHtml();
		}
		$code .= '</div>';
		if ($this->fullPageDrop) {
			if ($this->displayBrowser) {
				$code .= $this->browserButton->getHtmlHiddenFileInput();
				$code .= $this->browserButton->getButton()->getHtml();
			}
			$code .= '<script>ant_inputFileDrop_enableFullPageDrop();</script>';
		}
		parent::setHtmlCode($code);
		return parent::getHtml();
	}
}
?>
