<?php
namespace Antheia\Antheia\Classes\Theme;
/**
 * Soft and warm theme
 * https://www.schemecolor.com/soft-and-warm.php
 * @author Cosmin Staicu
 */
class ThemeSoftWarm extends AbstractTheme {
	public function __construct() {
		parent::__construct();
		$this->setName('Soft and warm');
		$this->setDescription(
			'The sweetness of a powerful perfume that tempts you in a call of longing.'
		);
		$this->setWarning('#ff0000');
		$this->setLink('#0000ee');
		$this->setLinkHover('#0000aa');
		$this->setText('#000000');
		$this->setShadow('#95706a');
		$this->setValid('#009900');
		$this->setTopBottomBarText('#fffdf2');
		$this->setTopBottomBarBackground('#6e5753');
		$this->setThreeLineButton('#a27d76');
		$this->setThreeLineButtonHover('#6e5753');
		$this->setMenuText('#ffffff');
		$this->setMenuBackground('#6e5753');
		$this->setHeaderText('#000000');
		$this->setHeaderBackground('#fffdf2');
		$this->setTabText('#6e5753');
		$this->setTabBackground('#fffdf2');
		$this->setBackground('#f7bbb2');
		$this->setInputBorder('#f7bbb2');
		$this->setInputIcon('#c3958d');
		$this->setInputBackground('#ffffff');
		$this->setInputText('#000000');
		$this->setInputLabel('#000000');
		$this->setButtonBackground('#a27d76');
		$this->setButtonBackgroundHover('#6e5753');
		$this->setButtonText('#fffdf2');
		$this->setPanelTitle('#000000');
		$this->setPanelBorder('#f7bbb2');
		$this->setPanelBackground('#fffdf2');
		$this->setPanelSecondaryBackground('#fff6d4');
		$this->setLoadingBackdrop(AbstractTheme::LOADING_BACKDROP_SIMPLE);
		$this->setLoadingA('#d87979');
		$this->setLoadingB('#fffdf2');
		$this->setLoadingStepBackground('#fffdf2');
		$this->setLoadingStepText('#000000');
		$this->setLoadingStepBorder('#f7bbb2');
		$this->setLoadingProgressLeft('#fbdad5');
		$this->setLoadingProgressRight('#fff6d4');
	}
}
?>
