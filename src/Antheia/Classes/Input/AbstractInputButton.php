<?php
namespace Cosmin\Antheia\Classes\Input;
use Cosmin\Antheia\Classes\Exception;
/**
 * Abstract class to be extended by all types of buttons
 * @author Cosmin Staicu
 */
abstract class AbstractInputButton extends AbstractInput {
	const TYPE_BUTTON = 1;
	const TYPE_SUBMIT = 2;
	const TYPE_RESET = 3;
	private $buttonType;
	public function __construct() {
		parent::__construct();
		$this->setLabelExport(false);
		$this->buttonType = self::TYPE_SUBMIT;
	}
	/**
	 * Defines the text to be displayed on the button. Alias for setValue()
	 * @param string $text the text to be displayed on the button
	 * @see AbstractInput::setValue()
	 */
	public function setText(string $text):void {
		$this->setValue($text);
	}
	/**
	 * Defines the button type
	 * @param integer $type the button type, as a constant like
	 * AbstractInputButton::TYPE_##
	 */
	protected function setButtonType(int $type):void {
		$this->buttonType = $type;
	}
	public function getHtml():string {
		if ($this->getValue() === '') {
			throw new Exception('Button value not defined');
		}
		$code = '';
		$code .= '<input type="';
		switch ($this->buttonType) {
			case self::TYPE_BUTTON:
				$code .= 'button';
				break;
			case self::TYPE_SUBMIT:
				$code .= 'submit';
				break;
			case self::TYPE_RESET:
				$code .= 'reset';
				break;
			default:
				throw new Exception('Unknown button type: '.$this->buttonType);
		}
		$code .= '" value="'.$this->getValue().'" ';
		if ($this->getOnClick() !== '') {
			$code .= ' onClick="'.$this->getOnClick().'" ';
		}
		if ($this->getHtmlId() !== '') {
			$code .= 'id="'.$this->getHtmlId().'" ';
		}
		$code .= $this->getAttributesAsText();
		$code .= '>';
		parent::setHtmlCode($code);
		return parent::getHtml();
	}
}
?>