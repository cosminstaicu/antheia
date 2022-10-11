/**
 * Updates the status of an input. The status is displayed as an icon
 * to the right of the input (a valid or an invalid icon). The input has to
 * have a function for the validation process, already defined
 * @param {String} id the id of the input to be updated
 */
function ant_forms_updateStatus(id) {
	if (id === "") {
		// no id defined
		return false;
	}
	let input = document.getElementById(id);
	if (input === null) {
		throw new Error("Unknown ID: " + id);
	}
	if (window[input.dataset.validate] === undefined) {
		return false;
	}
	if (window[input.dataset.validate] === "") {
		return false;
	}
	let statusIcon = input.parentElement;
	let i = 0;
	// searching for the container for the status icon
	for (i = 0; i < 10; i++) {
		if (statusIcon.classList.contains("ant_form-item")) {
			break;
		}
		statusIcon = statusIcon.parentElement;
		if (statusIcon === null) {
			throw new Error("Unable to locate the status icon container");
		}
	}
	if (!statusIcon.classList.contains("ant_form-item")) {
		throw new Error("Unable to locate the status icon container");
	}
	statusIcon.classList.add("ant-status");
	if (window[input.dataset.validate] === undefined) {
		throw new Error("Unknown function: " + input.dataset.validate + "()");
	}
	if (window[input.dataset.validate]()) {
		// valid field
		statusIcon.classList.remove("ant-invalid");
		statusIcon.classList.add("ant-valid");
	} else {
		// invalid field
		statusIcon.classList.remove("ant-valid");
		statusIcon.classList.add("ant-invalid");
	}
}
/**
 * Updates the value of an input element. Will also update the status
 * (validates the input) if the input has such a function defined
 * @param {String} id the id of the input to be updated
 * @param {String} value the new value of the input
 * @param {String} readableValue (optional) the value that will be
 * displayed to the user, if it is different than the input value. It is
 * used by date, search, custom buttons type of inputs. If the value is
 * required by the input, but undefined in the function call then the
 * value of the second parameter will be used.
 */
function ant_forms_updateValue(id, value, readableValue) {
	let button = null;
	let element = document.getElementById(id);
	if (element === null) {
		throw new Error("The id can not be found: " + id);
	}
	let inputType = element.tagName.toLowerCase();
	if (inputType === "input") {
		inputType += "-" + element.type;
	}
	if (readableValue === undefined) {
		readableValue = value;
	}
	if (inputType === "input-hidden") {
		// because the input is hidden I will check if the input is special
		// (if it has a visible button attached)
		// the special inputs can be: search, date, time, 
		let checkedInput = element.parentElement.children[0];
		if (checkedInput.dataset.antType !== undefined) {
			// this is a special input
			inputType += "-" + checkedInput.dataset.antType;
		}
	}
	switch (inputType) {
		case "input-hidden":
			element.value = value;
			break;
		case "input-hidden-custom":
			button = element.previousElementSibling.previousElementSibling;
			element.value = value;
			if (value == button.dataset.nespecificatValoare) {
				button.value = button.dataset.nespecificatText;
			} else {
				button.value = readableValue;
			}
			break;
		case "input-hidden-date":
			button = element.previousElementSibling.previousElementSibling;
			element.value = value;
			if (value == button.dataset.undefinedDate) {
				button.value = button.dataset.textUndefined;
			} else {
				let day = value.slice(6);
				let month = ant_text_months[value.slice(4,6)];
				let year = value.slice(0,4);
				button.value = day + " " + month + " " + year;
			}
			break;
		case "input-hidden-newPassword":
			button = element.previousElementSibling.previousElementSibling;
			element.value = value;
			button.value = readableValue;
			break;
		case "input-hidden-search":
			if (readableValue === undefined) {
				readableValue = value;
			}
			button = element.previousElementSibling.previousElementSibling;
			element.value = value;
			if (value == button.dataset.nespecificatValoare) {
				button.value = button.dataset.nespecificatText;
			} else {
				button.value = readableValue;
			}
			break;
		case "input-hidden-time":
			button = element.previousElementSibling.previousElementSibling;
			element.value = value;
			if (value == button.dataset.nespecificatValoare) {
				button.value = button.dataset.nespecificatText;
			} else {
				button.value = readableValue;
			}
			break;
		case "select":
			element.value = value;
			let selectedOption = element.options[element.options.selectedIndex];
			if (selectedOption === undefined) {
				throw new Error("Invalid option: " + value);
			}
			// update the visible button text with the selected value text
			element.parentElement.children[0].value = selectedOption.text;
			// check if additional data about the selection needs to be shown
			ant_inputSelect_updateInfo(element);
			break;
		case "textarea":
			element.innerHTML = value;
			element.value = value;
			break;
		case "input-color":
		case "input-email":
		case "input-number":
		case "input-password":
		case "input-tel":
		case "input-text":
			element.value = value;
			break;
		case "input-file":
			throw new Error("File type inputs can not be updated from javascript");
		case "span":
			// an info type element
			element.innerHTML = value;
			break;
		default:
			throw new Error("Unknown type: " + inputType + ", ID: " + id);
	}
	ant_forms_updateStatus(id);
}