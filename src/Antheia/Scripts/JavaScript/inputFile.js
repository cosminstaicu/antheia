/**
 * Called when the user presses the button for selecting a file
 * @param {HTMLButtonElement} element the button that has been pressed
 */
function ant_inputFile_start(element) {
	element.previousElementSibling.click();
}
/**
 * Called after the user has updated the file input (after a file has
 * been selected)
 * @param {HTMLButtonElement} element the element (the file input) that has been updated
 */
function ant_inputFile_update(element) {
	let nameStart = -1;
	nameStart = element.value.lastIndexOf("/");
	if (nameStart === -1) {
		nameStart = element.value.lastIndexOf("\\");
	}
	nameStart++;
	element.nextElementSibling.value = element.value.slice(nameStart);
	ant_forms_updateStatus(element.id);
}