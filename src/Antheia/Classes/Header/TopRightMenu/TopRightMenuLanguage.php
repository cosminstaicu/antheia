<?php
namespace Cosmin\Antheia\Classes\Header\TopRightMenu;
use Cosmin\Antheia\Classes\Icon\IconVector;
use Cosmin\Antheia\Classes\Texts;
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