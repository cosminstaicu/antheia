<?php
namespace Cosmin\Antheia\Classes\Input;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * An input for entering a number
 * @author Cosmin Staicu
 */
class InputNumber extends AbstractInputText {
	private $step;
	private $minimum;
	private $maximum;
	public function __construct() {
		parent::__construct();
		$this->setType(self::TYPE_NUMBER);
		$this->setIcon(IconVector::ICON_NUMBER);
		$this->step = null;
		$this->minimum = null;
		$this->maximum = null;
	}
	/**
	 * Defines the minimum value for the input
	 * @param integer $value the minimum value for the input
	 */
	public function setMinValue(int $value):void {
		$this->minimum = $value;
	}
	/**
	 * Defines the maximum value for the input
	 * @param integer $valoare the maximum value for the input
	 */
	public function setMaxValue(int $value):void {
		$this->maximum = $value;
	}
	/**
	 * Defines the step for incrementing the input
	 * @param float $step the step for incrementing the input (it can also have
	 * decimal digits)
	 */
	public function setStep(float $step):void {
		$this->step = $step;
	}
	public function getHtml():string {
		if ($this->minimum !== null) {
			$this->addAttribute('min', $this->minimum);
		}
		if ($this->maximum !== null) {
			$this->addAttribute('max', $this->maximum);
		}
		if ($this->step !== null) {
			$this->addAttribute('step', $this->step);
		}
		return parent::getHtml();
	}
}
?>