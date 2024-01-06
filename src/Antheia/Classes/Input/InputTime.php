<?php
namespace Antheia\Antheia\Classes\Input;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Globals;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Input\Raw\InputRawCustomButton;
use Antheia\Antheia\Interfaces\BeforeAfterCallback;
/**
 * A time selection input, from where the user can select a time value
 * either by typing or by selecting predefined values
 * @author Cosmin Staicu
 */
class InputTime extends AbstractInput implements BeforeAfterCallback {
	private $button;
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
	static private $counter = 0;
	public function __construct() {
		parent::__construct();
		$this->button = new InputRawCustomButton();
		self::setUniqueHtmlId($this->button);
		$this->selectMode = false;
		$this->hourMin = 0;
		$this->hourMax = 23;
		$this->hourStep = 1;
		$this->minuteMin = 0;
		$this->minuteMax = 59;
		$this->minuteStep = 1;
		$this->displayUndefined = false;
		$this->setValue(Globals::getUndefinedTime());
		$this->beforeCallback = '';
		$this->afterCallback = '';
	}
	public function getIdForLabel():string {
		return $this->button->getHtmlId();
	}
	/**
	 * Returns the button that manages the input
	 * @return InputRawCustomButton the visible button
	 */
	public function getButton():InputRawCustomButton {
		return $this->button;
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
		$this->button->addAttribute('data-ant-type', 'time');
		$this->button->setText(Texts::formatTime($this->getValue()));
		$this->button->setIcon(IconVector::ICON_TIME);
		$this->button->setHiddenInputHtmlId($this->getHtmlId());
		$this->button->setHiddenInputName($this->getName());
		$this->button->setHiddenInputValue($this->getValue());
		if ($this->getDefaultValue() !== NULL) {
			$this->button->addHiddenInputAttribute('data-default', $this->getDefaultValue());
		}
		$this->button->setOnClick('ant_inputTime_start(this)');
		$this->button->addHiddenInputAttribute('data-validate', $this->getValidation());
		if ($this->selectMode) {
			$this->button->addAttribute('data-select', 'active');
		} else {
			$this->button->addAttribute('data-select', 'inactive');
		}
		$this->button->addAttribute('data-hour-step', $this->hourStep);
		$this->button->addAttribute('data-hour-min', $this->hourMin);
		$this->button->addAttribute('data-hour-max', $this->hourMax);
		$this->button->addAttribute('data-minute-step', $this->minuteStep);
		$this->button->addAttribute('data-minute-min', $this->minuteMin);
		$this->button->addAttribute('data-minute-max', $this->minuteMax);
		$this->button->addAttribute('data-label', $this->getLabelText());
		$this->button->addTextAttribute('undefined', 'DOES_NOT_MATTER');
		$this->button->addAttribute('data-undefined-value', Globals::getUndefinedTime());
		$this->button->addTextAttribute('hour', 'HOUR');
		$this->button->addTextAttribute('minute', 'MINUTE');
		$this->button->addTextAttribute('error', 'SELECTED_VALUE_INVALID');
		$this->button->addTextAttribute('submit', 'SUBMIT');
		$this->button->addHiddenInputAttribute('data-pre', $this->beforeCallback);
		$this->button->addHiddenInputAttribute('data-post', $this->afterCallback);
		$this->button->addHiddenInputAttribute(
			'data-visible-element-id', $this->button->getHtmlId()
		);
		if ($this->displayUndefined) {
			$this->button->addAttribute('data-show-undefined', 'yes');
		} else {
			$this->button->addAttribute('data-show-undefined', 'no');
		}
		foreach ($this->getAttributeList() as $info) {
			$this->button->addHiddenInputAttribute($info['name'], $info['value']);
		}
		$this->setHtmlCode($this->button->getHtml());
		return parent::getHtml();
	}
}
?>