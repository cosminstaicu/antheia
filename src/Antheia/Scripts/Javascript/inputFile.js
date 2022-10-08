/**
 * Called when the user presses the button for selecting a file
 * @param {Element} element the button that has been pressed
 */
function jsf_inputFile_start(element) {
	element.previousElementSibling.click();
}
/**
 * Called after the user has updated the file input (after a file has
 * been selected)
 * @param {Element} element the element (the file input) that has been updated
 */
function jsf_inputFile_update(element) {
	let nameStart = -1;
	nameStart = element.value.lastIndexOf("/");
	if (nameStart === -1) {
		nameStart = element.value.lastIndexOf("\\");
	}
	nameStart++;
	element.nextElementSibling.value = element.value.slice(nameStart);
	jsf_forms_updateStatus(element.id);
}