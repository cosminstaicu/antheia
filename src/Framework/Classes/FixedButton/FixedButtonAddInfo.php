<?php
namespace Antheia\Framework\Classes\FixedButton;
use Antheia\Framework\Classes\Texts;
/**
 * A fixed button with the add info symbol
 * @author Cosmin Staicu
 */
class FixedButtonAddInfo extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon('file-plus-corner');
		$this->setTitle(Texts::get('ADD_INFO'));
		$this->setTestId('fixed-button-add-info');
	}
}
?>
