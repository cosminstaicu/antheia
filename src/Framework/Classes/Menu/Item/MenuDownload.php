<?php
namespace Antheia\Framework\Classes\Menu\Item;
use Antheia\Framework\Classes\Texts;
/**
 * A menu with the download icon
 * @author Cosmin Staicu
 */
class MenuDownload extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('DOWNLOAD'));
		$this->setIcon('download');
	}
}
?>
