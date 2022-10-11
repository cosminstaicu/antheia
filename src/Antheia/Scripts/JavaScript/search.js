let ant_search_total = 0;
let ant_search_checkboxPrefix = "ant_search_checkboxItem";
/**
 * Submits the main form inside the page
 */
function ant_search_submit() {
	ant_loading_start();
	document.getElementById("ant_search-form").submit();
}
/**
 * Resets a search input (filter)
 * @param {String} id the id of the filter to be cleared
 */
function ant_search_resetInput(id) {
	let input = document.getElementById(id);
	input.value = input.getAttribute("data-default");
	ant_search_submit();
}
/**
 * Changes the sort order of the form
 * @param {String} value the new value of the sort order
 */
function ant_search_changeSortOrder(value) {
	document.getElementById("ant_sort-order").value = value;
	ant_search_submit();
}
/**
 * Reloads the page without submitting the form (no post values are sent)
 */
function ant_search_reset() {
	ant_loading_start();
	document.location.href = document.location.href;
}
/**
 * Change the current page number and submits the search form
 * @param {Number} page the page number to be loaded
 */
function ant_search_changePage(page) {
	document.getElementById("ant_currentPage").value = page;
	ant_search_submit();
}
/**
 * An event listener triggered for every keypress of the page number input
 * @param {Event} event the current event
 * @param {Number} totalPages the total number of pages for the current search
 */
function ant_search_pageInputUpdated(event, totalPages) {
	let keyCode = event.keyCode || event.which;
	let value = document.getElementById("ant_search-input-page").value;
	if (keyCode == 13) {
		if (isNaN(value)) {
			ant_alert.quickError("Invalid page!");
			return false;
		}
		if ( (value % 1) != 0 ) {
			ant_alert.quickError("Invalid page!");
			return false;
		}
		if (value < 1) {
			ant_alert.quickError("Invalid page!");
			return false;
		}
		if (value > totalPages) {
			value = totalPages;
		}
		ant_search_changePage(value);
	}
}
/**
 * Starts a rendering process for the selection status of each search result.
 * Only available for searches that have the item selection enabled
 */
function ant_search_updateSelection() {
	setTimeout("ant_search_updateSelectedItems()", 100);
}
/**
 * Checks the selection status for each item, renders the selection option
 * bar based on the selection status and then calls the selection render to
 * update the properties of each item
 * Only available for searches that have the item selection enabled
 */
function ant_search_updateSelectedItems() {
	let i = 0;
	let selectionAvailable = false;
	let fullSelection = true;
	for (i = 0; i < ant_search_total; i++) {
		if (document.getElementById(ant_search_checkboxPrefix + i).checked == true) {
			selectionAvailable = true;
		} else {
			fullSelection = false;
		}
	}
	if (selectionAvailable) {
		document.getElementById("ant_search-options").classList.add('ant-show-buttons');
	} else {
		document.getElementById("ant_search-options").classList.remove('ant-show-buttons');
	}
	if (fullSelection) {
		document.getElementById("ant_selectAll").checked = true;
	} else {
		document.getElementById("ant_selectAll").checked = false;
	}
	// the function is defined in the head of the document by the php script
	// and will call the render to update the items
	ant_search_renderSelection();
}
/**
 * Returns a list with the id of each selected item
 * Only available for searches that have the item selection enabled
 * @returns {String[]}
 */
function ant_search_getSelected() {
	let i = 0;
	let selected = [];
	for (i = 0; i < ant_search_total; i++) {
		if (document.getElementById(ant_search_checkboxPrefix + i).checked == true) {
			selected.push(document.getElementById(ant_search_checkboxPrefix + i).value);
		}
	}
	return selected;
}
/**
 * Toogles the selection / deselection of all results inside the page
 */
function ant_search_toogleSelectAll() {
	let status = true;
	let i = 0;
	if (document.getElementById("ant_selectAll").checked) {
		status = true;
	} else {
		status = false;
	}
	for (i = 0; i < ant_search_total; i++) {
		document.getElementById(ant_search_checkboxPrefix+i).checked = status;
	}
	setTimeout("ant_search_updateSelectedItems()", 100);
}