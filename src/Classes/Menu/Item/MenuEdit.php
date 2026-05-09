<?php
namespace Antheia\Framework\Menu\Item;
use Antheia\Framework\Texts;
/**
 * A menu with the edit icon
 * @author Cosmin Staicu
 */
class MenuEdit extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('EDIT'));
		$this->setIcon('pencil');
	}
}
?>
