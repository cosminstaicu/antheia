/**
 * Shows the menu inside the panel header
 * @param {String} panelId the id of the panel containing the menu
 */
function ant_panel_showMenu(panelId) {
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
	if (!element.classList.contains("ant_menu")) {
		throw new Error("Unable to locate menu item");
	}
	element.classList.add('ant-active');
}
/**
 * Hides the menu inside the panel header
 * @param {String} panelId the id of the panel containing the menu
 */
function ant_panel_hideMenu(panelId) {
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
	if (!element.classList.contains("ant_menu")) {
		throw new Error("Unable to locate menu item");
	}
	element.classList.remove('ant-active');
}
/**
 * Called when the user clicks on an item in a file browser panel
 * @param {HTMLButtonElement} item the item that was clicked
 */
function ant_panel_fileBrowserItemClick(item) {
	ant_utils_preCallback(item.parentElement);
	let i = 0;
	let items = item.parentElement.parentElement.children;
	for (i = 0; i < items.length; i++) {
		if (items[i] === item.parentElement) {
			item.parentElement.classList.toggle('ant-active');
		} else {
			items[i].classList.remove('ant-active');
		}
	}
	ant_utils_postCallback(item.parentElement);
}
/**
 * Hides the panel content and displays a loading animation
 * @param {String} panelId the id of the panel showing the animation
 */
function ant_panel_startLoading(panelId) {
	document.getElementById(panelId).classList.add('ant-loading');
}
/**
 * Stops the loading animation inside a panel and shows the content
 * @param {String} panelId the id of the panel showing the animation
 */
function ant_panel_stopLoading(panelId) {
	document.getElementById(panelId).classList.remove('ant-loading');
}
/**
 * Returns a list with all tabs attached to a panel
 * @param {HTMLDivElement|String} panel the panel from where the tabs
 * will be returned. It can be the html node or the id of the html node
 * @returns {HTMLDivElement[]} the list with all tabs
 */
function ant_panel_tabsGet(panel) {
	let i = 0;
	let tabs = [];
	/** @type {HTMLDivElement} */
	let panelElement = panel;
	if (typeof panel === "string") {
		panelElement = document.getElementById(panel);
		if (panelElement === null) {
			throw new Error('Unknown panel id ' + panel);
		}
	}
	let tabsElements = panelElement.getElementsByClassName('ant-tabs')[0].children;
	for (i = 0; i < tabsElements.length; i++) {
		tabs.push(tabsElements[i]);
	}
	return tabs;
}
/**
 * Creates a new tab (to be attached later to a container) and returns it
 * @param {String} label the label of the tab (the text displayed on it)
 * @param {"link"|"button"} [tabType] the type of tab to be created: link (a "A"
 * tag will be created) or "button" (a "BUTTON" tag will be created)
 * @returns {HTMLDivElement} the new tab
 */
function ant_panel_tabsNew(label, tabType) {
	let wrapper = document.createElement("div");
	let tab = null;
	switch (tabType) {
		case "link":
			tab = document.createElement("a");
			break;
		case "button":
			tab = document.createElement("button");
			break;
		default:
			throw new Error("Unknown tab type " + tabType);
	}
	tab.innerHTML = label;
	wrapper.appendChild(tab);
	return wrapper;
}
/**
 * Returns the controller (the A or BUTTON html node) for a tab
 * @param {HTMLDivElement|String} tab the tab for the controller
 * @returns {HTMLAnchorElement|HTMLButtonElement} the controller for the tab
 */
function ant_panel_tabsGetController(tab) {
	/** @type {HTMLDivElement} */
	let tabElement = tab;
	if (typeof tab === "string") {
		tabElement = document.getElementById(tab);
		if (tabElement === null) {
			throw new Error('Unknown tab id ' + tab);
		}
	}
	return tabElement.children[0];
}
/**
 * Sets the label of a tab (the text displayed on it)
 * @param {HTMLDivElement|String} tab the tab to be modified
 * @param {String} label the label to be set to the tab
 */
function ant_panel_tabsSetLabel(tab, label) {
	ant_panel_tabsGetController(tab).innerHTML = label;
}
/**
 * Adds a tab to a panel
 * @param {HTMLDivElement|String} panel the panel where the tab will be inserted.
 * It can be the html node or the id of the html node
 * @param {HTMLDivElement} tab the tab to be attached
 * @returns {HTMLDivElement} the added tab
 * 
 */
