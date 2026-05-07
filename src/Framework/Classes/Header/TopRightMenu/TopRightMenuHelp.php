<?php
namespace Antheia\Framework\Classes\Header\TopRightMenu;
use Antheia\Framework\Classes\Texts;
/**
 * A menu with the help text and symbol
 * @author Cosmin Staicu
 */
class TopRightMenuHelp extends AbstractTopRightMenu {
	public function __construct() {
		parent::__construct();
		$this->setName(Texts::get('HELP'));
		$this->setIcon('circle-question-mark');
	}
}
?>
