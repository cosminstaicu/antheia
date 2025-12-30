<?php
namespace Antheia\Antheia\Classes\Header\TopRightMenu;
use Antheia\Antheia\Classes\Texts;
/**
 * A menu with the logout text and symbol
 * @author Cosmin Staicu
 */
class TopRightMenuExit extends AbstractTopRightMenu {
	public function __construct() {
		parent::__construct();
		$this->setName(Texts::get('LOGOUT'));
		$this->setIcon('log-out');
	}
}
?>