<?php
namespace Antheia\Antheia\Classes\Theme;
/**
 * The Raven, by Arthur
 * @author Cosmin Staicu
 */
class ThemeTheRaven extends AbstractTheme {
	public function __construct() {
		parent::__construct();
		$this->setName('The Raven');
		$this->setDescription(
			'Once upon a midnight dreary, while I pondered, weak and weary,'
			."\nOver many a quaint and curious volume of forgotten lore—"
			."\nWhile I nodded, nearly napping, suddenly there came a tapping,'"
			."\nAs of someone gently rapping, rapping at my chamber door."
			."\n“’Tis some visitor,” I muttered, “tapping at my chamber door—"
			."\nOnly this and nothing more.”"
		);
		$this->setBackground('#000000');
		$this->setButtonBackground('#646464');
		$this->setButtonBackgroundHover('#646464');
		$this->setButtonText('#ffffff');
		$this->setHeaderBackground('#000000');
		$this->setHeaderText('#ffffff');
		$this->setInputBackground('#000000');
		$this->setInputBorder('#fdfdfd');
		$this->setInputIcon('#ffffff');
		$this->setInputLabel('#ffffff');
		$this->setInputText('#ffffff');
		$this->setLink('#ffffff');
		$this->setLinkHover('#ffffff');
		$this->setLoadingA('#ffffff');
		$this->setLoadingB('#646464');
		$this->setLoadingBackdrop(AbstractTheme::LOADING_BACKDROP_BLUR);
		$this->setLoadingProgressLeft('#323232');
		$this->setLoadingProgressRight('#646464');
		$this->setLoadingStepBackground('#000000');
		$this->setLoadingStepBorder('#ffffff');
		$this->setLoadingStepText('#ffffff');
		$this->setMenuBackground('#000000');
		$this->setMenuText('#ffffff');
		$this->setPanelBackground('#000000');
		$this->setPanelBorder('#ffffff');
		$this->setPanelSecondaryBackground('#000000');
		$this->setPanelTitle('#ffffff');
		$this->setShadow('#646464');
		$this->setTabBackground('#000000');
		$this->setTabText('#ffffff');
		$this->setText('#ffffff');
		$this->setThreeLineButton('#ffffff');
		$this->setThreeLineButtonHover('#ffffff');
		$this->setTopBottomBarBackground('#000000');
		$this->setTopBottomBarText('#ffffff');
		$this->setValid('#009900');
		$this->setWarning('#df0000');
	}
}
?>