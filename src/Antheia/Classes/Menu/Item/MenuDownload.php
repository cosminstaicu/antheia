<?php
namespace Cosmin\Antheia\Classes\Menu\Item;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * A menu with the download icon
 * @author Cosmin Staicu
 */
class MenuDownload extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('DOWNLOAD'));
		$this->setIcon(IconVector::ICON_DOWNLOAD);
	}
}
?>