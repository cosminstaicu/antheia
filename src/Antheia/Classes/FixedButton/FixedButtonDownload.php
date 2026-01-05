<?php
namespace Antheia\Antheia\Classes\FixedButton;
use Antheia\Antheia\Classes\Texts;
/**
 * A fixed button with the download symbol
 * @author Cosmin Staicu
 */
class FixedButtonDownload extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon('download');
		$this->setTitle(Texts::get('DOWNLOAD'));
		$this->setTestId('fixed-button-download');
	}
}
?>
