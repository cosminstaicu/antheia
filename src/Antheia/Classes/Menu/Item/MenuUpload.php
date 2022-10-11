<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
/**
 * A menu with the upload icon
 * @author Cosmin Staicu
 */
class MenuUpload extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('UPLOAD'));
		$this->setIcon(IconVector::ICON_UPLOAD);
	}
}
?>