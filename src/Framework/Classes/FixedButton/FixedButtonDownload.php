<?php
namespace Antheia\Framework\Classes\FixedButton;
use Antheia\Framework\Classes\Texts;
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