function ant_panel_tabsAdd(panel, tab) {
	/** @type {HTMLDivElement} */
	let panelElement = panel;
	if (typeof panel === "string") {
		panelElement = document.getElementById(panel);
		if (panelElement === null) {
			throw new Error('Unknown panel id ' + panel);
		}
	}
	panelElement.getElementsByClassName('ant-tabs')[0].appendChild(tab);
	return tab;
}
/**
 * Removes a tab from a panel
 * @param {HTMLDivElement|String} tab the tab to be removed.
 * It can be the html node or the id of the html node
 */
function ant_panel_tabsRemove(tab) {
	/** @type {HTMLDivElement} */
	let tabElement = tab;
	if (typeof tab === "string") {
		tabElement = document.getElementById(tab);
		if (tabElement === null) {
			throw new Error('Unknown tab id ' + tab);
		}
	}
	tabElement.remove();
}
/**
 * Enables the accent on a tab
 * @param {HTMLDivElement|String} tab the tab to be accented.
 * It can be the html node or the id of the html node
 */
function ant_panel_tabsAccentOn(tab) {
	/** @type {HTMLDivElement} */
	let tabElement = tab;
	if (typeof tab === "string") {
		tabElement = document.getElementById(tab);
		if (tabElement === null) {
			throw new Error('Unknown tab id ' + tab);
		}
	}
	tabElement.classList.add("ant-accent");
}
/**
 * Disables the accent on a tab
 * @param {HTMLDivElement|String} tab the tab from where the accent will be removed.
 * It can be the html node or the id of the html node
 */
function ant_panel_tabsAccentOff(tab) {
	/** @type {HTMLDivElement} */
	let tabElement = tab;
	if (typeof tab === "string") {
		tabElement = document.getElementById(tab);
		if (tabElement === null) {
			throw new Error('Unknown tab id ' + tab);
		}
	}
	tabElement.classList.remove("ant-accent");
}
/**
 * Renderes a tab as selected
 * @param {HTMLDivElement|String} tab the tab to be selected.
 * It can be the html node or the id of the html node.
 * @param {Boolean} [deselectOthers=true] if true, then all other tabs in the
 * list will be deselecected, if false then no action will be taken on other
 * tabs 
 */
function ant_panel_tabsSelect(tab, deselectOthers) {
	if (deselectOthers === undefined) {
		deselectOthers = true;
	}
	/** @type {HTMLDivElement} */
	let tabElement = tab;
	if (typeof tab === "string") {
		tabElement = document.getElementById(tab);
		if (tabElement === null) {
			throw new Error('Unknown tab id ' + tab);
		}
	}
	if (deselectOthers) {
		let tabList = tabElement.parentElement.children;
		for (let i = 0; i < tabList.length; i++) {
			ant_panel_tabsDeselect(tabList[i]);
		}
	}
	tabElement.classList.add("ant-selected");
}
/**
 * Renderes a tab as deselected
 * @param {HTMLDivElement|String} tab the tab to be deselected.
 * It can be the html node or the id of the html node.
 */
function ant_panel_tabsDeselect(tab) {
	/** @type {HTMLDivElement} */
	let tabElement = tab;
	if (typeof tab === "string") {
		tabElement = document.getElementById(tab);
		if (tabElement === null) {
			throw new Error('Unknown tab id ' + tab);
		}
	}
	tabElement.classList.remove("ant-selected");
}
/**
 * Shows the tab list, on a panel
 * @param {HTMLDivElement|String} panel the panel with the tab list
 * It can be the html node or the id of the html node.
 */
function ant_panel_tabsShow(panel) {
	/** @type {HTMLDivElement} */
	let panelElement = panel;
	if (typeof panel === "string") {
		panelElement = document.getElementById(panel);
		if (panelElement === null) {
			throw new Error('Unknown panel id ' + panel);
		}
	}
	panelElement.getElementsByClassName('ant-tabs')[0].classList.remove('ant-display-none');
}
/**
 * Hides the tab list, on a panel
 * @param {HTMLDivElement|String} panel the panel with the tab list
 * It can be the html node or the id of the html node.
 */
function ant_panel_tabsHide(panel) {
	/** @type {HTMLDivElement} */
	let panelElement = panel;
	if (typeof panel === "string") {
		panelElement = document.getElementById(panel);
		if (panelElement === null) {
			throw new Error('Unknown panel id ' + panel);
		}
	}
	panelElement.getElementsByClassName('ant-tabs')[0].classList.add('ant-display-none');
}