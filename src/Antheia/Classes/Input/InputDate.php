<?php
namespace Cosmin\Antheia\Classes\Input;
use Cosmin\Antheia\Interfaces\BeforeAfterCallback;
use Cosmin\Antheia\Classes\Globals;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
use Cosmin\Antheia\Classes\Input\Raw\InputRawCustomButton;
use Cosmin\Antheia\Classes\Internals;
/**
 * An input to select a date
 * @author Cosmin Staicu
 */
class InputDate extends AbstractInput implements BeforeAfterCallback {
	private $displayUndefined;
	private $displayToday;
	private $beforeCallback;
	private $afterCallback;
	private static $todayValue = '0';
	public function __construct() {
		parent::__construct();
		$this->displayToday = false;
		$this->displayUndefined = false;
		$this->exportForAttributeInLabel(false);
		$this->setValue(Globals::getUndefinedDate());
		if (self::$todayValue == '0') {
			self::$todayValue = date('Ymd');
		}
		$this->beforeCallback = '';
		$this->afterCallback = '';
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
		$this->checkHtmlId();
		$button = new InputRawCustomButton();
		$button->addAttribute('data-ant-type', 'date');
		$button->setHiddenInputHtmlId($this->getHtmlId());
		$button->setHiddenInputName($this->getName());
		$button->setHiddenInputValue($this->getValue());
		if ($this->getDefaultValue() !== NULL) {
			$button->addHiddenInputAttribute('data-default', $this->getDefaultValue());
		}
		foreach ($this->getAttributeList() as $info) {
			$button->addHiddenInputAttribute($info['name'], $info['value']);
		}
		$button->setText(Texts::formatDate($this->getValue()));
		$button->setIcon(IconVector::ICON_DATE);
		$button->setOnClick('ant_inputDate_start(this)');
		$button->addHiddenInputAttribute('data-validate', $this->getValidation());
		$button->addAttribute('data-label', $this->getLabelText());
		$button->addAttribute('data-today', self::$todayValue);
		$button->addTextAttribute('today', 'TODAY');
		$button->addAttribute('data-language', Globals::getLanguage());
		if ($this->displayToday) {
			$button->addAttribute('data-show-today', 'yes');
		} else {
			$button->addAttribute('data-show-today', 'no');
		}
		$button->addAttribute('data-undefined-date', Globals::getUndefinedDate());
		$button->addTextAttribute('undefined', 'DOES_NOT_MATTER');
		if ($this->displayUndefined) {
			$button->addAttribute('data-show-undefined', 'yes');
		} else {
			$button->addAttribute('data-show-undefined', 'no');
		}
		$button->addHiddenInputAttribute('data-pre', $this->beforeCallback);
		$button->addHiddenInputAttribute('data-post', $this->afterCallback);
		if ($this->exportJavascript()) {
			$button->addHiddenInputAttribute('data-validate', $this->getValidation());
		}
		$this->setHtmlCode($button->getHtml());
		// checking if the destination file exists in cache
		$ajaxFile = Internals::getCachePath('date.php');
		// unlink($ajaxFile);
		if (!is_file($ajaxFile)) {
			// destination file does not exists
			$content = '<?php require_once(\''.dirname(__DIR__, 2).'/Scripts/Ajax/date.php\'); ?>';
			file_put_contents($ajaxFile, $content);
		}
		return parent::getHtml();
	}
}
?>