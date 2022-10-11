<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
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