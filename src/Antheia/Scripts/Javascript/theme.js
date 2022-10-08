/**
 * Updates the page theme with a new one
 * @param {Object} theme an object that contains the theme properties
 */
function jsf_theme_update(theme) {
	jsf_theme_properties.forEach(function (p) {
		document.querySelector(':root').style.setProperty('--jsf-theme-' + p, theme[p]);
	});
}
// ******************************************** used only in the edit theme page
let jsf_theme_step1 = null;
let jsf_theme_step2 = null;
let jsf_theme_step3 = null;
let jsf_theme_properties = [
	"background",
	"buttonBackground",
	"buttonBackgroundHover",
	"buttonText",
	"headerBackground",
	"headerText",
	"inputBackground",
	"inputBorder",
	"inputIcon",
	"inputLabel",
	"inputText",
	"link",
	"linkHover",
	"loadingA",
	"loadingB",
	"loadingBackdrop",
	"loadingProgressLeft",
	"loadingProgressRight",
	"loadingStepBackground",
	"loadingStepBorder",
	"loadingStepText",
	"menuBackground",
	"menuText",
	"panelBackground",
	"panelBorder",
	"panelSecondaryBackground",
	"panelTitle",
	"shadow",
	"tabBackground",
	"tabText",
	"text",
	"topBottomBarBackground",
	"topBottomBarText",
	"valid",
	"warning"
];
/**
 * Returns the object will all theme properties. The returned object can
 * be used to save the theme and later to load it, straight from the php
 * script, using the dedicated method from the theme class definition
 * @returns {Obiect} an object with the theme properties
 */
function jsf_theme_getProperties() {
	let themeInfo = {
		'name' : document.getElementById("jsf_theme_name").value,
		'description' : document.getElementById("jsf_theme_description").value
	};
	jsf_theme_properties.forEach(function (element) {
		themeInfo[element] = document.getElementById("jsf_theme_" + element).value;
	});
	return themeInfo;
}
/**
 * Shows the interface to select one of the available themes
 */
function jsf_theme_showAvailableThemes() {
	document.getElementById("jsf-theme-select").click();
}
/**
 * Called after the user has selected a theme, to be loaded as a template
 * @param {Element} element the button where the selection has been made
 */
function jsf_theme_predefinedThemeSelected(element) {
	for (let name in jsf_theme_templates[element.value]) {
		jsf_forms_updateValue(
			"jsf_theme_" + name,
			jsf_theme_templates[element.value][name]
		);
	}
	jsf_theme_updateThemeFromInputs();
}
/**
 * Shows the tab with the theme settings
 */
function jsf_theme_showSettingsTab() {
	document.getElementById("jsf-edit-wireframe").classList.remove("jsf_theme-hidden");
	document.getElementById("jsf-view-wireframe").classList.add("jsf_theme-hidden");
	jsf_tab_select("jsf-tab-edit");
}
/**
 * Updates the page theme with the properties defined in the edit page inputs
 */
function jsf_theme_updateThemeFromInputs() {
	jsf_theme_update(jsf_theme_getProperties());
}
/**
 * Used for validation of the always valid inputs
 * @returns {Boolean} always true
 */
function jsf_theme_valid() {
	return true;
}
/**
 * Used for validation of the always invalid inputs
  * @returns {Boolean} always false
 */
function jsf_theme_invalid() {
	return false;
}
/**
 * Validates the name input from the page
 * @returns {Boolean} true if the name is valid, false if not
 */
function jsf_theme_validateName() {
	if (document.getElementById("jsf_theme_name") === null) {
		return false;
	}
	if (document.getElementById("jsf_theme_name").value === "") {
		return false;
	}
	return true;
}
/**
 * Shows the tab for viewing the theme (the tab with different items)
 */
function jsf_theme_showViewTab() {
	document.getElementById("jsf-edit-wireframe").classList.add("jsf_theme-hidden");
	document.getElementById("jsf-view-wireframe").classList.remove("jsf_theme-hidden");
	jsf_tab_select("jsf-tab-view");
}
/**
 * Starts a 3 second simple loading animation
 */
function jsf_theme_simpleLoadingAnimation() {
	jsf_loading_step.reset();
	jsf_loading_start();
	setTimeout(() => {
		jsf_loading_stop();
	}, 3000);
}
/**
 * Starts a step based loading animation
 */
function jsf_theme_stepsLoadingAnimation() {
	jsf_loading_step.reset();
	let textPas = document.getElementById("butonSeIncarcaEtape").dataset.pasul;
	jsf_theme_step1 = new jsf_loading_step();
	jsf_theme_step1.setLabel(textPas + " 1");
	jsf_theme_step1.setIcon("lock_open");
	jsf_theme_step2 = new jsf_loading_step();
	jsf_theme_step2.setLabel(textPas + " 2");
	jsf_theme_step2.setIcon("language");
	jsf_theme_step3 = new jsf_loading_step();
	jsf_theme_step3.setLabel(textPas + " 3");
	jsf_theme_step3.setIcon("system_update_alt");
	jsf_loading_start();
	setTimeout(() => {jsf_theme_step1.setProgress(20);}, 300);
	setTimeout(() => {jsf_theme_step1.setProgress(40);}, 600);
	setTimeout(() => {jsf_theme_step1.setProgress(60);}, 900);
	setTimeout(() => {jsf_theme_step1.setProgress(80);}, 1200);
	setTimeout(() => {jsf_theme_step1.setProgress(100);}, 1400);
	setTimeout(() => {jsf_theme_step2.setProgress(20);}, 1600);
	setTimeout(() => {jsf_theme_step2.setProgress(90);}, 1800);
	setTimeout(() => {jsf_theme_step2.setProgress(100);}, 2100);
	setTimeout(() => {jsf_theme_step3.setProgress(1);}, 2400);
	setTimeout(() => {jsf_theme_step3.setProgress(30);}, 2700);
	setTimeout(() => {jsf_theme_step3.setProgress(60);}, 3000);
	setTimeout(() => {jsf_theme_step3.setProgress(90);}, 3300);
	setTimeout(() => {jsf_theme_step3.setProgress(100);}, 3600);
	setTimeout(() => {jsf_loading_stop();jsf_loading_step.reset();}, 3900);
}
/**
 * Starts a full screen message animation
 * @param {String} message the message to be displayed
 */
function jsf_theme_largeMessageAnimation(message) {
	jsf_message(message, jsf_urlJigsawFramework + "/media/background.jpg");
}
/**
 * Starts a small message animation
 * @param {String} message the message to be displayed
 */
function jsf_theme_smallMessageAnimation(message) {
	jsf_message(message);
}
/**
 * Populates the clipboard with the php code that contains all the theme definition
 */
function jsf_theme_getPhpCode() {
	let content = "";
	let properties = jsf_theme_getProperties();
	for (let name in properties) {
		if (content !== '') {
			content += "\n";
		}
		content += "$this->set" + name.charAt(0).toUpperCase() 
			+ name.slice(1) + "('" + properties[name] + "');";
	}
	navigator.clipboard.writeText(content);
}