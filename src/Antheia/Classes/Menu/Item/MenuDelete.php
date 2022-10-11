<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
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