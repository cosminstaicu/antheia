<?php
namespace Antheia\Antheia\Classes\Header\TopRightMenu;
use Antheia\Antheia\Classes\Texts;
/**
 * A menu with the settings text and symbol
 * @author Cosmin Staicu
 */
class TopRightMenuSettings extends AbstractTopRightMenu {
	public function __construct() {
		parent::__construct();
		$this->setIcon('settings');
		$this->setName(Texts::get('SETTINGS'));
	}
}
?>
