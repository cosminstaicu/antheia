<?php
namespace Antheia\Antheia\Classes\Input;
/**
 * A simple button
 * @author Cosmin Staicu
 */
class InputButton extends AbstractInputButton {
	public function __construct() {
		parent::__construct();
		$this->setButtonType(self::TYPE_BUTTON);
	}
}
?>
