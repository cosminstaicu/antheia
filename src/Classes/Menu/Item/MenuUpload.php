<?php
namespace Antheia\Framework\Menu\Item;
use Antheia\Framework\Texts;
/**
 * A menu with the upload icon
 * @author Cosmin Staicu
 */
class MenuUpload extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('UPLOAD'));
		$this->setIcon('upload');
	}
}
?>
