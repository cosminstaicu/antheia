<?php
namespace Cosmin\Antheia\Classes\Header\TopRightMenu;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconVector;
/**
 * A menu with the help text and symbol
 * @author Cosmin Staicu
 */
class TopRightMenuHelp extends AbstractTopRightMenu {
	public function __construct() {
		parent::__construct();
		$this->setName(Texts::get('HELP'));
		$this->setTargetBlank();
		$this->setIcon(IconVector::ICON_HELP);
	}
}
?>