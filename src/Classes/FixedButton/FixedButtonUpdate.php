<?php
namespace Antheia\Framework\FixedButton;
use Antheia\Framework\Texts;
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
