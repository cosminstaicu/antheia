<?php
namespace Antheia\Framework\Classes\Menu\Item;
use Antheia\Framework\Classes\Texts;
/**
 * A menu with the update icon
 * @author Cosmin Staicu
 */
class MenuPlay extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('PLAYBACK'));
		$this->setIcon('play');
	}
}
?>
