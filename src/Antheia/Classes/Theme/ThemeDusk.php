<?php
namespace Cosmin\Antheia\Classes\Theme;
/**
 * Dusk theme
 * https://www.schemecolor.com/gradient-at-dusk.php
 * @author Cosmin Staicu
 */
class ThemeDusk extends AbstractTheme {
	public function __construct() {
		parent::__construct();
		$this->setName('Gradient at Dusk');
		$this->setDescription('');
		$this->setWarning('#ff0000');
		$this->setLink('#0000ee');
		$this->setLinkHover('#0000aa');
		$this->setText('#000000');
		$this->setShadow('#78496d');
		$this->setValid('#009900');
		$this->setTopBottomBarText('#fdf7ec');
		$this->setTopBottomBarBackground('#3d3157');
		$this->setMenuText('#ffeccc');
		$this->setMenuBackground('#29203c');
		$this->setHeaderText('#3d3157');
		$this->setHeaderBackground('#fff9f0');
		$this->setTabText('#3d3157');
		$this->setTabBackground('#fff9f0');
		$this->setBackground('#ffd9bd');
		$this->setInputBorder('#3d3157');
		$this->setInputIcon('#78496d');
		$this->setInputBackground('#ffffff');
		$this->setInputText('#000000');
		$this->setInputLabel('#000000');
		$this->setButtonBackground('#78496d');
		$this->setButtonBackgroundHover('#3d3157');
		$this->setButtonText('#ffeccc');
		$this->setPanelTitle('#000000');
		$this->setPanelBorder('#784a5f');
		$this->setPanelBackground('#fdf7ec');
		$this->setPanelSecondaryBackground('#f7eede');
		$this->setLoadingBackdrop(AbstractTheme::LOADING_BACKDROP_BLUR);
		$this->setLoadingA('#3d3157');
		$this->setLoadingB('#ffeccc');
		$this->setLoadingStepBackground('#baffff');
		$this->setLoadingStepText('#000000');
		$this->setLoadingStepBorder('#3d3157');
		$this->setLoadingProgressLeft('#fdc295');
		$this->setLoadingProgressRight('#ffeccc');
	}
}
?>