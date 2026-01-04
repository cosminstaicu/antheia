<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Texts;
/**
 * A menu with the update icon
 * @author Cosmin Staicu
 */
class MenuUpdate extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('UPDATE'));
		$this->setIcon('refresh-ccw');
	}
}
?>
