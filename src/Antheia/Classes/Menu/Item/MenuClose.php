<?php
namespace Cosmin\Antheia\Classes\Menu\Item;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * A menu with the close icon
 * @author Cosmin Staicu
 */
class MenuClose extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('CLOSE'));
		$this->setIcon(IconVector::ICON_CLOSE);
	}
}
?>