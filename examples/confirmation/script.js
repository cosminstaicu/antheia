"use strict";
/**
 * Shows an info type alert message
 */
function alertInfo() {
	ant_alert.quickInfo("Info message");
}
/**
 * Shows an error type alert message
 */
function alertError() {
	ant_alert.quickError("Error message", () => {
		console.log("Message closed");
	});
}
/**
 * Shows an confirmation message
 */
function confirmModal() {
	ant_confirm.quick("This is how you can ask for a confirmation", () => {
		console.log("Granted");
	}, () => {
		console.log("Blocked");
	});
}