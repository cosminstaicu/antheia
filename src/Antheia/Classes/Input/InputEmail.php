<?php
namespace Antheia\Antheia\Classes\Input;
/**
 * An input for entering an email address
 * @author Cosmin Staicu
 */
class InputEmail extends AbstractInputText {
	public function __construct() {
		parent::__construct();
		$this->setType(self::TYPE_EMAIL);
		$this->setIcon('at-sign');
	}
}
?>