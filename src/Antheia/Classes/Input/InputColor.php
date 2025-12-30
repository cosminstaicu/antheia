<?php
namespace Antheia\Antheia\Classes\Input;
use Antheia\Antheia\Classes\Internals;
use Antheia\Antheia\Classes\Icon\IconVector;
/**
 * Class for a color selection input
 * @author Cosmin Staicu
 */
class InputColor extends AbstractInput {
	private $placeholder;
	private $onChange;
	public function __construct() {
		parent::__construct();
		$this->setPlaceholder('');
		$this->onChange = '';
	}
	/**
	 * Defines the name of a function that will be called when the color is 
	 * changed
	 * @param string $name the name of a javascript function that will
	 * be called when the color is changed. The function will be called with
	 * "this" as a parameter
	 */
	public function setOnChange(string $name):void {
		$this->onChange = $name;
	}
	/**
	 * Defines the placeholder text, inside the input
	 * @param string $text the placeholder text, inside the input
	 */
	public function setPlaceholder(string $text):void {
		$this->placeholder = $text;
	}
	public function getHtml():string {
		$code = '<input type="color" name="'.$this->getName().'" value="';
		$code .= htmlspecialchars($this->getValue()).'"';
		if ($this->placeholder != '') {
			$code .= ' placeholder="'.$this->placeholder.'"';
		}
		if ($this->getDefaultValue() !== NULL) {
			$code .= ' data-default="'.$this->getDefaultValue().'" ';
		}
		$onChangeCode = '';
		if ($this->getValidation() !== '') {
			$code .= ' data-validate="'.$this->getValidation().'"';
			$function = 'ant_forms_updateStatus(\''.$this->getHtmlId().'\')';
			$code .=' onkeyup = "'.$function.'"';
			$code .=' onblur = "'.$function.'"';
			$onChangeCode .= $function;
		}
		if ($this->onChange !== '') {
			if ($onChangeCode !== '') {
				$onChangeCode .= '; ';
			}
			$onChangeCode .= $this->onChange.'(this)';
		}
		if ($onChangeCode !== '') {
			$code .=' onchange = "'.$onChangeCode.'"';
		}
		$code .= Internals::getHtmlIdCode($this->getHtmlId(), $this->getTestId());
		$code .= $this->getAttributesAsText();
		$code .= '>';
		$icon = new IconVector();
		$icon->setSize(24);
		$icon->setIcon('palette');
		$code .= $icon->getHtml();
		parent::setHtmlCode($code);
		return parent::getHtml();
	}
}
?>