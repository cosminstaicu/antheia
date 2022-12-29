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