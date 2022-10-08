/**
 * Displays the options list from a select input. The user can click on a value
 * to select it
 * @param {Element} element the button clicked by the user
 */
function jsf_inputSelect_start(element) {
	let i = 0;
	let option = null;
	let inputHidden = element.nextElementSibling.nextElementSibling;
	jsf_utils_preCallback(inputHidden);
	let modal = new jsf_modal();
	modal.setHeader(element.dataset.label);
	modal.addContentClass("jsf_inputSelect");
	let options = inputHidden.options;
	for (i = 0; i < options.length; i++) {
		option = document.createElement("a");
		option.jsf_option = options[i];
		option.innerHTML = options[i].text;
		option.href="javascript:void(0)";
		option.onclick = function () {
			element.value = this.jsf_option.text;
			inputHidden.value = this.jsf_option.value;
			jsf_inputSelect_updateInfo(inputHidden);
			if (inputHidden.dataset.validate !== '') {
				jsf_forms_updateStatus(inputHidden.id);
			}
			modal.hide();
			jsf_utils_postCallback(inputHidden);
		}
		modal.appendContent(option);
	}
	modal.show();
}
/**
 * Checks if the selected option of the tag has additional info that needs to be
 * displayed to the user. 
 * @param {Element} element the html element to be checked
 */
function jsf_inputSelect_updateInfo(element) {
	let selectTag = element.nextElementSibling;
	let option = element.options[element.options.selectedIndex];
	if (option.dataset.help === undefined) {
		selectTag.innerHTML = "";
		selectTag.classList.add("jsf-hidden");
	} else {
		selectTag.innerHTML = option.dataset.help;
		selectTag.classList.remove("jsf-hidden");
	}
}