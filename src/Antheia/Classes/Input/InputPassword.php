<?php
namespace Cosmin\Antheia\Classes\Input;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * An password type input
 * @author Cosmin Staicu
 */
class InputPassword extends AbstractInputText {
	public function __construct() {
		parent::__construct();
		$this->setType(self::TYPE_PASSWORD);
		$this->setIcon(IconVector::ICON_PASSWORD);
	}
}
?>