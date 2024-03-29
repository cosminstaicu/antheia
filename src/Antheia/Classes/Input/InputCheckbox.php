<?php
namespace Antheia\Antheia\Classes\Input;
use Antheia\Antheia\Classes\Input\Raw\InputRawCheckbox;
/**
 * Just a checkbox input
 * @author Cosmin Staicu
 */
class InputCheckbox extends AbstractInput {
	private $checkbox;
	public function __construct() {
		parent::__construct();
		$this->setLabelExport(self::LABEL_NONE);
		$this->checkbox = new InputRawCheckbox();
	}
	/**
	 * Defines if the checkbox should be already checked or not
	 * @param boolean $status true if the checkbox is checked, false if not 
	 */
	public function setChecked(bool $status = true):void {
		$this->checkbox->setChecked($status);
	}
	public function getHtml():string {
		foreach ($this->getAttributeList() as $info) {
			$this->checkbox->addAttribute($info['name'], $info['value']);
		}
		$this->checkbox->setOnClick($this->getOnClick());
		$this->checkbox->setLabel($this->getLabelText());
		$this->checkbox->setName($this->getName());
		$this->checkbox->setHtmlId($this->getHtmlId());
		$this->checkbox->setValue($this->getValue());
		parent::setHtmlCode($this->checkbox->getHtml());
		return parent::getHtml();
	}
}
?>