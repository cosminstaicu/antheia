<?php
namespace Antheia\Antheia\Classes\FixedButton;
use Antheia\Antheia\Classes\Texts;
/**
 * A fixed button with the upload symbol
 * @author Cosmin Staicu
 */
class FixedButtonUpload extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon('upload');
		$this->setTitle(Texts::get('UPLOAD'));
		$this->setTestId('fixed-button-upload');
	}
}
?>
