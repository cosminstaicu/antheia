let jsf_inputSearch_process = null;
/**
 * The function is called when the user presses a button for a server side
 * search input
 * @param {Element} element the button pressed by the user
 */
function jsf_inputSearch_start(element) {
	jsf_inputSearch_process = {
		modal : null,
		trigger : element,
		hiddenInput : element.nextElementSibling.nextElementSibling
	};
	jsf_utils_preCallback(element.nextElementSibling.nextElementSibling);
	let jsf_inputSearch_timeout = 0;
	jsf_inputSearch_process.modal = new jsf_modal();
	jsf_inputSearch_process.modal.addContentClass("jsf_inputSearch");
	jsf_inputSearch_process.modal.setOnClose(() => {
		jsf_inputSearch_process = null;
	});
	let mainContent = document.createElement("div");
	jsf_inputSearch_process.modal.setHeader(element.dataset.label);
	// input searchInput
	let searchInput = document.createElement("input");
	searchInput.type = "text";
	searchInput.name = "searchValue";
	searchInput.value = element.dataset.initial;
	searchInput.autocomplete = 'off';
	searchInput.maxLength = 100;
	searchInput.dataset.url = element.dataset.url;
	searchInput.dataset.last = "dhrr773nndjeu33902k!!++'";
	let updateResults = () => {
		if (searchInput.value === searchInput.dataset.last) {
			// there is already a search in progress or finished for this value
			// so there is no need to start another one
			return false;
		}
		mainContent.innerHTML = "";
		mainContent.classList.add('jsf-loading');
		clearTimeout(jsf_inputSearch_timeout);
		jsf_inputSearch_timeout = setTimeout(() => {
			let req = new XMLHttpRequest();
			searchInput.dataset.last = searchInput.value;
			element.dataset.lastQuery = searchInput.value;
			req.searchValue = searchInput.value;
			req.onreadystatechange = () => {
				if (req.readyState !== 4) {
					return false;
				}
				if (req.status !== 200) {
					return false;
				}
				if (req.searchValue !== searchInput.dataset.last) {
					// this search value is different than the last searched value
					// that means that the server responded with a delay and
					// another search process has been started, with a newer value
					// because of that the response will be ignored
					return false;
				}
				mainContent.innerHTML = req.responseText;
				mainContent.classList.remove('jsf-loading');
			};
			req.open("POST", searchInput.dataset.url, true);
			req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			req.send("value=" + encodeURIComponent(searchInput.value));
		}, 500);	
	}
	searchInput.addEventListener('input', () => {
		updateResults();
	});
	searchInput.addEventListener('change', () => {
		updateResults();
	});
	searchInput.addEventListener('keydown', (event) => {
		if (event.key === 'Enter') {
			try {
				let options = mainContent.children;
				if (options.length === 1) {
					options[0].click();
				}
			} catch (error) {
				// just catching any error that can occur
				// on user generated content
			}
		}
	});
	jsf_inputSearch_process.modal.appendContent(searchInput);
	// the button for clearing the input
	let clearInput = document.createElement("a");
	clearInput.href = "javascript:void(0)";
	clearInput.innerHTML = "<i class='material-icons'>backspace</i>";
	clearInput.addEventListener('click', () => {
		searchInput.value = "";
		updateResults();
		searchInput.focus();
	});
	jsf_inputSearch_process.modal.appendContent(clearInput);
	// the container for the server response
	jsf_inputSearch_process.modal.appendContent(mainContent);
	// footer
	if (element.dataset.showUndefined === "yes") {
		let button = document.createElement("input");
		button.type = "button";
		button.value = element.dataset.textUndefined;
		button.addEventListener('click', () => {
			jsf_inputSearch_select(element.dataset.undefinedValue, button.value);
		});
		jsf_inputSearch_process.modal.appendFooter(button);
	}
	jsf_inputSearch_process.modal.show();
	searchInput.focus();
	updateResults();
}
/**
 * Called when the user presses on an item from the list returned by the server
 * @param {Element} element the item that has been pressed
 */
function jsf_inputSearch_selectItem(element) {
	jsf_inputSearch_select(element.dataset.value, element.innerHTML);
}
/**
 * Called when a value has been selected (from the server returned list or 
 * by pressing the undefined value button)
 * @param {String} value the selected value
 * @param {String} readableText the text that will be displayed on the trigger
 * button
 */
function jsf_inputSearch_select(value, readableText) {
	jsf_inputSearch_process.trigger.value = readableText;
	let hiddenInput = jsf_inputSearch_process.hiddenInput;
	hiddenInput.value = value;
	jsf_forms_updateStatus(hiddenInput.id);
	jsf_inputSearch_process.modal.hide();
	jsf_utils_postCallback(hiddenInput);
}