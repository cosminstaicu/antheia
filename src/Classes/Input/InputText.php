<?php
namespace Antheia\Framework\Input;
/**
 * A regular text type input
 * @author Cosmin Staicu
 */
class InputText extends AbstractInputText {
	public function __construct() {
		parent::__construct();
		$this->setType(self::TYPE_TEXT);
	}
}
?>
