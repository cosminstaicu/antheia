<?php
namespace Cosmin\Antheia\Classes\Theme;
/**
 * Retro Orange and Gray theme
 * https://www.schemecolor.com/retro-orange-and-grays.php
 * @author Cosmin Staicu
 */
class ThemeRetroOrangeGray extends AbstractTheme {
	public function __construct() {
		parent::__construct();
		$this->setName('Retro orange and gray');
		$this->setDescription('');
		$this->setWarning('#ff0000');
		$this->setLink('#0000ee');
		$this->setLinkHover('#0000aa');
		$this->setText('#000000');
		$this->setShadow('#999999');
		$this->setValid('#009900');
		$this->setTopBottomBarText('#ffffff');
		$this->setTopBottomBarBackground('#404040');
		$this->setMenuText('#ffffff');
		$this->setMenuBackground('#404040');
		$this->setHeaderText('#000000');
		$this->setHeaderBackground('#ffe4d6');
		$this->setTabText('#555555');
		$this->setTabBackground('#ffffff');
		$this->setBackground('#ffc3a3');
		$this->setInputBorder('#555555');
		$this->setInputIcon('#8b8680');
		$this->setInputBackground('#ffffff');
		$this->setInputText('#000000');
		$this->setInputLabel('#000000');
		$this->setButtonBackground('#555555');
		$this->setButtonBackgroundHover('#9c351c');
		$this->setButtonText('#ffeee5');
		$this->setPanelTitle('#000000');
		$this->setPanelBorder('#555555');
		$this->setPanelBackground('#fff8f5');
		$this->setPanelSecondaryBackground('#fde5d8');
		$this->setLoadingBackdrop(AbstractTheme::LOADING_BACKDROP_SIMPLE);
		$this->setLoadingA('#ff6e4a');
		$this->setLoadingB('#ffc9ad');
		$this->setLoadingStepBackground('#ffeee5');
		$this->setLoadingStepText('#000000');
		$this->setLoadingStepBorder('#ff6e4a');
		$this->setLoadingProgressLeft('#cccccc');
		$this->setLoadingProgressRight('#ffffff');
	}
}
?>