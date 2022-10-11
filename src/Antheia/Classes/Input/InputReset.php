<?php
namespace Antheia\Antheia\Classes\Input;
/**
 * A reset form values button
 * @author Cosmin Staicu
 */
class InputReset extends AbstractInputButton {
	public function __construct() {
		parent::__construct();
		$this->setButtonType(self::TYPE_RESET);
	}
}
?>