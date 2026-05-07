<?php
namespace Antheia\Framework\Classes\Menu\Item;
use Antheia\Framework\Classes\Texts;
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
