<?php
namespace Antheia\Framework\Menu\Item;
use Antheia\Framework\Texts;
/**
 * A menu with the delete icon
 * @author Cosmin Staicu
 */
class MenuDelete extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('DELETE'));
		$this->setIcon('trash');
	}
}
?>
