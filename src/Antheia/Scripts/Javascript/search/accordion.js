/**
 * Updates the status of all elements, when item selection is enabled.
 */
function jsf_search_accordion_statusUpdate() {
	let i = 0;
	let element;
	for (i = 0; i < jsf_search_total; i++) {
		element = document.getElementById("jsf_search_accordion_item_" + i);
		if (document.getElementById(jsf_search_checkboxPrefix + i).checked) {
			element.classList.add("jsf-selected");
		} else {
			element.classList.remove("jsf-selected");
		}
	}
}
/**
 * Toggles the extended mode for an item
 * @param {Element} element the element that is toggled
 */
function jsf_search_accordion_click(element) {
	element.parentElement.lastElementChild.classList.toggle("jsf-visible");
}