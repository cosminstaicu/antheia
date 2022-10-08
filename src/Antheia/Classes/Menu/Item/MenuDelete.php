<?php
namespace Cosmin\Antheia\Classes\Menu\Item;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * A menu with the delete icon
 * @author Cosmin Staicu
 */
class MenuDelete extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('DELETE'));
		$this->setIcon(IconVector::ICON_DELETE);
	}
}
?>