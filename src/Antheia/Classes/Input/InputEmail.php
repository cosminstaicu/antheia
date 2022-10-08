<?php
namespace Cosmin\Antheia\Classes\Input;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * An input for entering an email address
 * @author Cosmin Staicu
 */
class InputEmail extends AbstractInputText {
	public function __construct() {
		parent::__construct();
		$this->setType(self::TYPE_EMAIL);
		$this->setIcon(IconVector::ICON_EMAIL);
	}
}
?>