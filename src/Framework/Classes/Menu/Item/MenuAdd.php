<?php
namespace Antheia\Framework\Classes\Menu\Item;
use Antheia\Framework\Classes\Texts;
/**
 * A menu with the add icon
 * @author Cosmin Staicu
 */
class MenuAdd extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('ADD'));
		$this->setIcon('plus');
	}
}
?>
