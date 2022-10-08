/**
 * Updates the status of all elements, when item selection is enabled.
 */
function jsf_search_table_statusUpdate() {
	let i = 0;
	let element;
	for (i = 0; i < jsf_search_total; i++) {
		element = document.getElementById("jsf_search_table_item_" + i);
		if (document.getElementById(jsf_search_checkboxPrefix + i).checked) {
			element.classList.add("jsf-selected");
		} else {
			element.classList.remove("jsf-selected");
		}
	}
}