<?php
namespace Cosmin\Antheia\Classes\Header\TopRightMenu;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * A menu with the user symbol
 * @author Cosmin Staicu
 */
class TopRightMenuUser extends AbstractTopRightMenu {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_USER);
	}
}
?>