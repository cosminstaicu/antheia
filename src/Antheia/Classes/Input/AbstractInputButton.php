<?php
namespace Antheia\Antheia\Classes\Input;
use Antheia\Antheia\Classes\Exception;
/**
 * Abstract class to be extended by all types of buttons
 * @author Cosmin Staicu
 */
abstract class AbstractInputButton extends AbstractInput {
	const LOW_CONTRAST = 'low';
	const NORMAL = 'normal';
	const WARNING = 'warning';
	const TYPE_BUTTON = 1;
	const TYPE_SUBMIT = 2;
	const TYPE_RESET = 3;
	private $buttonType;
	private $appearance;
	public function __construct() {
		parent::__construct();
		$this->setLabelExport(self::LABEL_NONE);
		$this->buttonType = self::TYPE_SUBMIT;
		$this->appearance = self::NORMAL;
	}
	/**
	* Defines the appearance of the menu, as normal, low contrast or warning
	* @param string $appearance the appearance as one of the constants
	* AbstractMenu::LOW_CONTRAST, AbstractMenu::NORMAL, AbstractMenu::WARNING
	*/
	public function setAppearance(string $appearance):void {
		$this->appearance = $appearance;
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
		$code .= '" value="'.$this->getValue().'"';
		if ($this->appearance !== self::NORMAL) {
			$code .= ' class="';
			switch ($this->appearance) {
				case self::LOW_CONTRAST:
					$code .= 'low-contrast';
					break;
				case self::WARNING:
					$code .= 'warning';
					break;
				default:
			}
			$code .= '"';
		}
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