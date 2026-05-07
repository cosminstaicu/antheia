<?php
namespace Antheia\Framework\Classes\FixedButton;
use Antheia\Framework\Classes\Texts;
/**
 * A fixed button with the refresh symbol
 * @author Cosmin Staicu
 */
class FixedButtonUpdate extends AbstractFixedButton {
	public function __construct() {
		parent::__construct();
		$this->setIcon('refresh-ccw');
		$this->setTitle(Texts::get('REFRESH'));
		$this->setTestId('fixed-button-update');
	}
}
?>
