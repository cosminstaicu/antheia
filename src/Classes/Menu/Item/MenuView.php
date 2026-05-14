<?php
namespace Antheia\Framework\Menu\Item;
use Antheia\Framework\Texts;
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
