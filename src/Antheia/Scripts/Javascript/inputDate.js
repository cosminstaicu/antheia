let jsf_inputDate_process = null;
/**
 * Displays the interface for selecting a date, after the user has pressed
 * a date input button
 * @param {Element} element the button that has been pressed by the user
 */
function jsf_inputDate_start(element) {
	let processId = Date.now();
	jsf_inputDate_process = {
		id : processId,
		modal : null,
		content : null,
		trigger : element,
		inputHidden : element.nextElementSibling.nextElementSibling,
		year : 0,
		month : 0,
		day : 0,
		language : null,
		setSelectionStatus : null,
		updateContent : null
	};
	jsf_utils_preCallback(jsf_inputDate_process.inputHidden);
	jsf_inputDate_process.modal = new jsf_modal();
	jsf_inputDate_process.modal.setHeader(element.dataset.label);
	jsf_inputDate_process.modal.setOnClose(() => {
		jsf_inputDate_process = null;
	});
	// the container with the server response (main content)
	jsf_inputDate_process.content = document.createElement("div");
	jsf_inputDate_process.content.classList.add("jsf_inputDate");
	let initialValue = element.nextElementSibling.nextElementSibling.value;
	if (initialValue === element.dataset.undefinedDate) {
		// initial date is undefined, so the current month will be displayed
		initialValue = element.dataset.today;
	}
	jsf_inputDate_process.year = initialValue.slice(0,4);
	jsf_inputDate_process.month = initialValue.slice(4,6);
	jsf_inputDate_process.language = element.dataset.language;
	/**
	 * Defines the status of the main content (what is being displayed)
	 * @param {String} status the content status, using a string from
	 * the list: day, month, year
	 */
	jsf_inputDate_process.setSelectionStatus = (status) => {
		jsf_inputDate_process.content.classList.remove("jsf-day");
		jsf_inputDate_process.content.classList.remove("jsf-month");
		jsf_inputDate_process.content.classList.remove("jsf-year");
		jsf_inputDate_process.content.classList.add("jsf-" + status);
	}
	jsf_inputDate_process.modal.appendContent(jsf_inputDate_process.content);
	/**
	 * Starts to update the main content of the interface, based on the 
	 * interface properties. Calling the function will start a http request
	 * to the server, to return the updated html code
	 */
	jsf_inputDate_process.updateContent = () => {
		jsf_inputDate_process.content.innerHTML = "";
		jsf_inputDate_process.modal.startLoading();
		let req = new XMLHttpRequest();
		req.open("POST", jsf_urlJigsawFramework + "/scripts/ajax/date.php", true);
		req.onreadystatechange = () => {
			if (req.readyState !== 4) {
				return false;
			}
			if (req.status !== 200) {
				return false;
			}
			if (jsf_inputDate_process === null) {
				// while the interface was loading, the user closed the modal
				return false;
			}
			if (jsf_inputDate_process.id !== processId) {
				// while the interface was loading, the user closed the
				// curent date input and opened another
				return false;
			}
			jsf_inputDate_process.setSelectionStatus("day");
			jsf_inputDate_process.content.innerHTML = req.responseText;
			jsf_inputDate_process.modal.stopLoading();
		};
		req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		req.send(
			"m=" + jsf_inputDate_process.month 
			+ "&y=" + jsf_inputDate_process.year 
			+ "&lg=" + jsf_inputDate_process.language
		);
	}
	if (element.dataset.showUndefined === "yes") {
		// show a button for selecting undefined
		let undefinedButton = document.createElement("input");
		undefinedButton.type = "button";
		undefinedButton.classList.add("jsf_form-undefined-button");
		undefinedButton.value = element.dataset.textUndefined;
		undefinedButton.dataset.text = element.dataset.textUndefined;
		undefinedButton.dataset.value = element.dataset.undefinedDate;
		undefinedButton.onclick = function () {
			jsf_inputDate_select(this);
		}
		jsf_inputDate_process.modal.appendFooter(undefinedButton);
	}
	if (element.dataset.showToday === "yes") {
		// show a button for selecting today
		let today = document.createElement("input");
		today.type = "button";
		today.value = element.dataset.textToday;
		today.dataset.text = element.dataset.textToday;
		today.dataset.value = element.dataset.today;
		today.onclick = function () {
			jsf_inputDate_select(this);
		}
		jsf_inputDate_process.modal.appendFooter(today);
	}
	jsf_inputDate_process.modal.show();
	jsf_inputDate_process.updateContent();
}
/**
 * Shows the interface for selecting a month. It is called when the user
 * presses the button for the month selection.
 */
function jsf_inputDate_showMonths() {
	if (jsf_inputDate_process === null) {
		// the modal has been closed during the call
		return false;
	}
	jsf_inputDate_process.setSelectionStatus("month");
}
/**
 * Change the displayed month
 * @param {Element} element the button pressed by the user
 * @param {Number} month the id of the month (1=january)
 * @param {Number|null} year the year containing the month or null if the
 * current year is preserved
 */
function jsf_inputDate_changeMonth(month, year = null) {
	if (jsf_inputDate_process === null) {
		// the modal has been closed during the call
		return false;
	}
	jsf_inputDate_process.month = month;
	if (year !== null) {
		jsf_inputDate_process.year = year;
	}
	jsf_inputDate_process.updateContent();
}
/**
 * Called when the user presses the button with the curent year
 * @param {Element} element the button that has been pressed
 */
function jsf_inputDate_clickYear(element) {
	jsf_inputDate_updateYears(parseInt(element.value));
}
/**
 * Called when the user changes the selected years interval
 * @param {Element} element the button pressed
 */
function jsf_inputDate_changeYears(element) {
	jsf_inputDate_updateYears(parseInt(element.dataset.middle));
}
/**
 * Displays the interface for selecting a year from an interval
 * @param {Number} middle the year in the middle of the interval,
 * used to compute the entire interval
 */
function jsf_inputDate_updateYears(middle) {
	if (jsf_inputDate_process === null) {
		// the modal has been closed during the call
		return false;
	}
	let currentYear = parseInt(jsf_inputDate_process.year);
	let yearsContainer = jsf_inputDate_process.content.children[4];
	yearsContainer.innerHTML = '';
	let firstYear = middle - 10;
	let lastYear = middle + 9;
	let i = 0;
	let button = null;
	for (i = firstYear; i <= lastYear; i++) {
		button = document.createElement("input");
		if (currentYear === i) {
			button.classList.add("jsf_current-year");
		}
		button.type = "button";
		button.value = i;
		button.onclick = function () {
			jsf_inputDate_process.year = this.value;
			jsf_inputDate_process.updateContent();
		}
		yearsContainer.appendChild(button);
	}
	jsf_inputDate_process.content.children[1].children[0].dataset.middle = middle - 20;
	jsf_inputDate_process.content.children[1].children[1].dataset.middle = middle + 20;
	jsf_inputDate_process.setSelectionStatus("year");
}
/**
 * Called when the user selects a value. The hidden input will be updated,
 * the trigger button text will be updated and the interface will be deleted
 * @param {Element} element the button that the user has pressed
 */
function jsf_inputDate_select(element) {
	if (jsf_inputDate_process === null) {
		// the modal has been closed during the call
		return false;
	}
	let inputHidden = jsf_inputDate_process.inputHidden;
	jsf_inputDate_process.trigger.value = element.dataset.text;
	inputHidden.value = element.dataset.value;
	jsf_inputDate_process.modal.hide();
	jsf_forms_updateStatus(inputHidden.id);
	jsf_utils_postCallback(inputHidden);
}