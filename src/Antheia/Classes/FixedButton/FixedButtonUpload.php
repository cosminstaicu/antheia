<?php
namespace Cosmin\Antheia\Classes\FixedButton;
use Cosmin\Antheia\Classes\Icon\IconVector;
use Cosmin\Antheia\Classes\Texts;
/**
 * A fixed button with the upload symbol
 * @author Cosmin Staicu
 */
class FixedButtonUpload extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_UPLOAD);
		$this->setTitle(Texts::get('UPLOAD'));
	}
}
?>