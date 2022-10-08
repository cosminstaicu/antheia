<?php
namespace Cosmin\Antheia\Classes\Search;
use Cosmin\Antheia\Classes\Menu\Item\AbstractMenu;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * A button that can be inserted into the search option bar, on the right side
 * @author Cosmin Staicu
 */
class SearchOptionBarButton extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_ADD);
	}
}
?>