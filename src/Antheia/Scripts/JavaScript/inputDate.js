let ant_inputDate_process = null;
/**
 * Displays the interface for selecting a date, after the user has pressed
 * a date input button
 * @param {HTMLButtonElement} element the button that has been pressed by the user
 */
function ant_inputDate_start(element) {
	let processId = Date.now();
	ant_inputDate_process = {
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
	ant_utils_preCallback(ant_inputDate_process.inputHidden);
	ant_inputDate_process.modal = new AntheiaModal();
	ant_inputDate_process.modal.setHeader(element.dataset.label);
	ant_inputDate_process.modal.setOnClose(() => {
		ant_inputDate_process = null;
	});
	// the container with the server response (main content)
	ant_inputDate_process.content = document.createElement("div");
	ant_inputDate_process.content.classList.add("ant_inputDate");
	let initialValue = element.nextElementSibling.nextElementSibling.value;
	if (initialValue === element.dataset.undefinedDate) {
		// initial date is undefined, so the current month will be displayed
		initialValue = element.dataset.today;
	}
	ant_inputDate_process.year = initialValue.slice(0,4);
	ant_inputDate_process.month = initialValue.slice(4,6);
	ant_inputDate_process.language = element.dataset.language;
	/**
	 * Defines the status of the main content (what is being displayed)
	 * @param {String} status the content status, using a string from
	 * the list: day, month, year
	 */
	ant_inputDate_process.setSelectionStatus = (status) => {
		ant_inputDate_process.content.classList.remove("ant-day");
		ant_inputDate_process.content.classList.remove("ant-month");
		ant_inputDate_process.content.classList.remove("ant-year");
		ant_inputDate_process.content.classList.add("ant-" + status);
	}
	ant_inputDate_process.modal.appendContent(ant_inputDate_process.content);
	/**
	 * Starts to update the main content of the interface, based on the 
	 * interface properties. Calling the function will start a http request
	 * to the server, to return the updated html code
	 */
	ant_inputDate_process.updateContent = () => {
		ant_inputDate_process.content.innerHTML = "";
		ant_inputDate_process.modal.startLoading();
		let req = new XMLHttpRequest();
		req.open("POST", ant_antheiaCacheUrl + "date.php", true);
		req.onreadystatechange = () => {
			if (req.readyState !== 4) {
				return false;
			}
			if (req.status !== 200) {
				return false;
			}
			if (ant_inputDate_process === null) {
				// while the interface was loading, the user closed the modal
				return false;
			}
			if (ant_inputDate_process.id !== processId) {
				// while the interface was loading, the user closed the
				// curent date input and opened another
				return false;
			}
			ant_inputDate_process.setSelectionStatus("day");
			ant_inputDate_process.content.innerHTML = req.responseText;
			ant_inputDate_process.modal.stopLoading();
		};
		req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		req.send(
			"m=" + ant_inputDate_process.month 
			+ "&y=" + ant_inputDate_process.year 
			+ "&lg=" + ant_inputDate_process.language
		);
	}
	if (element.dataset.showUndefined === "yes") {
		// show a button for selecting undefined
		let undefinedButton = document.createElement("input");
		undefinedButton.type = "button";
		undefinedButton.classList.add("ant_form-undefined-button");
		undefinedButton.value = element.dataset.textUndefined;
		undefinedButton.dataset.text = element.dataset.textUndefined;
		undefinedButton.dataset.value = element.dataset.undefinedDate;
		undefinedButton.onclick = function () {
			ant_inputDate_select(this);
		}
		ant_inputDate_process.modal.appendFooter(undefinedButton);
	}
	if (element.dataset.showToday === "yes") {
		// show a button for selecting today
		let today = document.createElement("input");
		today.type = "button";
		today.value = element.dataset.textToday;
		today.dataset.text = element.dataset.textToday;
		today.dataset.value = element.dataset.today;
		today.onclick = function () {
			ant_inputDate_select(this);
		}
		ant_inputDate_process.modal.appendFooter(today);
	}
	ant_inputDate_process.modal.show();
	ant_inputDate_process.updateContent();
}
/**
 * Shows the interface for selecting a month. It is called when the user
 * presses the button for the month selection.
 */
function ant_inputDate_showMonths() {
	if (ant_inputDate_process === null) {
		// the modal has been closed during the call
		return false;
	}
	ant_inputDate_process.setSelectionStatus("month");
}
/**
 * Change the displayed month
 * @param {HTMLButtonElement} element the button pressed by the user
 * @param {Number} month the id of the month (1=january)
 * @param {Number|null} year the year containing the month or null if the
 * current year is preserved
 */
function ant_inputDate_changeMonth(month, year = null) {
	if (ant_inputDate_process === null) {
		// the modal has been closed during the call
		return false;
	}
	ant_inputDate_process.month = month;
	if (year !== null) {
		ant_inputDate_process.year = year;
	}
	ant_inputDate_process.updateContent();
}
/**
 * Called when the user presses the button with the curent year
 * @param {HTMLButtonElement} element the button that has been pressed
 */
function ant_inputDate_clickYear(element) {
	ant_inputDate_updateYears(parseInt(element.value));
}
/**
 * Called when the user changes the selected years interval
 * @param {HTMLButtonElement} element the button pressed
 */
function ant_inputDate_changeYears(element) {
	ant_inputDate_updateYears(parseInt(element.dataset.middle));
}
/**
 * Displays the interface for selecting a year from an interval
 * @param {Number} middle the year in the middle of the interval,
 * used to compute the entire interval
 */
function ant_inputDate_updateYears(middle) {
	if (ant_inputDate_process === null) {
		// the modal has been closed during the call
		return false;
	}
	let currentYear = parseInt(ant_inputDate_process.year);
	let yearsContainer = ant_inputDate_process.content.children[4];
	yearsContainer.innerHTML = '';
	let firstYear = middle - 10;
	let lastYear = middle + 9;
	let i = 0;
	let button = null;
	for (i = firstYear; i <= lastYear; i++) {
		button = document.createElement("input");
		if (currentYear === i) {
			button.classList.add("ant_current-year");
		}
		button.type = "button";
		button.value = i;
		button.onclick = function () {
			ant_inputDate_process.year = this.value;
			ant_inputDate_process.updateContent();
		}
		yearsContainer.appendChild(button);
	}
	ant_inputDate_process.content.children[1].children[0].dataset.middle = middle - 20;
	ant_inputDate_process.content.children[1].children[1].dataset.middle = middle + 20;
	ant_inputDate_process.setSelectionStatus("year");
}
/**
 * Called when the user selects a value. The hidden input will be updated,
 * the trigger button text will be updated and the interface will be deleted
 * @param {HTMLButtonElement} element the button that the user has pressed
 */
function ant_inputDate_select(element) {
	if (ant_inputDate_process === null) {
		// the modal has been closed during the call
		return false;
	}
	ant_forms_updateValue(ant_inputDate_process.inputHidden, element.dataset.value);
	ant_inputDate_process.modal.hide();
}
