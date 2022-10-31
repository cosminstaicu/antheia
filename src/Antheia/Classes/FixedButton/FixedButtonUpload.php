<?php
namespace Antheia\Antheia\Classes\FixedButton;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
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