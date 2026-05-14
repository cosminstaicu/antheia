<?php
namespace Antheia\Framework\Menu\Item;
use Antheia\Framework\Texts;
/**
 * A menu that can be customised
 * @author Cosmin Staicu
 */
class MenuCustom extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('UNDEFINED'));
		$this->setIcon('triangle-alert');
	}
}
?>
