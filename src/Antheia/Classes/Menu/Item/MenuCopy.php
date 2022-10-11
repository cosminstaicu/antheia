<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
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