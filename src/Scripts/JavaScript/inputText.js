/**
 * Checks if the loaded suggestion list for an input needs to be updated and
 * starts the update
 * @param {HTMLInputElement} element the input tag that is checked
 */
function ant_inputText_updateSuggestions(element) {
	let value = element.value;
	let listContainer = element.parentElement
		.getElementsByClassName('ant_inputText_suggestions')[0];
	if (listContainer === null) {
		throw new Error('List container not found');
	}
	if (value.length < element.dataset.suggestionLimit) {
		listContainer.classList.remove('ant-active');
		return;
	}
	let searchValue = value.slice(0, element.dataset.suggestionLimit).toLowerCase();
	if (searchValue !== element.dataset.suggestionLastRequest) {
		element.dataset.suggestionLastRequest = searchValue;
		listContainer.classList.add('ant-loading');
		listContainer.classList.add('ant-active');
		fetch(element.dataset.suggestionUrl, {
			method: "POST",
			cache: "no-cache",
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			body : "value=" + encodeURIComponent(searchValue)
		}).then((response) => {
			return response.text();
		}).then((htmlContent) => {
			if (searchValue !== element.dataset.suggestionLastRequest) {
				// another search has been started while this one was running
				// so this result is obsolette
				return;
			}
			listContainer.firstElementChild.innerHTML = htmlContent;
			listContainer.classList.remove('ant-loading');
		}).catch((error) => {
			throw error;
		});
		return;
	}
	listContainer.classList.add('ant-active');
	ant_inputText_filterSuggestions(element);
}
/**
 * Filters the suggestion list with values that are matching the input value
 * @param {HTMLInputElement} element the element being updated
 */
function ant_inputText_filterSuggestions(element) {
	let items = element.parentElement
		.getElementsByClassName('ant_inputText_suggestions')[0]
		.firstElementChild.children;
	let i = 0;
	let itemValue = '';
	let searchValue = element.value.toLowerCase();
	for (i = 0; i < items.length; i++) {
		itemValue = items[i].innerHTML.toLowerCase();
		if (itemValue.length <= searchValue.length) {
			items[i].classList.add('ant-inactive');
			continue;
		}
		if (itemValue.slice(0, searchValue.length) !== searchValue) {
			items[i].classList.add('ant-inactive');
			continue;
		}
		items[i].classList.remove('ant-inactive');
	}
}
/**
 * Triggered when the user presses on a suggestion button. The function updates
 * the input with the selected value
 * @param {HTMLButtonElement} element the element clicked by the user
 */
function ant_inputText_selected(element) {
	let inputElement = element.parentElement.parentElement.parentElement
		.firstElementChild;
	element.classList.remove('ant-selected');
	ant_forms_updateValue(inputElement.id, element.innerHTML);
}
/**
 * Triggered when the user pressed a key on an input that has suggestions enabled
 * @param {KeyboardEvent} event the event captured by the function
 */
function ant_inputText_keydown(event) {
	let i = 0;
	let selectedItem = null;
	/** @type {HTMLButtonElement[]} */
	let activeItems = [];
	/** @type {HTMLDivElement} */
	let scrollContainer = event.target.parentElement
		.getElementsByClassName('ant_inputText_suggestions')[0].firstElementChild;
	/** @type {HTMLCollection} */
	let allItems = scrollContainer.children;
	for (i = 0; i < allItems.length; i++) {
		if (allItems[i].classList.contains('ant-inactive')) {
			allItems[i].classList.remove('ant-selected');
			continue;
		}
		if (allItems[i].classList.contains('ant-selected')) {
			selectedItem = activeItems.length;
		}
		activeItems.push(allItems[i]);
		allItems[i].classList.remove('ant-selected');
	}
	if (activeItems.length === 0) {
		return;
	}
	switch (event.key) {
		case 'ArrowDown':
			if (selectedItem === null) {
				selectedItem = -1;
			}
			selectedItem++;
			if (selectedItem >= activeItems.length) {
				selectedItem = 0;
			}
			event.preventDefault();
			break;
		case 'ArrowUp':
			if (selectedItem === null) {
				selectedItem = activeItems.length - 1;
			}
			selectedItem--;
			if (selectedItem < 0) {
				selectedItem = activeItems.length - 1;
			}
			event.preventDefault();
			break;
		case 'Enter':
			if (selectedItem === null) {
				// nothing selected
				break;
			}
			ant_inputText_selected(activeItems[selectedItem]);
			event.preventDefault();
			selectedItem = null;
			break;
		default:
			// not interested in that event
	}
	if (selectedItem !== null) {
		activeItems[selectedItem].classList.add('ant-selected');
		let selectionStart = activeItems[selectedItem].offsetTop;
		let selectionStop = selectionStart + activeItems[selectedItem].clientHeight;
		let viewStart = scrollContainer.scrollTop;
		let viewStop = viewStart + scrollContainer.clientHeight;
		if (selectionStart < viewStart) {
			// element is above top edge of the container
			scrollContainer.scrollTo({
				top: selectionStart,
				left: 0,
				behavior: "smooth",
			});
		} else {
			if (selectionStop > viewStop) {
				// element is below the bottom edge of the container
				scrollContainer.scrollTo({
					top: viewStart + selectionStop - viewStop,
					left: 0,
					behavior: "smooth",
				});
			}
		}
	}
}
