<?php
namespace Cosmin\Antheia\Classes\Menu\Item;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * A menu with the copy icon
 * @author Cosmin Staicu
 */
class MenuCopy extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('COPY'));
		$this->setIcon(IconVector::ICON_COPY);
	}
}
?>