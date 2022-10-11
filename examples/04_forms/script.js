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
 * Triggered after the dropped file upload has been finished
 */
function afterDropFileTransfer(dropArea) {
	ant_loading_stop();
	console.log(dropArea.ant_fileList);
}