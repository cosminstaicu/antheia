"use strict";
/**
 * The function checks if the Digits field value is valid
 * @returns {Boolean} true if the field value is valid, false if not
 */
function digitsValidation() {
	if (document.getElementById("digitsInput").value === '') {
		return false;
	}
	if (document.getElementById("digitsInput").value < 4) {
		return false;
	}
	return true;
}
/**
 * Validates if the date is valid (not before 2000)
 * @returns true if the value is greater then the year 2000, false if not
 */
function dateValidation() {
	let value = document.getElementById("dateInput").value;
	if (parseInt(value.slice(0, 4)) < 2000) {
		return false;
	}
	return true;
}
/**
 * Validates if the password has a value
 * @returns true if the value is not am empty string, false if it is an empty string
 */
function newPasswordValidation() {
	if (document.getElementById("newPassword").value === '') {
		return false;
	}
	return true;
}
/**
 * Validates if the search input has a value
 * @returns true if the value is not am empty string, false if it is an empty string
 */
function searchValidation() {
	if (document.getElementById("searchInput").value === '') {
		return false;
	}
	return true;
}
/**
 * Triggered after the dropped file upload has been finished
 */
function afterDropFileTransfer(dropArea) {
	ant_loading_stop();
	console.log(dropArea.ant_fileList);
}