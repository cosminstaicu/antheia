<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Texts;
/**
 * A menu with the view icon
 * @author Cosmin Staicu
 */
class MenuView extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('VIEW'));
		$this->setIcon('info');
	}
}
?>
