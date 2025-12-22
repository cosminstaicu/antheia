<?php
namespace Antheia\Antheia\Classes\Input;
use Antheia\Antheia\Classes\Globals;
use Antheia\Antheia\Classes\Internals;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Input\Raw\InputRawCustomButton;
use Antheia\Antheia\Interfaces\BeforeAfterCallback;
/**
 * An input to select a date
 * @author Cosmin Staicu
 */
class InputDate extends AbstractInput implements BeforeAfterCallback {
	private $button;
	private $displayUndefined;
	private $displayToday;
	private $beforeCallback;
	private $afterCallback;
	static private $todayValue = '0';
	static private $counter = 0;
	public function __construct() {
		parent::__construct();
		$this->button = new InputRawCustomButton();
		$this->displayToday = false;
		$this->displayUndefined = false;
		$this->setValue(Globals::getUndefinedDate());
		if (self::$todayValue == '0') {
			self::$todayValue = date('Ymd');
		}
		self::setUniqueHtmlId($this->button);
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
	 * Defines if a button with TODAY value shoud be available
	 * @param boolean $status true if the button will be available, false if noe
	 */
	public function displayToday(bool $status = true):void {
		$this->displayToday = $status;
	}
	/**
	 * Defines if a button with UNDEFINED value should be available
	 * @param boolean $status true if the button will be available, false if not
	 */
	public function displayUndefined(bool $status = true):void {
		$this->displayUndefined = $status;
	}
	public function getReadableValue():string {
		return Texts::formatDate($this->getValue());
	}
	public function setBeforeCallback(string $name):void {
		$this->beforeCallback = $name;
	}
	public function setAfterCallback(string $name):void {
		$this->afterCallback = $name;
	}
	public function getHtml():string {
		$this->button->addAttribute('data-ant-type', 'date');
		$this->button->setHiddenInputHtmlId($this->getHtmlId());
		$this->button->setHiddenInputName($this->getName());
		$this->button->setHiddenInputValue($this->getValue());
		if ($this->getDefaultValue() !== NULL) {
			$this->button->addHiddenInputAttribute('data-default', $this->getDefaultValue());
		}
		foreach ($this->getAttributeList() as $info) {
			$this->button->addHiddenInputAttribute($info['name'], $info['value']);
		}
		$this->button->setText(Texts::formatDate($this->getValue()));
		$this->button->setIcon('calendar-1');
		$this->button->setOnClick('ant_inputDate_start(this)');
		$this->button->addHiddenInputAttribute('data-validate', $this->getValidation());
		$this->button->addAttribute('data-label', $this->getLabelText());
		$this->button->addAttribute('data-today', self::$todayValue);
		$this->button->addTextAttribute('today', 'TODAY');
		$this->button->addAttribute('data-language', Globals::getLanguage());
		if ($this->displayToday) {
			$this->button->addAttribute('data-show-today', 'yes');
		} else {
			$this->button->addAttribute('data-show-today', 'no');
		}
		$this->button->addAttribute('data-undefined-date', Globals::getUndefinedDate());
		$this->button->addTextAttribute('undefined', 'DOES_NOT_MATTER');
		if ($this->displayUndefined) {
			$this->button->addAttribute('data-show-undefined', 'yes');
		} else {
			$this->button->addAttribute('data-show-undefined', 'no');
		}
		$this->button->addHiddenInputAttribute(
			'data-visible-element-id', $this->button->getHtmlId()
		);
		$this->button->addHiddenInputAttribute('data-pre', $this->beforeCallback);
		$this->button->addHiddenInputAttribute('data-post', $this->afterCallback);
		if ($this->exportJavascript()) {
			$this->button->addHiddenInputAttribute('data-validate', $this->getValidation());
		}
		$this->setHtmlCode($this->button->getHtml());
		// checking if the destination file exists in cache
		$ajaxFile = Internals::getCachePath('date.php');
		if (!is_file($ajaxFile)) {
			// destination file does not exists
			$content = '<?php require_once(\''.dirname(__DIR__, 2).'/Scripts/Ajax/date.php\'); ?>';
			file_put_contents($ajaxFile, $content);
		}
		return parent::getHtml();
	}
}
?>