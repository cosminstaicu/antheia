<?php
namespace Antheia\Antheia\Classes\Header\TopRightMenu;
use Antheia\Antheia\Classes\Texts;
/**
 * A menu with the select text and symbol
 * @author Cosmin Staicu
 */
class TopRightMenuSelect extends AbstractTopRightMenu {
	public function __construct() {
		parent::__construct();
		$this->setName(Texts::get('SELECT'));
		$this->setIcon('list');
	}
}
?>
