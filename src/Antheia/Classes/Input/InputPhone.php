<?php
namespace Antheia\Antheia\Classes\Input;
/**
 * An phone type input
 * @author Cosmin Staicu
 */
class InputPhone extends AbstractInputText {
	public function __construct() {
		parent::__construct();
		$this->setType(self::TYPE_PHONE);
		$this->setIcon('phone');
	}
}
?>