<?php
namespace Cosmin\Antheia\Classes\Input;
use Cosmin\Antheia\Classes\Texts;
/**
 * A submit button that can be inserted into a form
 * @author Cosmin Staicu
 */
class InputSubmit extends AbstractInputButton {
	/**
	 * The class contructor
	 * @param string $value (optional) the text to be displayed on the button
	 */
	public function __construct(string $value = NULL) {
		parent::__construct();
		$this->setButtonType(self::TYPE_SUBMIT);
		if ($value === NULL) {
			$this->setText(Texts::get('SUBMIT'));
		} else {
			$this->setText($value);
		}
	}
}
?>