/**
 * Displays the tab list on the page
 */
function ant_tab_showList() {
	let container = document.getElementById("ant_header-tabs");
	if (container !== null) {
		container.classList.remove("ant-hidden");
	}
}
/**
 * Hides the tab list on the page
 */
function ant_tab_hideList() {
	let container = document.getElementById("ant_header-tabs");
	if (container !== null) {
		container.classList.add("ant-hidden");
	}
}
/**
 * Selects a tab from the list and deselects all others
 * @param {String} idTab the id of the tab to be selected
 */
function ant_tab_select(idTab) {
	document.getElementById("ant_header-tabs").childNodes.forEach((tab) => {
		if (tab.id === idTab) {
			tab.classList.add("ant-selected");
		} else {
			tab.classList.remove("ant-selected");
		}
	});
}
/**
 * Hides a tab from the displayed list
 * @param {String} idTab the id of the tab to be hidden
 */
function ant_tab_hide(idTab) {
	document.getElementById(idTab).classList.add("ant-hidden");
}
/**
 * Shows a tab on the list (if the tab was previously hidden)
 * @param {String} idTab the id of the tab to be shown
 */
function ant_tab_show(idTab) {
	document.getElementById(idTab).classList.remove("ant-hidden");
}
/**
 * Renames a tab
 * @param {String} idTab the id of the tab to be renamed
 * @param {String} title the new title of the tab
 */
function ant_tab_rename(idTab, title) {
	document.getElementById(idTab).children[0].innerText = title;
}
/**
 * Enables or disabled a tab accent (the bold text)
 * @param {String} idTab the id of the tab
 * @param {Boolean} status true to add the accent, false to remove it
 */
function ant_tab_accent(idTab, status) {
	if (status) {
		document.getElementById(idTab).classList.add("ant-accent");
	} else {
		document.getElementById(idTab).classList.remove("ant-accent");
	}
}