/**
 * Updates the status of all elements, when item selection is enabled.
 */
function ant_search_card_statusUpdate() {
	let i = 0;
	let element;
	for (i = 0; i < ant_search_total; i++) {
		element = document.getElementById("ant_search_card_item_" + i);
		if (document.getElementById(ant_search_checkboxPrefix + i).checked) {
			element.classList.add("ant-selected");
		} else {
			element.classList.remove("ant-selected");
		}
	}
}
/**
 * Toggle the additional data for a card
 * @param {Element} element the item for which the additional data is shown
 */
function ant_search_card_toggleInfo(element) {
	element.classList.toggle("ant-details");
}