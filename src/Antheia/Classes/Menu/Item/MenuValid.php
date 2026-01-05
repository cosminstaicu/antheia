<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Texts;
/**
 * A menu with the valid icon
 * @author Cosmin Staicu
 */
class MenuValid extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('SUBMIT'));
		$this->setIcon('check');
	}
}
?>
