<?php
namespace Antheia\Framework\Classes\Search;
use Antheia\Framework\Classes\Menu\Item\AbstractMenu;
/**
 * A button that can be inserted into the search option bar, on the right side
 * @author Cosmin Staicu
 */
class SearchOptionBarButton extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setIcon('plus');
	}
}
?>
