<?php
namespace Cosmin\Antheia\Classes\FixedButton;
use Cosmin\Antheia\Classes\Icon\IconVector;
use Cosmin\Antheia\Classes\Texts;
/**
 * A fixed button with the download symbol
 * @author Cosmin Staicu
 */
class FixedButtonDownload extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_DOWNLOAD);
		$this->setTitle(Texts::get('DOWNLOAD'));
	}
}
?>