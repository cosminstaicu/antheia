<?php
namespace Antheia\Antheia\Classes\Input;
use Antheia\Antheia\Classes\Exception;
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
	private $displayBrowser;
	public function __construct() {
		parent::__construct();
		$this->beforeCallback = '';
		$this->afterCallback = '';
		$this->extensionList = [];
		$this->maximumFiles = 1;
		$this->url = '';
		$this->maximumTotalSize = 0;
		$this->maximumFileSize = 0;
		$this->setLabelExport(false);
		$this->infoText = Texts::get('DROP_FILE_HERE');
		$this->displayBrowser = true;
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
	 * can select a file that will be uploaded to the server
	 * @param bool $status true if the button should be displayed, false if not
	 */
	public function setDisplayBrowser(bool $status):void {
		$this->displayBrowser = $status;
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
		$this->checkHtmlId();
		$code = '<div class="ant_inputFileDrop"';
		$this->addAttribute('data-name', $this->getName());
		$this->addAttribute('data-max-files', $this->maximumFiles);
		$this->addAttribute('data-max-file-size', $this->maximumFileSize);
		$this->addAttribute('data-max-total-size', $this->maximumTotalSize);
		$this->addAttribute('data-url', $this->url);
		$this->addTextAttribute('extension', 'EXTENSION_NOT_ALLOWED');
		$this->addTextAttribute('total-size', 'MAXIMUM_UPLOAD_SIZE_ERROR');
		$this->addTextAttribute('total-files', 'TOO_MANY_FILES');
		$this->addTextAttribute('file-size', 'FILE_SIZE_ERROR');
		if ($this->getHtmlId() !== '') {
			$code .= ' id="'.$this->getHtmlId().'"';
		}
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
		$icon->setIcon($icon::ICON_UPLOAD);
		$icon->setSize($icon::SIZE_XL);
		$code .= $icon->getHtml();
		if ($this->infoText !== '') {
			$code .= '<p>'.$this->infoText.'</p>';
		}
		if ($this->displayBrowser) {
			$button = new InputFile();
			foreach ($this->extensionList as $extension) {
				$button->addExtension($extension);
			}
			$button->getButton()->setText(Texts::get('OR_JUST_BROWSE'));
			$button->setLabelExport(false);
			$button->setOnChange('ant_inputFileDrop_fileSelected(this)');
			$code .= $button->getHtml();
		}
		$code .= '</div>';
		parent::setHtmlCode($code);
		return parent::getHtml();
	}
}
?>