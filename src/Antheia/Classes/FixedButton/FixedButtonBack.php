<?php
namespace Antheia\Antheia\Classes\FixedButton;
use Antheia\Antheia\Classes\Texts;
/**
 * A fixed button with the back symbol
 * @author Cosmin Staicu
 */
class FixedButtonBack extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon('arrow-big-left');
		$this->setTitle(Texts::get('BACK'));
	}
}
?>