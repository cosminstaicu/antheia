<?php
namespace Antheia\Antheia\Classes\Theme;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Texts;
/**
 * Abstract class to be extended by all classes defining themes
 * @author Cosmin Staicu
 */
abstract class AbstractTheme {
	const LOADING_BACKDROP_SIMPLE = 'simple';
	const LOADING_BACKDROP_BLUR = 'blur';
	private $auto_name;
	private $auto_description;
	private $auto_warning;
	private $auto_valid;
	private $auto_link;
	private $auto_linkHover;
	private $auto_shadow;
	private $auto_text;
	private $auto_topBottomBarText;
	private $auto_topBottomBarBackground;
	private $auto_menuText;
	private $auto_menuBackground;
	private $auto_headerText;
	private $auto_headerBackground;
	private $auto_tabText;
	private $auto_tabBackground;
	private $auto_background;
	private $auto_panelBorder;
	private $auto_panelTitle;
	private $auto_panelBackground;
	private $auto_panelSecondaryBackground;
	private $auto_inputBorder;
	private $auto_inputIcon;
	private $auto_inputBackground;
	private $auto_inputText;
	private $auto_inputLabel;
	private $auto_threeLineButton;
	private $auto_threeLineButtonHover;
	private $auto_buttonBackground;
	private $auto_buttonBackgroundHover;
	private $auto_buttonText;
	private $auto_loadingBackdrop;
	private $auto_loadingA;
	private $auto_loadingB;
	private $auto_loadingStepBackground;
	private $auto_loadingStepBorder;
	private $auto_loadingStepText;
	private $auto_loadingProgressLeft;
	private $auto_loadingProgressRight;
	public function __construct() {
		$this->auto_name = Texts::get('DEFAULT');
		$this->auto_description = '';
		// interface colors
		$this->auto_topBottomBarText = '#ffffff';
		$this->auto_topBottomBarBackground = '#3e719a';
		$this->auto_menuText = '#ffffff';
		$this->auto_menuBackground = '#192d3e';
		$this->auto_headerText = '#000000';
		$this->auto_headerBackground = '#ffffff';
		$this->auto_threeLineButton = '#337ab7';
		$this->auto_threeLineButtonHover = '#1e5d94';
		$this->auto_tabText = '#3e719a';
		$this->auto_tabBackground = '#baffff';
		$this->auto_background = '#7ce2ff';
		// panels
		$this->auto_panelBorder = '#3e719a';
		$this->auto_panelTitle = '#000000';
		$this->auto_panelBackground = '#baffff';
		$this->auto_panelSecondaryBackground = '#7ce2ff';
		// forms
		$this->auto_inputBorder = '#cccccc';
		$this->auto_inputIcon = '#999999';
		$this->auto_inputBackground = '#ffffff';
		$this->auto_inputText = '#000000';
		$this->auto_inputLabel = '#000000';
		$this->auto_buttonBackground = '#337ab7';
		$this->auto_buttonBackgroundHover = '#1e5d94';
		$this->auto_buttonText = '#baffff';
		// loading animation
		$this->auto_loadingBackdrop = self::LOADING_BACKDROP_SIMPLE;
		$this->auto_loadingA = '#3e719a';
		$this->auto_loadingB = '#ffffff';
		$this->auto_loadingStepBackground = '#baffff';
		$this->auto_loadingStepBorder = '#3e719a';
		$this->auto_loadingStepText = '#000000';
		$this->auto_loadingProgressLeft = '#cccccc';
		$this->auto_loadingProgressRight = '#ffffff';
		// general colors
		$this->auto_warning = '#ff0000';
		$this->auto_valid = '#009900';
		$this->auto_link = '#0000ee';
		$this->auto_linkHover = '#0000aa';
		$this->auto_text = '#000000';
		$this->auto_shadow = '#999999';
	}
	/**
	 * Returns the general name for all theme classes defined in the frameworl.
	 * Each returned item contains the last part of the class name (the full
	 * class name can be obtained by prefixing the value with the namespace
	 * "\Antheia\Antheia\Theme\Theme####")
	 * @return string[] a list with all available classes
	 */
	public static function getThemes():array {
		return [
			'Default',
			'DarkAesthetics',
			'Dusk',
			'TheRaven',
			'RetroOrangeGray',
			'SoftWarm',
			'WarmRustic'
		];
	}
	/**
	 * A list with all properties starting with the "auto_" prefix
	 * @return string[] a list with all properties starting with the
	 * "auto_" prefix
	 */
	private function getProperties():array {
		$list = [];
		foreach (array_keys(get_object_vars($this)) as $name) {
			if (substr($name, 0, 5) === 'auto_') {
				$list[] = $name;
			}
		}
		return $list;
	}
	/**
	 * Exports all theme properties into an array (that can be further serialised,
	 * to be saved into a database, for example)
	 * @return string[] a list with all class properties
	 */
	public function exportArray():array {
		$list = [];
		foreach ($this->getProperties() as $property) {
			$list[substr($property, 5)] = $this->$property;
		}
		return $list;
	}
	/**
	 * Imports all theme properties from an array (previously exported using
	 * the "exportArray()" method.
	 * @param $list string[] an array with the theme properties
	 */
	public function importArray(array $list):void {
		foreach ($this->getProperties() as $property) {
			if (isset($list[substr($property, 5)])) {
				$this->$property = $list[substr($property, 5)];
			}
		}
	}
	/**
	 * Returns a color using a predefined format
	 * @param string $rgb the rgb value, in hexadecimal, prefixed with #
	 * @param string $format the format for export:
	 *  - rgb : format #RRGGBB
	 *  - decimal : format [R,G,B] (decimal numeric values)
	 * @return string|number[] the returned value in the defined format
	 */
	private function getColorByFormat(string $rgb, string $format) {
		switch (strtolower($format)) {
			case 'rgb':
				return $rgb;
			case 'decimal':
				return [
					hexdec(substr($rgb, 1, 2)),
					hexdec(substr($rgb, 3, 2)),
					hexdec(substr($rgb, 5, 2))
				];
			default:
				throw new Exception('Unknown format '.$format);
		}
	}
	/**
	 * Defines the theme name
	 * @param string $name the theme name
	 */
	public function setName(string $name):void {
		$this->auto_name = $name;
	}
	/**
	 * Returns the theme name
	 * @return string the theme name
	 */
	public function getName():string {
		return $this->auto_name;
	}
	/**
	 * Defines the theme description
	 * @param string $text the theme description
	 */
	public function setDescription(string $text):void {
		$this->auto_description = $text;
	}
	/**
	 * Returns the theme description
	 * @return string the theme description
	 */
	public function getDescription():string {
		return $this->auto_description;
	}
	/**
	 * Defines the color for text inside the top and bottom bar
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setTopBottomBarText(string $color):void {
		$this->auto_topBottomBarText = $color;
	}
	/**
	 * Returns the color of the text on the top and bottom bar
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getTopBottomBarText(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_topBottomBarText, $format);
	}
	/**
	 * Defines the background of the tom and bottom bar
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setTopBottomBarBackground(string $color):void {
		$this->auto_topBottomBarBackground = $color;
	}
	/**
	 * Returns the background color  of the tom and bottom bar
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getTopBottomBarBackground(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_topBottomBarBackground, $format);
	}
	/**
	 * Defines the text color of the main menu
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setMenuText(string $color):void {
		$this->auto_menuText = $color;
	}
	/**
	 * Returns the text color of the main menu
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getMenuText(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_menuText, $format);
	}
	/**
	 * Defines the background color of the main menu
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setMenuBackground(string $color):void {
		$this->auto_menuBackground = $color;
	}
	/**
	 * Returns the background color of the main menu
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getMenuBackground(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_menuBackground, $format);
	}
	/**
	 * Defines the text color of the text inside the page header (the title)
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setHeaderText(string $color):void {
		$this->auto_headerText = $color;
	}
	/**
	 * Returns the text color of the text inside the page header (the title)
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getHeaderText(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_headerText, $format);
	}
	/**
	 * Defines the background color of the page header
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setHeaderBackground(string $color):void {
		$this->auto_headerBackground = $color;
	}
	/**
	 * Returns the background color of the page header
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getHeaderBackground(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_headerBackground, $format);
	}
	/**
	 * Defines the color of the 3 line button, used for menu toggle
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setThreeLineButton(string $color):void {
		$this->auto_threeLineButton = $color;
	}
	/**
	 * Returns the color of the 3 line button, used for menu toggle
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getThreeLineButton(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_threeLineButton, $format);
	}
	/**
	 * Defines the color of the 3 line button on hover, used for menu toggle
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setThreeLineButtonHover(string $color):void {
		$this->auto_threeLineButtonHover = $color;
	}
	/**
	 * Returns the color of the 3 line button on hover, used for menu toggle
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getThreeLineButtonHover(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_threeLineButtonHover, $format);
	}
	/**
	 * Defines the text color of the tabs
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setTabText(string $color):void {
		$this->auto_tabText = $color;
	}
	/**
	 * Returns the text color of the tabs
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getTabText(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_tabText, $format);
	}
	/**
	 * Defines the background color of the tabs
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setTabBackground(string $color):void {
		$this->auto_tabBackground = $color;
	}
	/**
	 * Returns the background color of the tabs
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getTabBackground(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_tabBackground, $format);
	}
	/**
	 * Defines the main background color
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setBackground(string $color):void {
		$this->auto_background = $color;
	}
	/**
	 * Returns the main background color
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string string|number[] the returned color value in the defined format
	 */
	public function getBackground(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_background, $format);
	}
	/**
	 * Defines the main text color
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setText(string $color):void {
		$this->auto_text = $color;
	}
	/**
	 * Returns the main text color
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string string|number[] the returned color value in the defined format
	 */
	public function getText(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_text, $format);
	}
	/**
	 * Defines the color used for warnings (probably red)
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setWarning(string $color):void {
		$this->auto_warning = $color;
	}
	/**
	 * Returns the color used for warnings (probably red)
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getWarning(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_warning, $format);
	}
	/**
	 * Defines the color used for validation (probably green)
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setValid(string $color):void {
		$this->auto_valid = $color;
	}
	/**
	 * Returns the color used for validation (probably green)
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getValid(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_valid, $format);
	}
	/**
	 * Defines the link color
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setLink(string $color):void {
		$this->auto_link = $color;
	}
	/**
	 * Returns the link color
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getLink(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_link, $format);
	}
	/**
	 * Defines the link hover color
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setLinkHover(string $color):void {
		$this->auto_linkHover = $color;
	}
	/**
	 * Returns the link hover color
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getLinkHover(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_linkHover, $format);
	}
	/**
	 * Defines the shadow color
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setShadow(string $color):void {
		$this->auto_shadow = $color;
	}
	/**
	 * Returns the shadow color
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getShadow(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_shadow, $format);
	}
	/**
	 * Defines a panel border color
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setPanelBorder(string $color):void {
		$this->auto_panelBorder = $color;
	}
	/**
	 * Returns a panel border color
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getPanelBorder(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_panelBorder, $format);
	}
	/**
	 * Defines the text color from a panel title
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setPanelTitle(string $color):void {
		$this->auto_panelTitle = $color;
	}
	/**
	 * Returns the text color from a panel title
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getPanelTitle(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_panelTitle, $format);
	}
	/**
	 * Defines the background color for a panel
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setPanelBackground(string $color):void {
		$this->auto_panelBackground = $color;
	}
	/**
	 * Returns the background color for a panel
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getPanelBackground(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_panelBackground, $format);
	}
	/**
	 * Defines a secondary background color for a container
	 * (un element care are un fundal, in interiorul unui container)
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setPanelSecondaryBackground(string $color):void {
		$this->auto_panelSecondaryBackground = $color;
	}
	/**
	 * Returns a secondary background color for a container
	 * (un element care are un fundal, in interiorul unui container)
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getPanelSecondaryBackground(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_panelSecondaryBackground, $format);
	}
	/**
	 * Defines the border color for an input form element
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setInputBorder(string $color):void {
		$this->auto_inputBorder = $color;
	}
	/**
	 * Returns the border color for an input element
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getInputBorder(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_inputBorder, $format);
	}
	/**
	 * Defines the symbol color for an input element
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setInputIcon(string $color):void {
		$this->auto_inputIcon = $color;
	}
	/**
	 * Returns the symbol color for an input form element
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getInputIcon(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_inputIcon, $format);
	}
	/**
	 * Defines the background color for an input element
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setInputBackground(string $color):void {
		$this->auto_inputBackground = $color;
	}
	/**
	 * Returns the background color for an input form element
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getInputBackground(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_inputBackground, $format);
	}
	/**
	 * Defines the text color for an input element
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setInputText(string $color):void {
		$this->auto_inputText = $color;
	}
	/**
	 * Returns the text color for an input element
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getInputText(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_inputText, $format);
	}
	/**
	 * Defines the label color for input element (the label tag)
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setInputLabel(string $color):void {
		$this->auto_inputLabel = $color;
	}
	/**
	 * Returns the label color for input element (the label tag)
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getInputLabel(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_inputLabel, $format);
	}
	/**
	 * Defines the background color for a button
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setButtonBackground(string $color):void {
		$this->auto_buttonBackground = $color;
	}
	/**
	 * Returns the background color for a button
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getButtonBackground(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_buttonBackground, $format);
	}
	/**
	 * Defines the hover background color for a button
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setButtonBackgroundHover(string $color):void {
		$this->auto_buttonBackgroundHover = $color;
	}
	/**
	 * Returns the hover background color for a button
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getButtonBackgroundHover(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_buttonBackgroundHover, $format);
	}
	/**
	 * Defines the text color for a button
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setButtonText(string $color):void {
		$this->auto_buttonText = $color;
	}
	/**
	 * Returns the text color for a button
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getButtonText(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_buttonText, $format);
	}
	/**
	 * Defines the background effect for the transparent background, when the
	 * loading animation is displayed
	 * @param string $effect the effect name, as a constant like
	 * AbstractTheme::LOADING_BACKDROP_##
	 */
	public function setLoadingBackdrop(string $effect):void {
		$this->auto_loadingBackdrop = $effect;
	}
	/**
	 * Returns the background effect for the transparent background, when the
	 * loading animation is displayed
	 * @return string the name of the effect as a constant like
	 * AbstractTheme::LOADING_BACKDROP_##
	 */
	public function getLoadingBackdrop() {
		return $this->auto_loadingBackdrop;
	}
	/**
	 * Defines the first color from the animated loading circle
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setLoadingA(string $color):void {
		$this->auto_loadingA = $color;
	}
	/**
	 * Returns the first color from the animated loading circle
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getLoadingA(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_loadingA, $format);
	}
	/**
	 * Defines the second color from the animated loading circle
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setLoadingB(string $color):void {
		$this->auto_loadingB = $color;
	}
	/**
	 * Returns the second color from the animated loading circle
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getLoadingB(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_loadingB, $format);
	}
	/**
	 * Defines the background color for the container with the loading steps
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setLoadingStepBackground(string $color):void {
		$this->auto_loadingStepBackground = $color;
	}
	/**
	 * Returns the background color for the container with the loading steps
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getLoadingStepBackground(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_loadingStepBackground, $format);
	}
	/**
	 * Defines the border color for the container with the loading steps and also
	 * the border for each step
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setLoadingStepBorder(string $color):void {
		$this->auto_loadingStepBorder = $color;
	}
	/**
	 * Defines the border color for the container with the loading steps and also
	 * the border for each step
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getLoadingStepBorder(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_loadingStepBorder, $format);
	}
	/**
	 * Defines the text color for the loading steps
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setLoadingStepText(string $color):void {
		$this->auto_loadingStepText = $color;
	}
	/**
	 * Returns the text color for the loading steps
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getLoadingStepText(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_loadingStepText, $format);
	}
	/**
	 * Defines the background color for the left side of the progress bar
	 * (the completed area)
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setLoadingProgressLeft(string $color):void {
		$this->auto_loadingProgressLeft = $color;
	}
	/**
	 * Returns the background color for the left side of the progress bar
	 * (the completed area)
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getLoadingProgressLeft(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_loadingProgressLeft, $format);
	}
	/**
	 * Defines the background color for the right side of the progress bar
	 * (the uncompleted area)
	 * @param string $color the HTML color value (#RRGGBB)
	 */
	public function setLoadingProgressRight(string $color):void {
		$this->auto_loadingProgressRight = $color;
	}
	/**
	 * Returns the background color for the right side of the progress bar
	 * (the uncompleted area)
	 * @param string $format (optional) (default rgb) the format used
	 * for returning the color (rgb, decimal)
	 * @return string|number[] the returned color value in the defined format
	 */
	public function getLoadingProgressRight(string $format = 'rgb') {
		return $this->getColorByFormat($this->auto_loadingProgressRight, $format);
	}
}
?>