"use strict";
/**
 * Shows an info type alert message
 */
function alertInfo() {
	AntheiaAlert.quickInfo("Info message");
}
/**
 * Shows an error type alert message
 */
function alertError() {
	AntheiaAlert.quickError("Error message", () => {
		console.log("Message closed");
	});
}
/**
 * Shows an confirmation message
 */
function confirmModal() {
	AntheiaConfirm.quick("This is how you can ask for a confirmation", () => {
		console.log("Granted");
	}, () => {
		console.log("Blocked");
	});
}
