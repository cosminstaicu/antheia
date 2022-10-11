/**
 * The function is called after the user has pressed a button for a delete
 * confirmation. The interface will require a confirmation from the user and
 * then will init the delete process.
 * @param {Element} element the button that has been pressed
 */
function ant_deleteConfirmation(element) {
	let modal = new ant_modal();
	modal.setHeader(element.dataset.textInfo);
	// the visible input
	let inputText = document.createElement("input");
	inputText.type = "text";
	inputText.name = "ant_delete_" + (new Date()).getTime();
	inputText.value = "";
	inputText.maxLength = 20;
	modal.appendContent(inputText);
	// submit button
	let submit = document.createElement("input");
	submit.type = "button";
	submit.value = element.dataset.textButton;
	submit.onclick = () => {
		let inputValue = inputText.value.toUpperCase();
		if (inputValue !== element.dataset.textTemplate) {
			ant_alert.quickError(element.dataset.textError, () => {
				inputText.value = "";
				inputText.focus();
			});
			return false;
		}
		// checking if a presubmit action is requested
		ant_utils_preCallback(element);
		// creating the form for submitting the request
		let form = document.createElement("form");
		if (element.dataset.target !== "") {
			form.target = element.dataset.target;
		}
		form.action = element.dataset.url;
		form.method = "post";
		let inputHidden = document.createElement("input");
		inputHidden.type = "hidden";
		inputHidden.name = element.dataset.inputName;
		inputHidden.value = element.dataset.inputValue;
		form.appendChild(inputHidden);
		document.body.appendChild(form);
		modal.hide();
		ant_loading_start();
		form.submit();
	}
	modal.appendFooter(submit);
	modal.show();
	inputText.focus();
}