<?php
namespace Antheia\Antheia\Classes\Page;
use Antheia\Antheia\Classes\Header\Tabs\HeaderTab;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Theme\AbstractTheme;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Menu\Item\MenuUpdate;
use Antheia\Antheia\Classes\Input\InputSelect;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Input\InputTextarea;
use Antheia\Antheia\Classes\Input\InputColor;
use Antheia\Antheia\Classes\Input\InputButton;
use Antheia\Antheia\Classes\Accordion\Accordion;
use Antheia\Antheia\Classes\Input\InputInfo;
use Antheia\Antheia\Classes\Input\InputText;
use Antheia\Antheia\Classes\Input\InputDate;
use Antheia\Antheia\Classes\Input\InputTime;
use Antheia\Antheia\Classes\Input\InputCustomButton;
use Antheia\Antheia\Classes\Icon\IconVector;
/**
 * Defines a page to edit a framework theme
 * @author Cosmin Staicu
 */
class PageEditTheme extends PageEmpty {
	private $theme;
	private $templates;
	public function __construct() {
		parent::__construct();
		$this->theme = null;
		$tab = new HeaderTab();
		$tab->setTitle(Texts::get('SETTINGS'));
		$tab->setStatus($tab::STATUS_SELECTED);
		$tab->setHtmlId('ant-tab-edit');
		$tab->setHref('javascript:ant_theme_showSettingsTab()');
		$this->addTab($tab);
		$tab = new HeaderTab();
		$tab->setTitle(Texts::get('PREVIEW'));
		$tab->setHtmlId('ant-tab-view');
		$tab->setHref('javascript:ant_theme_showViewTab()');
		$this->addTab($tab);
		$this->templates = [];
		foreach (AbstractTheme::getThemes() as $name) {
			$className = '\Antheia\Antheia\Classes\Theme\Theme'.$name;
			$this->templates[] = new $className();
		}
	}
	/**
	 * Adds a theme to be used as a template
	 * @param AbstractTheme $theme the added theme
	 */
	public function addTemplate(AbstractTheme $theme):void {
		$this->templates[] = $theme;
	}
	/**
	 * Defines the theme being edited
	 * @param AbstractTheme $theme the theme being edited
	 */
	public function setTheme(AbstractTheme $theme):void {
		$this->theme = $theme;
	}
	public function getHtml():string {
		if ($this->theme === null) {
			throw new Exception('setTheme');
		}
		$this->setTitle($this->theme->getName());
		$exampleMenu = new MenuUpdate();
		$exampleMenu->setText(Texts::get('LOAD_THEME'));
		$exampleMenu->setHref('javascript:ant_theme_showAvailableThemes()');
		$this->addPageMenu($exampleMenu);
		$selectTheme = new InputSelect();
		$selectTheme->setLabel(Texts::get('THEME'));
		$selectTheme->setNameId('ant-load-theme');
		$selectTheme->getButton()->setHtmlId('ant-theme-select');
		$selectTheme->setAfterCallback('ant_theme_predefinedThemeSelected');
		$javascript = "var ant_theme_templates = [];";
		/**
		 * @var AbstractTheme $theme
		 */
		foreach ($this->templates as $index => $theme) {
			$selectTheme->addOption($theme->getName(), $index);
			$properties = '';
			foreach ($theme->exportArray() as $property => $value) {
				if ($properties !== '') {
					$properties .= ',';
				}
				$properties .= $property.':"'.$value.'"';
			}
			$javascript .= 'ant_theme_templates.push({'.$properties.'});';
		}
		$this->addJavascript($javascript);
		$this->addElement(new Html('<div style="display:none">'));
		$this->addElement($selectTheme);
		$this->addElement(new Html('</div>'));
		// ********************************************************************* EDIT
		$wireframe = $this->addWireframe();
		$wireframe->setHtmlId('ant-edit-wireframe');
		$wireframe->setType($wireframe::TYPE_FIXED);
		$row = $wireframe->addRow();
		// ************************************************** general theme info
		$cell = $row->addCell();
		$cell->addWidth('xs', 12);
		$panel = $cell->addInputPanel();
		$panel->setTitle(Texts::get('THEME_INFORMATION'));
		// name
		$input = new InputText();
		$input->setLabel(Texts::get('NAME'));
		$input->setPlaceholder(Texts::getLc('NAME'));
		$input->setNameId('ant_theme_name');
		$input->setValue($this->theme->getName());
		$input->setValidation('ant_theme_validateName');
		$panel->addInput($input);
		// description
		$input = new InputTextarea();
		$input->setLabel(Texts::get('DESCRIPTION'));
		$input->setPlaceholder(Texts::getLc('DESCRIPTION'));
		$input->setNameId('ant_theme_description');
		$input->setValue($this->theme->getDescription());
		$panel->addInput($input);
		// **************************************************** interface colors
		$cell = $row->addCell();
		$cell->addWidth('xs', 12);
		$cell->addWidth('md', 6);
		$panel = $cell->addInputPanel();
		$panel->setTitle(Texts::get('INTERFACE'));
		$panel->setFullHeight();
		// top bottom bar text
		$input = new InputColor();
		$input->setLabel(Texts::get('TOP_BOTTOM_BAR_TEXT'));
		$input->setPlaceholder(Texts::getLc('TOP_BOTTOM_BAR_TEXT'));
		$input->setNameId('ant_theme_topBottomBarText');
		$input->setValue($this->theme->getTopBottomBarText());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// top bottom bar background
		$input = new InputColor();
		$input->setLabel(Texts::get('TOP_BOTTOM_BAR_BACKGROUND'));
		$input->setPlaceholder(Texts::getLc('TOP_BOTTOM_BAR_BACKGROUND'));
		$input->setNameId('ant_theme_topBottomBarBackground');
		$input->setValue($this->theme->getTopBottomBarBackground());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// menu text
		$input = new InputColor();
		$input->setLabel(Texts::get('MENU_TEXT'));
		$input->setPlaceholder(Texts::getLc('MENU_TEXT'));
		$input->setNameId('ant_theme_menuText');
		$input->setValue($this->theme->getMenuText());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// menu background
		$input = new InputColor();
		$input->setLabel(Texts::get('MENU_BACKGROUND'));
		$input->setPlaceholder(Texts::getLc('MENU_BACKGROUND'));
		$input->setNameId('ant_theme_menuBackground');
		$input->setValue($this->theme->getMenuBackground());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// page title
		$input = new InputColor();
		$input->setLabel(Texts::get('PAGE_TITLE'));
		$input->setPlaceholder(Texts::getLc('PAGE_TITLE'));
		$input->setNameId('ant_theme_headerText');
		$input->setValue($this->theme->getHeaderText());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// header background
		$input = new InputColor();
		$input->setLabel(Texts::get('HEADER_BACKGROUND'));
		$input->setPlaceholder(Texts::getLc('HEADER_BACKGROUND'));
		$input->setNameId('ant_theme_headerBackground');
		$input->setValue($this->theme->getHeaderBackground());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// tab text
		$input = new InputColor();
		$input->setLabel(Texts::get('TAB_TEXT'));
		$input->setPlaceholder(Texts::getLc('TAB_TEXT'));
		$input->setNameId('ant_theme_tabText');
		$input->setValue($this->theme->getTabText());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// tab background
		$input = new InputColor();
		$input->setLabel(Texts::get('TAB_BACKGROUND'));
		$input->setPlaceholder(Texts::getLc('TAB_BACKGROUND'));
		$input->setNameId('ant_theme_tabBackground');
		$input->setValue($this->theme->getTabBackground());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// background
		$input = new InputColor();
		$input->setLabel(Texts::get('BACKGROUND'));
		$input->setPlaceholder(Texts::getLc('BACKGROUND'));
		$input->setNameId('ant_theme_background');
		$input->setValue($this->theme->getBackground());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// text
		$input = new InputColor();
		$input->setLabel(Texts::get('TEXT'));
		$input->setPlaceholder(Texts::getLc('TEXT'));
		$input->setNameId('ant_theme_text');
		$input->setValue($this->theme->getText());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// ************************************************************** panels
		$cell = $row->addCell();
		$cell->addWidth('xs', 12);
		$cell->addWidth('md', 6);
		$panel = $cell->addInputPanel();
		$panel->setTitle(Texts::get('PANEL'));
		$panel->setFullHeight();
		// title
		$input = new InputColor();
		$input->setLabel(Texts::get('TITLE'));
		$input->setPlaceholder(Texts::getLc('TITLE'));
		$input->setNameId('ant_theme_panelTitle');
		$input->setValue($this->theme->getPanelTitle());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// main background
		$input = new InputColor();
		$input->setLabel(Texts::get('BACKGROUND'));
		$input->setPlaceholder(Texts::getLc('BACKGROUND'));
		$input->setNameId('ant_theme_panelBackground');
		$input->setValue($this->theme->getPanelBackground());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// secondary background
		$input = new InputColor();
		$input->setLabel(Texts::get('SECONDARY_BACKGROUND'));
		$input->setPlaceholder(Texts::getLc('SECONDARY_BACKGROUND'));
		$input->setNameId('ant_theme_panelSecondaryBackground');
		$input->setValue($this->theme->getPanelSecondaryBackground());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// border
		$input = new InputColor();
		$input->setLabel(Texts::get('BORDER'));
		$input->setPlaceholder(Texts::getLc('BACKGROUND'));
		$input->setNameId('ant_theme_panelBorder');
		$input->setValue($this->theme->getPanelBorder());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// *************************************************************** forms
		$cell = $row->addCell();
		$cell->addWidth('xs', 12);
		$cell->addWidth('md', 6);
		$panel = $cell->addInputPanel();
		$panel->setTitle(Texts::get('FORMS'));
		$panel->setFullHeight();
		// input border
		$input = new InputColor();
		$input->setLabel(Texts::get('INPUT_BORDER'));
		$input->setPlaceholder(Texts::getLc('INPUT_BORDER'));
		$input->setNameId('ant_theme_inputBorder');
		$input->setValue($this->theme->getInputBorder());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// input icon
		$input = new InputColor();
		$input->setLabel(Texts::get('INPUT_ICON'));
		$input->setPlaceholder(Texts::getLc('INPUT_ICON'));
		$input->setNameId('ant_theme_inputIcon');
		$input->setValue($this->theme->getInputIcon());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// input background
		$input = new InputColor();
		$input->setLabel(Texts::get('INPUT_BACKGROUND'));
		$input->setPlaceholder(Texts::getLc('INPUT_BACKGROUND'));
		$input->setNameId('ant_theme_inputBackground');
		$input->setValue($this->theme->getInputBackground());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// input text
		$input = new InputColor();
		$input->setLabel(Texts::get('INPUT_TEXT'));
		$input->setPlaceholder(Texts::getLc('INPUT_TEXT'));
		$input->setNameId('ant_theme_inputText');
		$input->setValue($this->theme->getInputText());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// label text
		$input = new InputColor();
		$input->setLabel(Texts::get('INPUT_LABEL'));
		$input->setPlaceholder(Texts::getLc('INPUT_LABEL'));
		$input->setNameId('ant_theme_inputLabel');
		$input->setValue($this->theme->getInputLabel());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// button background
		$input = new InputColor();
		$input->setLabel(Texts::get('BUTTON_BACKGROUND'));
		$input->setPlaceholder(Texts::getLc('BUTTON_BACKGROUND'));
		$input->setNameId('ant_theme_buttonBackground');
		$input->setValue($this->theme->getButtonBackground());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// button hover
		$input = new InputColor();
		$input->setLabel(Texts::get('BUTTON_HOVER_BACKGROUND'));
		$input->setPlaceholder(Texts::getLc('BUTTON_HOVER_BACKGROUND'));
		$input->setNameId('ant_theme_buttonBackgroundHover');
		$input->setValue($this->theme->getButtonBackgroundHover());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// button text
		$input = new InputColor();
		$input->setLabel(Texts::get('BUTTON_TEXT'));
		$input->setPlaceholder(Texts::getLc('BUTTON_TEXT'));
		$input->setNameId('ant_theme_buttonText');
		$input->setValue($this->theme->getButtonText());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// ************************************************************* loading
		$cell = $row->addCell();
		$cell->addWidth('xs', 12);
		$cell->addWidth('md', 6);
		$panel = $cell->addInputPanel();
		$panel->setFullHeight();
		$panel->setTitle(Texts::get('LOADING'));
		// background effect
		$input = new InputSelect();
		$input->setLabel(Texts::get('BACKGROUND_EFFECT'));
		$input->setNameId('ant_theme_loadingBackdrop');
		$input->addOption(
				Texts::get('UNDEFINED'), 
				$this->theme::LOADING_BACKDROP_SIMPLE
		);
		$input->addOption(
				Texts::get('BLUR'),
				$this->theme::LOADING_BACKDROP_BLUR
		);
		$input->setValue($this->theme->getLoadingBackdrop());
		$input->setInlineHelpText(Texts::get('BLUR_WARNING'));
		$input->setAfterCallback('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// loading A
		$input = new InputColor();
		$input->setLabel(Texts::get('LOADING').' A');
		$input->setPlaceholder(Texts::getLc('LOADING').' A');
		$input->setNameId('ant_theme_loadingA');
		$input->setValue($this->theme->getLoadingA());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// loading B
		$input = new InputColor();
		$input->setLabel(Texts::get('LOADING').' B');
		$input->setPlaceholder(Texts::getLc('LOADING').' A');
		$input->setNameId('ant_theme_loadingB');
		$input->setValue($this->theme->getLoadingB());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// steps background
		$input = new InputColor();
		$input->setLabel(
			Texts::get('STEPS').': '.Texts::get('BACKGROUND')
		);
		$input->setPlaceholder(
			Texts::getLc('STEPS').': '.Texts::getLc('BACKGROUND')
		);
		$input->setNameId('ant_theme_loadingStepBackground');
		$input->setValue($this->theme->getLoadingStepBackground());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// steps border
		$input = new InputColor();
		$input->setLabel(
				Texts::get('STEPS').': '.Texts::get('BORDER')
		);
		$input->setPlaceholder(
				Texts::getLc('STEPS').': '.Texts::getLc('BORDER')
		);
		$input->setNameId('ant_theme_loadingStepBorder');
		$input->setValue($this->theme->getLoadingStepBorder());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// steps text
		$input = new InputColor();
		$input->setLabel(
			Texts::get('STEPS').': '.Texts::get('TEXT')
		);
		$input->setPlaceholder(
			Texts::get('STEPS').': '.Texts::get('TEXT')
		);
		$input->setNameId('ant_theme_loadingStepText');
		$input->setValue($this->theme->getLoadingStepText());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// steps left progress
		$input = new InputColor();
		$input->setLabel(Texts::get('STEPS_PROGRESS_LEFT'));
		$input->setPlaceholder(Texts::getLc('STEPS_PROGRESS_LEFT'));
		$input->setNameId('ant_theme_loadingProgressLeft');
		$input->setValue($this->theme->getLoadingProgressLeft());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// steps right progress
		$input = new InputColor();
		$input->setLabel(Texts::get('STEPS_PROGRESS_RIGHT'));
		$input->setPlaceholder(Texts::getLc('STEPS_PROGRESS_RIGHT'));
		$input->setNameId('ant_theme_loadingProgressRight');
		$input->setValue($this->theme->getLoadingProgressRight());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// simple loading preview
		$input = new InputButton();
		$input->setValue(Texts::get('LOADING_3_SEC'));
		$input->setOnClick('ant_theme_simpleLoadingAnimation()');
		$panel->addInput($input);
		// loading steps preview
		$input = new InputButton();
		$input->setValue(Texts::get('LOADING_STEPS'));
		$input->setOnClick('ant_theme_stepsLoadingAnimation()');
		$panel->addInput($input);
		// ******************************************************** other colors
		$cell = $row->addCell();
		$cell->addWidth('xs', 12);
		$panel = $cell->addInputPanel();
		$panel->setFullHeight();
		$panel->setTitle(Texts::get('OTHER_COLORS'));
		// link
		$input = new InputColor();
		$input->setLabel(Texts::get('LINK'));
		$input->setPlaceholder(Texts::getLc('LINK'));
		$input->setNameId('ant_theme_link');
		$input->setValue($this->theme->getLink());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// link hover
		$input = new InputColor();
		$input->setLabel(Texts::get('LINK_HOVER'));
		$input->setPlaceholder(Texts::getLc('LINK_HOVER'));
		$input->setNameId('ant_theme_linkHover');
		$input->setValue($this->theme->getLinkHover());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// valid
		$input = new InputColor();
		$input->setLabel(Texts::get('VALID'));
		$input->setPlaceholder(Texts::getLc('VALID'));
		$input->setNameId('ant_theme_valid');
		$input->setValue($this->theme->getValid());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// warning
		$input = new InputColor();
		$input->setLabel(Texts::get('WARNING'));
		$input->setPlaceholder(Texts::getLc('WARNING'));
		$input->setNameId('ant_theme_warning');
		$input->setValue($this->theme->getWarning());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// shadows
		$input = new InputColor();
		$input->setLabel(Texts::get('SHADOWS'));
		$input->setPlaceholder(Texts::getLc('SHADOWS'));
		$input->setNameId('ant_theme_shadow');
		$input->setValue($this->theme->getShadow());
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$panel->addInput($input);
		// ********************************************************************* PREVIEW
		$wireframe = $this->addWireframe();
		$wireframe->addClass('ant_theme-hidden');
		$wireframe->setHtmlId('ant-view-wireframe');
		$wireframe->setType($wireframe::TYPE_FIXED);
		$input->setOnChange('ant_theme_updateThemeFromInputs');
		$row = $wireframe->addRow();
		// ********************************************************** info panel
		$cell = $row->addCell();
		$cell->addWidth('xs', 12);
		$cell->addWidth('md', 6);
		$panel = $cell->addInfoPanel();
		$panel->setFullHeight();
		$exampleButton = new MenuUpdate();
		$exampleButton->setText(Texts::getLc('EXAMPLE'));
		$exampleButton->setHref('javascript:void(0)');
		$panel->addMenu($exampleButton);
		$panel->setTitle(Texts::get('INFORMATION'));
		$panel->addNameValue(
				'Lorem ipsum dolor', 
				'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
		);
		$acordeon = new Accordion();
		$listaTexte = [
				'Nullam augue nunc, suscipit et velit ac.',
				'Mauris eget maximus orci, a aliquet nisi.',
				'Vestibulum vitae ante imperdiet, congue ligula sed.',
				'Suspendisse non suscipit dolor.',
				'Fusce eu ex sit amet ligula euismod finibus.',
				'Quisque sollicitudin tellus id nibh pharetra bibendum. '
				.'Nunc et felis vitae metus lobortis placerat vitae pharetra quam.'
		];
		for ($counter = 0; $counter < 5; $counter++) {
			$continut = $listaTexte[$counter];
			$elementAcordeon = $acordeon->getNewItem();
			$elementAcordeon->setTitle(explode(' ', $continut)[0].'...');
			$elementAcordeon->addElement(new Html($continut));
		}
		$panel->addElement($acordeon);
		// ********************************************************** form panel
		$cell = $row->addCell();
		$cell->addWidth('xs', 12);
		$cell->addWidth('md', 6);
		$panel = $cell->addInputPanel();
		$panel->setFullHeight();
		$panel->setTitle(Texts::get('FORM_EXAMPLE'));
		// info
		$input = new InputInfo();
		$input->setLabel(Texts::get('EXAMPLE'));
		$input->setValue(Texts::get('COLOR_INPUT_EXAMPLE'));
		$panel->addInput($input);
		// text
		$input = new InputText();
		$input->setLabel(Texts::get('INVALID_INPUT'));
		$input->setPlaceholder(Texts::get('INVALID_INPUT_INFO'));
		$input->setValue(Texts::get('INVALID_INPUT_INFO'));
		$input->setValidation('ant_theme_invalid');
		$input->setInlineHelpText(Texts::get('INVALID_INPUT_INFO'));
		$panel->addInput($input);
		// date
		$input = new InputDate();
		$input->setLabel(Texts::get('VALID_INPUT'));
		$input->setValue(date('Ymd'));
		$input->setInlineHelpText(Texts::get('VALID_INPUT_INFO'));
		$input->setValidation('ant_theme_valid');
		$panel->addInput($input);
		// time - text
		$input = new InputTime();
		$input->setLabel(Texts::get('TIME'));
		$input->setValue(date('H:i'));
		$panel->addInput($input);
		// time - select
		$input = new InputTime();
		$input->setLabel(Texts::get('TIME').' ('.Texts::get('SELECT').')');
		$input->setSelectionMode();
		$input->setValue(date('H:i'));
		$panel->addInput($input);
		// select
		$input = new InputSelect();
		$input->setLabel(Texts::get('SELECT'));
		for ($counter = 1; $counter < 5; $counter++) {
			$input->addOption(Texts::get('VALUE').' '.$counter, $counter);
		}
		$panel->addInput($input);
		$input = new InputButton();
		$input->setText(Texts::get('BUTTON'));
		$input->setOnClick('ant_theme_getPhpCode()');
		$panel->addInput($input);
		// ******************************************************** action panel
		$cell = $row->addCell();
		$cell->addWidth('xs', 12);
		$panel = $cell->addInputPanel();
		$panel->setTitle(Texts::get('ANIMATIONS'));
		// loading simple
		$input = new InputCustomButton();
		$input->setIcon(IconVector::ICON_UPDATE);
		$input->setLabel(Texts::get('LOADING_3_SEC'));
		$input->setValue(Texts::get('START_ANIMATION'));
		$input->setOnClick('ant_theme_simpleLoadingAnimation()');
		$panel->addInput($input);
		// loading with steps
		$input = new InputCustomButton();
		$input->addAttribute('data-pasul', Texts::get('STEP'));
		$input->setHtmlId('butonSeIncarcaEtape');
		$input->setIcon(IconVector::ICON_UPDATE);
		$input->setLabel(Texts::get('LOADING_STEPS'));
		$input->setValue(Texts::get('START_ANIMATION'));
		$input->setOnClick('ant_theme_stepsLoadingAnimation()');
		$panel->addInput($input);
		// large confirmation message
		$input = new InputCustomButton();
		$input->setIcon(IconVector::ICON_VALID);
		$input->setLabel(Texts::get('LARGE_MESSAGE'));
		$input->setValue(Texts::get('START_ANIMATION'));
		$input->setOnClick('ant_theme_largeMessageAnimation(\'Lorem ipsum dolor\')');
		$panel->addInput($input);
		// discreet confirmation message
		$input = new InputCustomButton();
		$input->setIcon(IconVector::ICON_ON_OFF);
		$input->setLabel(Texts::get('SMALL_MESSAGE'));
		$input->setValue(Texts::get('START_ANIMATION'));
		$input->setOnClick('ant_theme_smallMessageAnimation(\'Lorem ipsum dolor\')');
		$panel->addInput($input);
		// ************************************************* enable theme script
		$this->addElement(new Html(
				'<script>ant_theme_updateThemeFromInputs()</script>'
				));
		return parent::getHtml();
	}
}
?>