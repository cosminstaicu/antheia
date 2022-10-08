<?php
namespace Cosmin\Antheia\Classes\Input;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * An phone type input
 * @author Cosmin Staicu
 */
class InputPhone extends AbstractInputText {
	public function __construct() {
		parent::__construct();
		$this->setType(self::TYPE_PHONE);
		$this->setIcon(IconVector::ICON_PHONE);
	}
}
?>