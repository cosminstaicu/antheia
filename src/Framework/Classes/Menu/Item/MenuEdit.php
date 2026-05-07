<?php
namespace Antheia\Framework\Classes\Menu\Item;
use Antheia\Framework\Classes\Texts;
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
