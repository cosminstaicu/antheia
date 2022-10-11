/**
 * Updates the page theme with a new one
 * @param {Object} theme an object that contains the theme properties
 */
function ant_theme_update(theme) {
	ant_theme_properties.forEach(function (p) {
		document.querySelector(':root').style.setProperty('--ant-theme-' + p, theme[p]);
	});
}
// ******************************************** used only in the edit theme page
let ant_theme_step1 = null;
let ant_theme_step2 = null;
let ant_theme_step3 = null;
let ant_theme_properties = [
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
function ant_theme_getProperties() {
	let themeInfo = {
		'name' : document.getElementById("ant_theme_name").value,
		'description' : document.getElementById("ant_theme_description").value
	};
	ant_theme_properties.forEach(function (element) {
		themeInfo[element] = document.getElementById("ant_theme_" + element).value;
	});
	return themeInfo;
}
/**
 * Shows the interface to select one of the available themes
 */
function ant_theme_showAvailableThemes() {
	document.getElementById("ant-theme-select").click();
}
/**
 * Called after the user has selected a theme, to be loaded as a template
 * @param {Element} element the button where the selection has been made
 */
function ant_theme_predefinedThemeSelected(element) {
	for (let name in ant_theme_templates[element.value]) {
		ant_forms_updateValue(
			"ant_theme_" + name,
			ant_theme_templates[element.value][name]
		);
	}
	ant_theme_updateThemeFromInputs();
}
/**
 * Shows the tab with the theme settings
 */
function ant_theme_showSettingsTab() {
	document.getElementById("ant-edit-wireframe").classList.remove("ant_theme-hidden");
	document.getElementById("ant-view-wireframe").classList.add("ant_theme-hidden");
	ant_tab_select("ant-tab-edit");
}
/**
 * Updates the page theme with the properties defined in the edit page inputs
 */
function ant_theme_updateThemeFromInputs() {
	ant_theme_update(ant_theme_getProperties());
}
/**
 * Used for validation of the always valid inputs
 * @returns {Boolean} always true
 */
function ant_theme_valid() {
	return true;
}
/**
 * Used for validation of the always invalid inputs
  * @returns {Boolean} always false
 */
function ant_theme_invalid() {
	return false;
}
/**
 * Validates the name input from the page
 * @returns {Boolean} true if the name is valid, false if not
 */
function ant_theme_validateName() {
	if (document.getElementById("ant_theme_name") === null) {
		return false;
	}
	if (document.getElementById("ant_theme_name").value === "") {
		return false;
	}
	return true;
}
/**
 * Shows the tab for viewing the theme (the tab with different items)
 */
function ant_theme_showViewTab() {
	document.getElementById("ant-edit-wireframe").classList.add("ant_theme-hidden");
	document.getElementById("ant-view-wireframe").classList.remove("ant_theme-hidden");
	ant_tab_select("ant-tab-view");
}
/**
 * Starts a 3 second simple loading animation
 */
function ant_theme_simpleLoadingAnimation() {
	ant_loading_step.reset();
	ant_loading_start();
	setTimeout(() => {
		ant_loading_stop();
	}, 3000);
}
/**
 * Starts a step based loading animation
 */
function ant_theme_stepsLoadingAnimation() {
	ant_loading_step.reset();
	let textPas = document.getElementById("butonSeIncarcaEtape").dataset.pasul;
	ant_theme_step1 = new ant_loading_step();
	ant_theme_step1.setLabel(textPas + " 1");
	ant_theme_step1.setIcon("lock_open");
	ant_theme_step2 = new ant_loading_step();
	ant_theme_step2.setLabel(textPas + " 2");
	ant_theme_step2.setIcon("language");
	ant_theme_step3 = new ant_loading_step();
	ant_theme_step3.setLabel(textPas + " 3");
	ant_theme_step3.setIcon("system_update_alt");
	ant_loading_start();
	setTimeout(() => {ant_theme_step1.setProgress(20);}, 300);
	setTimeout(() => {ant_theme_step1.setProgress(40);}, 600);
	setTimeout(() => {ant_theme_step1.setProgress(60);}, 900);
	setTimeout(() => {ant_theme_step1.setProgress(80);}, 1200);
	setTimeout(() => {ant_theme_step1.setProgress(100);}, 1400);
	setTimeout(() => {ant_theme_step2.setProgress(20);}, 1600);
	setTimeout(() => {ant_theme_step2.setProgress(90);}, 1800);
	setTimeout(() => {ant_theme_step2.setProgress(100);}, 2100);
	setTimeout(() => {ant_theme_step3.setProgress(1);}, 2400);
	setTimeout(() => {ant_theme_step3.setProgress(30);}, 2700);
	setTimeout(() => {ant_theme_step3.setProgress(60);}, 3000);
	setTimeout(() => {ant_theme_step3.setProgress(90);}, 3300);
	setTimeout(() => {ant_theme_step3.setProgress(100);}, 3600);
	setTimeout(() => {ant_loading_stop();ant_loading_step.reset();}, 3900);
}
/**
 * Starts a full screen message animation
 * @param {String} message the message to be displayed
 */
function ant_theme_largeMessageAnimation(message) {
	ant_message(message, ant_antheiaCacheUrl + "/background.jpg");
}
/**
 * Starts a small message animation
 * @param {String} message the message to be displayed
 */
function ant_theme_smallMessageAnimation(message) {
	ant_message(message);
}
/**
 * Populates the clipboard with the php code that contains all the theme definition
 */
function ant_theme_getPhpCode() {
	let content = "";
	let properties = ant_theme_getProperties();
	for (let name in properties) {
		if (content !== '') {
			content += "\n";
		}
		content += "$this->set" + name.charAt(0).toUpperCase() 
			+ name.slice(1) + "('" + properties[name] + "');";
	}
	navigator.clipboard.writeText(content);
}