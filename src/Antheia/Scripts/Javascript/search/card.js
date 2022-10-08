/**
 * Updates the status of all elements, when item selection is enabled.
 */
function jsf_search_card_statusUpdate() {
	let i = 0;
	let element;
	for (i = 0; i < jsf_search_total; i++) {
		element = document.getElementById("jsf_search_card_item_" + i);
		if (document.getElementById(jsf_search_checkboxPrefix + i).checked) {
			element.classList.add("jsf-selected");
		} else {
			element.classList.remove("jsf-selected");
		}
	}
}
/**
 * Toggle the additional data for a card
 * @param {Element} element the item for which the additional data is shown
 */
function jsf_search_card_toggleInfo(element) {
	element.classList.toggle("jsf-details");
}