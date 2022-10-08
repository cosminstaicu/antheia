/**
 * Shows the menu inside the panel header
 * @param {String} panelId the id of the panel containing the menu
 */
function jsf_panel_showMenu(panelId) {
	let element = document.getElementById(panelId);
	if (element === null) {
		throw new Error("Unable to locate panel");
	}
	element = element.children[0];
	if (element === null) {
		throw new Error("Unable to locate panel header");
	}
	element = element.children[0];
	if (element === null) {
		throw new Error("Unable to locate menu item");
	}
	if (!element.classList.contains("jsf_menu")) {
		throw new Error("Unable to locate menu item");
	}
	element.classList.add('jsf-active');
}
/**
 * Hides the menu inside the panel header
 * @param {String} panelId the id of the panel containing the menu
 */
function jsf_panel_hideMenu(panelId) {
	let element = document.getElementById(panelId);
	if (element === null) {
		throw new Error("Unable to locate panel");
	}
	element = element.children[0];
	if (element === null) {
		throw new Error("Unable to locate panel header");
	}
	element = element.children[0];
	if (element === null) {
		throw new Error("Unable to locate menu item");
	}
	if (!element.classList.contains("jsf_menu")) {
		throw new Error("Unable to locate menu item");
	}
	element.classList.remove('jsf-active');
}
/**
 * Called when the user clicks on an item in a file browser panel
 * @param {HTMLElement} item the item that was clicked
 */
function jsf_panel_fileBrowserItemClick(item) {
	jsf_utils_preCallback(item.parentElement);
	let i = 0;
	let items = item.parentElement.parentElement.children;
	for (i = 0; i < items.length; i++) {
		if (items[i] === item.parentElement) {
			item.parentElement.classList.toggle('jsf-active');
		} else {
			items[i].classList.remove('jsf-active');
		}
	}
	jsf_utils_postCallback(item.parentElement);
}
/**
 * Hides the panel content and displays a loading animation
 * @param {String} panelId the id of the panel showing the animation
 */
function jsf_panel_startLoading(panelId) {
	document.getElementById(panelId).classList.add('jsf-loading');
}
/**
 * Stops the loading animation inside a panel and shows the content
 * @param {String} panelId the id of the panel showing the animation
 */
function jsf_panel_stopLoading(panelId) {
	document.getElementById(panelId).classList.remove('jsf-loading');
}