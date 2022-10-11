<?php
namespace Antheia\Antheia\Classes\Header\TopRightMenu;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Texts;
/**
 * A menu with the language text and symbol
 * @author Cosmin Staicu
 */
class TopRightMenuLanguage extends AbstractTopRightMenu {
	public function __construct() {
		parent::__construct();
		$this->setIcon(IconVector::ICON_LANGUAGE);
		$this->setName(Texts::get('LANGUAGE'));
	}
}
?>