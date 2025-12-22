<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Texts;
/**
 * A menu with the close icon
 * @author Cosmin Staicu
 */
class MenuClose extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('CLOSE'));
		$this->setIcon('x');
	}
}
?>