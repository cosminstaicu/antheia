<?php
namespace Cosmin\Antheia\Classes\Header\TopRightMenu;
use Cosmin\Antheia\Classes\Icon\IconVector;
use Cosmin\Antheia\Classes\Texts;
/**
 * A menu with the settings text and symbol
 * @author Cosmin Staicu
 */
class TopRightMenuSettings extends AbstractTopRightMenu {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_SETTINGS);
		$this->setName(Texts::get('SETTINGS'));
	}
}
?>