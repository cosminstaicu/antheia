/**
 * Updates the status of an input. The status is displayed as an icon
 * to the right of the input (a valid or an invalid icon). The input has to
 * have a function for the validation process, already defined
 * @param {HTMLElement|String} inputOrId the input or the id of the input
 * to be updated
 */
function ant_forms_updateStatus(inputOrId) {
	/** @type {HTMLElement} */
	let input = inputOrId;
	if (typeof input === "string") {
		input = document.getElementById(inputOrId);
		if (input === null) {
			throw new Error('Unknown input id ' + inputOrId);
		}
	}
	if (window[input.dataset.validate] === undefined) {
		return;
	}
	if (window[input.dataset.validate] === "") {
		return;
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
 * @param {HTMLElement|String} inputOrId the input or the id of the input
 * to be updated
 * @param {String} value the new value of the input
 * @param {String} readableValue (optional) the value that will be
 * displayed to the user, if it is different than the input value. It is
 * used by date, search, custom buttons type of inputs. If the value is
 * required by the input, but undefined in the function call then the
 * value of the second parameter will be used.
 */
function ant_forms_updateValue(inputOrId, value, readableValue) {
	let button = null;
	/** @type {HTMLElement} */
	let element = inputOrId;
	if (typeof element === "string") {
		element = document.getElementById(inputOrId);
		if (element === null) {
			throw new Error('Unknown input id ' + inputOrId);
		}
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
			if (value == button.dataset.undefinedValue) {
				button.value = button.dataset.textUndefined;
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
			if (value == button.dataset.undefinedValue) {
				button.value = button.dataset.textUndefined;
			} else {
				button.value = readableValue;
			}
			break;
		case "input-hidden-time":
			button = element.previousElementSibling.previousElementSibling;
			element.value = value;
			if (value == button.dataset.undefinedValue) {
				button.value = button.dataset.textUndefined;
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
			throw new Error("Unknown type: " + inputType + ", ID: " + inputOrId);
	}
	ant_forms_updateStatus(element);
}
/**
 * Shows an error alert that contains the label of the input. After the user
 * clicks OK, the input is focused, if possible. The method always return false,
 * as it wil be probably used inside onSubmit form functions and this method
 * will be the last in the function.
 * @param {HTMLElement|String} inputOrId the input or the id of the input
 * @returns {Boolean} always false, so it can be used inside form validation functions 
 */
function ant_forms_showInputError(inputOrId) {
	/** @type {HTMLElement} */
	let element = inputOrId;
	if (typeof element === "string") {
		element = document.getElementById(inputOrId);
		if (element === null) {
			throw new Error('Unknown input id ' + inputOrId);
		}
	}
	// Will not be null if the input has a button attached to it
	let inputButton = null;
	let visibleElementId = element.id;
	if (element.dataset.visibleElementId !== undefined) {
		visibleElementId = element.dataset.visibleElementId;
		inputButton = document.getElementById(element.dataset.visibleElementId);
	}
	// selects all label containers, to find the label for the input
	let labelContainers = document.getElementsByClassName("ant_form-label-container");
	let labelText = null;
	for (let i = 0; i < labelContainers.length; i++) {
		let labels = labelContainers[i].getElementsByTagName('LABEL');
		if (labels.length === 0) {
			// containers for info type inputs do not have any labels
			continue;
		}
		let label = labels[0];
		if (label.getAttribute('for') === visibleElementId) {
			labelText = label.innerHTML;
			break;
		}
	}
	if (labelText === null) {
		throw new Error('No label found for ' + element.id);
	}
	let alertModal = new ant_modal();
	let elementValue = element.value;
	if (inputButton !== null) {
		elementValue = inputButton.value;
	}
	if (elementValue === '') {
		elementValue = '---';
	}
	alertModal.setHeader(ant_text["invalidInputValue"]);
	let mainParagraph = document.createElement('P');
	let okButton = document.createElement("INPUT");
	mainParagraph.classList.add("ant_form-invalid-input-error");
	mainParagraph.innerHTML = '<span>' + labelText + '</span>';
	let sendToInputButton = document.createElement('BUTTON');
	sendToInputButton.innerHTML = elementValue;
	sendToInputButton.addEventListener("click", () => {
		okButton.click();
	});
	mainParagraph.appendChild(sendToInputButton);
	let invalidIcon = document.createElement('I');
	invalidIcon.innerHTML = 'warning';
	mainParagraph.appendChild(invalidIcon);
	okButton.type = "button";
	okButton.value = ant_text["ok"];
	okButton.classList.add("ant_modal-footer-button");
	let focusOnClose = true;
	if (inputButton !== null) {
		focusOnClose = false;
		inputButton.scrollIntoView({behavior: "smooth"});
	} else {
		element.scrollIntoView({behavior: "smooth"});
	}
	okButton.onclick = () => {
		if (inputButton !== null) {
			focusOnClose = false;
			setTimeout(() => {inputButton.click();}, 300);
		}
		alertModal.hide();
	}
	alertModal.setOnClose(() => {
		window.scrollBy({top: -30, behavior: "smooth"});
		if (focusOnClose) {
			setTimeout(() => {element.focus();}, 50);
		}
	});
	alertModal.setContent(mainParagraph);
	alertModal.appendFooter(okButton);
	alertModal.show();
	return false;
}
