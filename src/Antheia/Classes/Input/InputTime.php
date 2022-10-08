<?php
namespace Cosmin\Antheia\Classes\Input;
use Cosmin\Antheia\Interfaces\BeforeAfterCallback;
use Cosmin\Antheia\Classes\Globals;
use Cosmin\Antheia\Classes\Exception;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
use Cosmin\Antheia\Classes\Input\Raw\InputRawCustomButton;
/**
 * A time selection input, from where the user can select a time value
 * either by typing or by selecting predefined values
 * @author Cosmin Staicu
 */
class InputTime extends AbstractInput implements BeforeAfterCallback {
	private $selectMode;
	private $hourMin;
	private $hourMax;
	private $hourStep;
	private $minuteMin;
	private $minuteMax;
	private $minuteStep;
	private $displayUndefined;
	private $beforeCallback;
	private $afterCallback;
	public function __construct() {
		parent::__construct();
		$this->selectMode = false;
		$this->hourMin = 0;
		$this->hourMax = 23;
		$this->hourStep = 1;
		$this->minuteMin = 0;
		$this->minuteMax = 59;
		$this->minuteStep = 1;
		$this->displayUndefined = false;
		$this->exportForAttributeInLabel(false);
		$this->setValue(Globals::getUndefinedTime());
		$this->beforeCallback = '';
		$this->afterCallback = '';
	}
	/**
	 * Calling the method sets the selection mode for the input. If selection mode
	 * is enabled then the user will choose from some predefined values, by
	 * clicking on them. If the selection mode is disabled then the user
	 * has to input the time by hand
	 * @param bool $status (optional) (default true) the status for the
	 * selection mode
	 */
	public function setSelectionMode(bool $status = true):void {
		$this->selectMode = $status;
	}
	/**
	 * Defines the hours for the selection mode
	 * @param int $step the step for incrementing hours (default 1)
	 * @param int $min first available hour (default 0)
	 * @param int $max last available hour (default 23)
	 * @throws Exception
	 */
	public function setHourSelection(int $step, int $min=0, int $max=23):void {
		if (($min < 0) || ($min > 23)) {
			throw new Exception('Invalid minimum value');
		}
		if (($max < 0) || ($max > 23)) {
			throw new Exception('Invalid maximum value');
		}
		if ($min > $max) {
			throw new Exception('Minimum is greater then maximum');
		}
		$this->hourMin = $min;
		$this->hourMax = $max;
		$this->hourStep = $step;
	}
	/**
	 * Defines the minutes for the selection mode
	 * @param int $step the step for incrementing minutes (default 1)
	 * @param int $min first available minutes (default 0)
	 * @param int $max last available minutes (default 59)
	 * @throws Exception
	 */
	public function setMinuteSelection(int $step, int $min=0, int $max=59):void {
		if (($min < 0) || ($min > 59)) {
			throw new Exception('Invalid minimum value');
		}
		if (($max < 0) || ($max > 59)) {
			throw new Exception('Invalid maximum value');
		}
		if ($min > $max) {
			throw new Exception('Minimum is greater then maximum');
		}
		$this->minuteMin = $min;
		$this->minuteMax = $max;
		$this->minuteStep = $step;
	}
	/**
	 * Calling the method will add a button with the Undefined option, available
	 * to the user
	 */
	public function displayUndefined():void {
		$this->displayUndefined = true;
	}
	public function setBeforeCallback(string $functionName):void {
		$this->beforeCallback = $functionName;
	}
	public function setAfterCallback(string $functionName):void {
		$this->afterCallback = $functionName;
	}
	public function getHtml():string {
		$this->checkHtmlId();
		$button = new InputRawCustomButton();
		$button->addAttribute('data-jsf-type', 'time');
		$button->setText(Texts::formatTime($this->getValue()));
		$button->setIcon(IconVector::ICON_TIME);
		$button->setHiddenInputHtmlId($this->getHtmlId());
		$button->setHiddenInputName($this->getName());
		$button->setHiddenInputValue($this->getValue());
		if ($this->getDefaultValue() !== NULL) {
			$button->addHiddenInputAttribute('data-default', $this->getDefaultValue());
		}
		$button->setOnClick('jsf_inputTime_start(this)');
		$button->addHiddenInputAttribute('data-validate', $this->getValidation());
		if ($this->selectMode) {
			$button->addAttribute('data-select', 'active');
		} else {
			$button->addAttribute('data-select', 'inactive');
		}
		$button->addAttribute('data-hour-step', $this->hourStep);
		$button->addAttribute('data-hour-min', $this->hourMin);
		$button->addAttribute('data-hour-max', $this->hourMax);
		$button->addAttribute('data-minute-step', $this->minuteStep);
		$button->addAttribute('data-minute-min', $this->minuteMin);
		$button->addAttribute('data-minute-max', $this->minuteMax);
		$button->addAttribute('data-label', $this->getLabelText());
		$button->addTextAttribute('undefined', 'DOES_NOT_MATTER');
		$button->addAttribute('data-undefined-value', Globals::getUndefinedTime());
		$button->addTextAttribute('hour', 'HOUR');
		$button->addTextAttribute('minute', 'MINUTE');
		$button->addTextAttribute('error', 'SELECTED_VALUE_INVALID');
		$button->addTextAttribute('submit', 'SUBMIT');
		$button->addHiddenInputAttribute('data-pre', $this->beforeCallback);
		$button->addHiddenInputAttribute('data-post', $this->afterCallback);
		if ($this->displayUndefined) {
			$button->addAttribute('data-show-undefined', 'yes');
		} else {
			$button->addAttribute('data-show-undefined', 'no');
		}
		foreach ($this->getAttributeList() as $info) {
			$button->addHiddenInputAttribute($info['name'], $info['value']);
		}
		$this->setHtmlCode($button->getHtml());
		return parent::getHtml();
	}
}
?>