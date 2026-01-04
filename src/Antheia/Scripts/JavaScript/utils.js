/**
 * A cache for svg icons used inside the framework
 * @type {Object.<string, string>}
 */
let ant_utils_svgCache = {};
/**
 * Cached info about the status of the test mode.
 * If the variable is null then test mode has not been checked and cached
 * @type {{
 * 	status : Boolean,
 * 	attributeName : String,
 * 	useDataset : Boolean
 * }}
 */
let ant_utils_testMode = null;
/**
 * Returns the svg content of a file inside the Media/Icons/Vector/icons.zip
 * archive. The content is cached, so future calls will return the content
 * from memory. It can be used to preload the icon, for future calls,
 * as the icon can be used inside the loading steps
 * @param {String} name the name of the file, without the svg extension
 * @returns {Promise<string>} the content of the file
 */
function ant_utils_getSvgIcon(name) {
	if (name === undefined) {
		return Promise.reject('Undefined name');
	}
	if (ant_utils_svgCache[name] !== undefined) {
		return Promise.resolve(ant_utils_svgCache[name]);
	}
	return new Promise((resolve, reject) => {
		fetch(
			ant_antheiaCacheUrl + 'iconVector.php?i=' + name
		).then((response) => {
			if (!response.ok) {
				return Promise.reject(
					'Icon request status ' + response.status + ' for ' + name
				);
			}
			return response.text();
		}).then((svgContent) => {
			ant_utils_svgCache[name] = svgContent;
			resolve(svgContent);
		}).catch((error) => {
			reject(error)
		});
	});
}
/**
 * Returns the content of a svg icon from cache. If the icon is not cached,
 * null will be returned. To load and get the content from the external zip file
 * ant_utils_getSvgIcon(name) should be used
 * @param {String} name the name of the file, without the svg extension
 * @return {String|null} the content of the svg file (if cached) or null if the
 * file is not cached
 */
function ant_utils_getCachedSvgIcon(name) {
	if (ant_utils_svgCache[name] !== undefined) {
		// the svg content is already in cache
		return ant_utils_svgCache[name];
	} else {
		return null;
	}
}
/**
 * Changes the page title (the window title and the header title)
 * @param {String} title the new title of the page
 */
function ant_utils_changePageTitle(title) {
	document.title = title;
	document.querySelector("h1").innerText = title;
}
/**
 * Shows the page menu container (if it is hidden)
 */
function ant_utils_showPageMenu() {
	let menu = document.querySelector(".ant_menu");
	if (menu !== null) {
		menu.classList.add("ant-active");
	}
}
/**
 * Hides the page menu container
 */
function ant_utils_hidePageMenu() {
	let meniu = document.querySelector(".ant_menu");
	if (meniu !== null) {
		meniu.classList.remove("ant-active");
	}
}
/**
 * Shows a page menu item (if it is hidden)
 * @param {String} id the id of the menu to be shown
 */
function ant_utils_showPageMenuItem(id) {
	document.getElementById(id).classList.remove("ant-hidden");
}
/**
 * Hides a page menu item
 * @param {String} id the id of the menu to be hidden
 */
function ant_utils_hidePageMenuItem(id) {
	document.getElementById(id).classList.add("ant-hidden");
}
/**
 * The function checkes if an input has a pre callback defined and runs it,
 * if available. It is triggered just after the user has pressed an input button
 * that will display an interface, but just before the interface is displayed
 * @param {Element} input the input to be checked
 */
function ant_utils_preCallback(input) {
	ant_utils_inputCallback(input, 'pre');
}
/**
 * The function checkes if an input has a post callback defined and runs it,
 * if available. It is triggered for inputs that have additional interfaces,
 * like file, new passwords etc. It is triggered after the input has been updated
 * @param {Element} input the input to be checked
 */
function ant_utils_postCallback(input) {
	ant_utils_inputCallback(input, 'post');
}
/**
 * The function checkes if an input has an callback defined and runs it,
 * if available
 * @param {Element} input the input to be checked
 * @param {"pre"|"post"} action the action to be checked. It can be "pre" (before
 * any input interface is displayed) or "post" (the user has selected a value,
 * the input has been updated and the interface has been deleted)
 */
function ant_utils_inputCallback(input, action) {
	if (input.dataset[action] === undefined) {
		return false;
	}
	if (input.dataset[action] === '') {
		return false;
	}
	if (window[input.dataset[action]] === undefined) {
		throw new Error(action + " function is undefined: " + input.dataset[action]);
	}
	window[input.dataset[action]](input);
}
/**
 * Injects the test attribute (if available) inside an html element.
 * The attribute is available only if test mode is enabled from php.
 * If test mode is not active, this function has no effect
 * @param {HTMLElement} htmlElement the element where the value will be
 * inserted into
 * @param {String} testIdValue the value of the testAttribute property 
 */
function ant_utils_injectTestAttribute(htmlElement, testIdValue) {
	if (ant_utils_testMode === null) {
		// test mode has not been checked yet
		ant_utils_testMode = {
			status : false,
			useDataset : false,
			attributeName : ''
		};
		if (typeof ant_testIdAttribute === 'undefined') {
			ant_utils_testMode = {
				status : false
			};
		} else {
			ant_utils_testMode = {
				status : true
			};
			if (ant_testIdAttribute.slice(0, 5) === 'data-') {
				ant_utils_testMode.useDataset = true;
				ant_utils_testMode.attributeName = ant_testIdAttribute.slice(5);
			} else {
				ant_utils_testMode.useDataset = false;
				ant_utils_testMode.attributeName = ant_testIdAttribute;
			}
		}
	}
	if (ant_utils_testMode.status) {
		// test mode is active, so the property will be inserted into the element
		if (ant_utils_testMode.useDataset) {
			htmlElement.dataset[ant_utils_testMode.attributeName] = testIdValue;
		} else {
			htmlElement[ant_utils_testMode.attributeName] = testIdValue;
		}
	}
}
/**
 * Checks if the browser is compatible with the framework. The function checks
 * if the javascript features used by the framework are available.
 * The calling function will catch any error generated by this function and
 * will redirect the browser to a details page.
 */
function ant_utils_checkCompatibility() {
	let newClass = new AntheiaAlert();
	newClass.setButtonLabel('Just a test');
	if (document.getElementById('ant_compatibilityScript') !== null) {
		setTimeout(() => {
			document.getElementById('ant_compatibilityScript').remove();
		}, 1000);
	}
}
