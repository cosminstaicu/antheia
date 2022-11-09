<?php
namespace Antheia\Antheia\Classes\Theme;
/**
 * Warm Rustic theme
 * https://www.schemecolor.com/warm-rustic-color-palette.php
 * @author Cosmin Staicu
 */
class ThemeWarmRustic extends AbstractTheme {
	public function __construct() {
		parent::__construct();
		$this->setName('Warm Rustic');
		$this->setDescription(
			'Sand washed up on a wounded shore, when all the dust in the air '
			.'flew away and remained only a carpet of wind and rain.'
		);
		$this->setWarning('#fa0000');
		$this->setLink('#2a3bbb');
		$this->setLinkHover('#1d2b95');
		$this->setText('#000000');
		$this->setShadow('#404040');
		$this->setValid('#028000');
		$this->setTopBottomBarText('#ffffff');
		$this->setTopBottomBarBackground('#885e4b');
		$this->setMenuText('#ffffff');
		$this->setMenuBackground('#654639');
		$this->setHeaderText('#000000');
		$this->setHeaderBackground('#ffffff');
		$this->setTabText('#934c47');
		$this->setTabBackground('#e1d6cb');
		$this->setBackground('#ceb9a5');
		$this->setInputBorder('#ceb9a5');
		$this->setInputIcon('#a96e6c');
		$this->setInputBackground('#ffffff');
		$this->setInputText('#000000');
		$this->setInputLabel('#000000');
		$this->setButtonBackground('#934c47');
		$this->setButtonBackgroundHover('#a96e6c');
		$this->setButtonText('#e5ddd5');
		$this->setPanelTitle('#000000');
		$this->setPanelBorder('#6b6b6b');
		$this->setPanelBackground('#f1ede9');
		$this->setPanelSecondaryBackground('#d7d1cb');
		$this->setLoadingBackdrop(AbstractTheme::LOADING_BACKDROP_BLUR);
		$this->setLoadingA('#885e4b');
		$this->setLoadingB('#ceb9a5');
		$this->setLoadingStepBackground('#e5ddd5');
		$this->setLoadingStepText('#000000');
		$this->setLoadingStepBorder('#934c47');
		$this->setLoadingProgressLeft('#c39f97');
		$this->setLoadingProgressRight('#ceb9a5');
	}
}
?>