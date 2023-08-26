<?php
namespace Antheia\Antheia\Classes\Input;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Input\Raw\InputRawCustomButton;
/**
 * An input for selecting a file
 * @author Cosmin Staicu
 */
class InputFile extends AbstractInput {
	private $extensionList;
	private $button;
	private $onChange;
	static private $counter = 0;
	public function __construct() {
		parent::__construct();
		$this->extensionList = [];
		$this->button = new InputRawCustomButton();
		$this->button->setText(Texts::get('SELECT_A_FILE'));
		$this->button->setIcon(IconVector::ICON_FILE);
		$this->button->setOnClick('ant_inputFile_start(this)');
		$this->button->disableHiddenInputExport();
		self::setUniqueHtmlId($this->button);
		$this->onChange = '';
	}
	public function getIdForLabel():string {
		return $this->button->getHtmlId();
	}
	/**
	 * Defines javascript code to be executed when the input is changed
	 * @param string $onChange the javascript code to be executed when
	 * the input is changed
	 */
	public function setOnChange(string $onChange):void {
		$this->onChange = $onChange;
	}
	/**
	 * Returns the button that manages the input
	 * @return InputRawCustomButton the visible button
	 */
	public function getButton():InputRawCustomButton {
		return $this->button;
	}
	/**
	 * Adds an extension to the accepted extensions list
	 * @param string $extension the extension
	 */
	public function addExtension(string $extension):void {
		if (substr($extension, 0, 1) !== '.') {
			$extension = '.'.$extension;
		}
		$this->extensionList[] = $extension;
	}
	/**
	 * Returns the html code used for the hidden file input used by the input.
	 * Probably the end user will not use this method
	 * @return string the html code used for the hidden file input used by the input
	 */
	public function getHtmlHiddenFileInput():string {
		$code = '<input type="file" name="'.$this->getName().'"';
		if ($this->getHtmlId() !== '') {
			$code .= 'id="'.$this->getHtmlId().'"';
		}
		if (count($this->extensionList) > 0) {
			$code .= ' accept="'.implode(',', $this->extensionList).'" ';
		}
		$code .= ' onChange="ant_inputFile_update(this)';
		if ($this->onChange !== '') {
			$code .= ';'.$this->onChange;
		}
		$code .= '"';
		if ($this->getValidation() !== '') {
			$code .= ' data-validate="'.$this->getValidation().'"';
		}
		$code .= $this->getAttributesAsText();
		$code .= '>';
		return $code;
	}
	public function getHtml():string {
		$code = '';
		$code .= $this->getHtmlHiddenFileInput();
		$code .= $this->button->getHtml();
		parent::setHtmlCode($code);
		return parent::getHtml();
	}
}
?>