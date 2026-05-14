/**
 * Updates the status of all elements, when item selection is enabled.
 */
function ant_search_accordion_statusUpdate() {
	let i = 0;
	let element;
	for (i = 0; i < ant_search_total; i++) {
		element = document.getElementById("ant_search_accordion_item_" + i);
		if (document.getElementById(ant_search_checkboxPrefix + i).checked) {
			element.classList.add("ant-selected");
		} else {
			element.classList.remove("ant-selected");
		}
	}
}
/**
 * Toggles the extended mode for an item
 * @param {Element} element the element that is toggled
 */
function ant_search_accordion_click(element) {
	element.parentElement.lastElementChild.classList.toggle("ant-visible");
}
