<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
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