<?php
namespace Antheia\Antheia\Classes\Theme;
/**
 * Dark aestetics theme
 * https://www.schemecolor.com/dark-aesthetics-2.php
 * @author Cosmin Staicu
 */
class ThemeDarkAesthetics extends AbstractTheme {
	public function __construct() {
		parent::__construct();
		$this->setName('Dark aesthetics');
		$this->setDescription(
			'Nobility and elegance meet, '
			.'complement and mingle in a forest foliage at sunset.'
		);
		$this->setWarning('#ff6666');
		$this->setLink('#d6d6ff');
		$this->setLinkHover('#bdbdff');
		$this->setText('#ffffff');
		$this->setShadow('#8f8f8f');
		$this->setValid('#00d600');
		$this->setTopBottomBarText('#ffffff');
		$this->setTopBottomBarBackground('#172c27');
		$this->setThreeLineButton('#725937');
		$this->setThreeLineButtonHover('#7e643e');
		$this->setMenuText('#ffffff');
		$this->setMenuBackground('#44302e');
		$this->setHeaderText('#ffffff');
		$this->setHeaderBackground('#44302e');
		$this->setTabText('#c9baba');
		$this->setTabBackground('#312911');
		$this->setBackground('#23463e');
		$this->setInputBorder('#44302e');
		$this->setInputIcon('#a4875e');
		$this->setInputBackground('#3e655c');
		$this->setInputText('#ffffff');
		$this->setInputLabel('#ffffff');
		$this->setButtonBackground('#725937');
		$this->setButtonBackgroundHover('#7e643e');
		$this->setButtonText('#baffff');
		$this->setPanelTitle('#f7ebd9');
		$this->setPanelBorder('#000000');
		$this->setPanelBackground('#44302e');
		$this->setPanelSecondaryBackground('#5b4643');
		$this->setLoadingBackdrop(AbstractTheme::LOADING_BACKDROP_SIMPLE);
		$this->setLoadingA('#765d5b');
		$this->setLoadingB('#ffffff');
		$this->setLoadingStepBackground('#221716');
		$this->setLoadingStepText('#ffffff');
		$this->setLoadingStepBorder('#44302e');
		$this->setLoadingProgressLeft('#613e33');
		$this->setLoadingProgressRight('#89794d');
	}
}
?>
