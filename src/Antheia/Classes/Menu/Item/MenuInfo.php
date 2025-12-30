<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Texts;
/**
 * A menu with the info icon
 * @author Cosmin Staicu
 */
class MenuInfo extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('INFO_PAGE'));
		$this->setIcon('info');
	}
}
?>