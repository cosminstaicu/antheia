/**
 * Displays the options list from a select input. The user can click on a value
 * to select it
 * @param {Element} element the button clicked by the user
 */
function ant_inputSelect_start(element) {
	let i = 0;
	let option = null;
	let inputHidden = element.nextElementSibling.nextElementSibling;
	ant_utils_preCallback(inputHidden);
	let modal = new ant_modal();
	modal.setHeader(element.dataset.label);
	modal.addContentClass("ant_inputSelect");
	let options = inputHidden.options;
	for (i = 0; i < options.length; i++) {
		option = document.createElement("a");
		option.ant_option = options[i];
		option.innerHTML = options[i].text;
		option.href="javascript:void(0)";
		option.onclick = function () {
			element.value = this.ant_option.text;
			inputHidden.value = this.ant_option.value;
			ant_inputSelect_updateInfo(inputHidden);
			if (inputHidden.dataset.validate !== '') {
				ant_forms_updateStatus(inputHidden.id);
			}
			modal.hide();
			ant_utils_postCallback(inputHidden);
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
function ant_inputSelect_updateInfo(element) {
	let selectTag = element.nextElementSibling;
	let option = element.options[element.options.selectedIndex];
	if (option.dataset.help === undefined) {
		selectTag.innerHTML = "";
		selectTag.classList.add("ant-hidden");
	} else {
		selectTag.innerHTML = option.dataset.help;
		selectTag.classList.remove("ant-hidden");
	}
}