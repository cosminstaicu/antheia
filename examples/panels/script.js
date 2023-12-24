"use strict";
/**
 * Starts a loading animation for 3 seconds then ends it
 */
function startPanelLoadingAnimation() {
	ant_panel_startLoading('panelWithActions');
	setTimeout(() => {
		ant_panel_stopLoading('panelWithActions');
	}, 3000);
}
/**
 * Called when the user validates the deletion on the javascript method button
 * @param {Element} element the button that was pressed
 */
function deleteConfirmed(element) {
	console.log(element);
}
/**
 * Adds a new tab to the panel
 */
function addNewTab() {
	let tab = ant_panel_tabsAdd(
		'panelWithTabs',
		ant_panel_tabsNew("New tab","button")
	);
	ant_panel_tabsGetController(tab).addEventListener('click', () => {
		console.log('clicked');
	});
}
/**
 * Removes the first tab from the panel
 */
function deleteFirstTab() {
	let tab = ant_panel_tabsGet('panelWithTabs')[0];
	ant_panel_tabsRemove(tab);
}
/**
 * Renders the second tab from the panel as selected
 */
function selectSecondTab() {
	let tab = ant_panel_tabsGet('panelWithTabs')[1];
	ant_panel_tabsSelect(tab);
}
/**
 * Accents the first tab from the panel
 */
function accentFirstTab() {
	let tab = ant_panel_tabsGet('panelWithTabs')[0];
	ant_panel_tabsAccentOn(tab);
}
/**
 * Removes the accent from the first tab from the panel
 */
function noAccentFirstTab() {
	let tab = ant_panel_tabsGet('panelWithTabs')[0];
	ant_panel_tabsAccentOff(tab);
}
/**
 * Hides the tab bar from the panel
 */
function hideTabBar() {
	ant_panel_tabsHide('panelWithTabs');
}
/**
 * Shows the tab bar from the panel
 */
function showTabBar() {
	ant_panel_tabsShow('panelWithTabs');
}