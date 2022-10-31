<?php
namespace Antheia\Antheia\Classes\Search;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Menu\Item\AbstractMenu;
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