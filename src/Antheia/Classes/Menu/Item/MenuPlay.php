<?php
namespace Antheia\Antheia\Classes\Menu\Item;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
/**
 * A menu with the update icon
 * @author Cosmin Staicu
 */
class MenuPlay extends AbstractMenu {
	public function __construct() {
		parent::__construct();
		$this->setText(Texts::get('PLAYBACK'));
		$this->setIcon(IconVector::ICON_PLAY);
	}
}
?>