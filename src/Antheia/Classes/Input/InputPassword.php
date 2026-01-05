<?php
namespace Antheia\Antheia\Classes\Input;
/**
 * An password type input
 * @author Cosmin Staicu
 */
class InputPassword extends AbstractInputText {
	public function __construct() {
		parent::__construct();
		$this->setType(self::TYPE_PASSWORD);
		$this->setIcon('key-round');
	}
}
?>
