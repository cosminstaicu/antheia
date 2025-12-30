/**
 * A loading step, that includes a progress bar.
 * A loading screen can have multiple steps.
 */
class AntheiaLoadingStep {
	/** @type {HTMLTableCellElement} */
	#iconCell;
	/** @type {HTMLTableCellElement} */
	#labelCell;
	/** @type {HTMLTableRowElement} */
	#row;
	/** @type {HTMLTableCellElement} */
	#statusCell;
	/** @type {HTMLDivElement} */
	static loadingContainer = null;
	/** @type {HTMLTableElement} */
	static stepsContainer = null;
	/** @type {HTMLDivElement} */
	static cancelButtonContainer = document.createElement("div");
	constructor () {
		this.#row = document.createElement("tr");
		this.#iconCell = document.createElement("td");
		this.#iconCell.innerHTML = '<div class="ant_loading_stepPlaceholder"></div>';
		this.#row.appendChild(this.#iconCell);
		this.#labelCell = document.createElement("td");
		this.#row.appendChild(this.#labelCell);
		this.#statusCell = document.createElement("td");
		this.#row.appendChild(this.#statusCell);
		this.setLabel("---");
		this.setProgress(null);
		if (AntheiaLoadingStep.loadingContainer === null) {
			AntheiaLoadingStep.loadingContainer = document.createElement("div");
			// adding the steps container
			AntheiaLoadingStep.stepsContainer = document.createElement("table");
			AntheiaLoadingStep.loadingContainer.appendChild(AntheiaLoadingStep.stepsContainer);
			// adding the cancel button container
			AntheiaLoadingStep.cancelButtonContainer = document.createElement("div");
			AntheiaLoadingStep.loadingContainer.appendChild(AntheiaLoadingStep.cancelButtonContainer);
		}
		AntheiaLoadingStep.stepsContainer.appendChild(this.#row);
	}
	/**
	 * Resets (removes) all existing steps from memory. The method will not
	 * update the interface. An interface update can be later started by
	 * calling ant_loading_start() method
	 */
	static reset() {
		this.loadingContainer = null;
	}
	/**
	 * Enables (or disables) a cancel button that will be displayed below the
	 * loading steps
	 * @param {{text:String, function:String}|null} buttonData info about
	 * the cancel button or null or undefined if the cancel button should be removed
	 * @param {String} buttonData.text the text to be displayed
	 * on the cancel button. If no text is provided then the "Cancel" value
	 * will be used
	 * @param {String} buttonData.function the function that will be called
	 * when the user pressed on the cancel button 
	 */
	static setCancelButton(buttonData) {
		if (buttonData === undefined) {
			buttonData = null;
		}
		AntheiaLoadingStep.cancelButtonContainer.innerHTML = '';
		if (buttonData === null) {
			return;
		}
		if (buttonData.text === undefined) {
			buttonData.text = "Cancel";
		}
		if (buttonData.function === undefined) {
			throw new Error("No function name defined inside the cancel button");
		}
		let cancelButton = document.createElement('button');
		cancelButton.innerText = buttonData.text;
		cancelButton.addEventListener("click", () => {
			window[buttonData.function]();
		});
		AntheiaLoadingStep.cancelButtonContainer.appendChild(cancelButton);
	}
	/**
	 * Defines the label of the step
	 * @param {String} label the label of the step, as it will be displayed
	 */
	setLabel(label) {
		this.#labelCell.innerHTML = label;
	}
	/**
	 * Defines the completed percent of the step, as a number between 0 and 100,
	 * or null if the step is not initialised.
	 * Null value will render the step as "waiting".
	 * A value between 0 and 99 will render the step as "inProgress" 
	 * Value 100 will render the step as finished.
	 * @param {Number|null} percent the completed percent as a number or
	 * null if the step is waiting to be started
	 */
	setProgress(percent) {
		let background = '';
		let icon = '';
		let cssClass = 'ant-waiting';
		if (percent !== null) {
			percent = Math.ceil(percent);
			if (percent < 0) {
				percent = 0;
			}
			if (percent > 100) {
				percent = 100;
			}
		}
		switch (percent) {
			case null:
				// the step is waiting to be started
				icon = "clock";
				background = "var(--ant-theme-loadingProgressRight)";
				cssClass = 'ant-waiting';
				this.#labelCell.removeAttribute("title");
				break;
			case 100:
				// the step is completed
				icon = "check";
				background = "var(--ant-theme-loadingProgressLeft)";
				cssClass = 'ant-completed';
				this.#labelCell.removeAttribute("title");
				break;
			default:
				// the step is in progress
				icon = "hourglass";
				background = "linear-gradient(to right, var(--ant-theme-loadingProgressLeft) " 
					+ percent + "%, var(--ant-theme-loadingProgressRight) " + percent + "%)";
				cssClass = 'ant-running';
				this.#labelCell.title = percent + '%';
		}
		this.#row.style.background = background;
		this.#row.classList.remove("ant-waiting");
		this.#row.classList.remove("ant-running");
		this.#row.classList.remove("ant-completed");
		if (ant_utils_getCachedSvgIcon(icon) !== null) {
			// the svg content is already in cache
			this.#statusCell.innerHTML = ant_utils_getCachedSvgIcon(icon);
		} else {
			// first a placeholder will be inserted
			this.#statusCell.innerHTML = '<div class="ant_loading_stepPlaceholder"></div>';
			// then the content will be requested from the cache
			ant_utils_getSvgIcon(icon).then((svgContent) => {
				this.#statusCell.innerHTML = svgContent;
			}).catch((error) => {
				throw error;
			});
		}	
		this.#row.classList.add(cssClass);
	}
	/**
	 * Computes the completion percent based on a total value and a completed
	 * value. Used for ease of access when a number of elements are queued for
	 * processing one by one and the total number is different then 100
	 * @param {Number} processed number of processed elements
	 * @param {Number} total total number of elements
	 */
	computeProgress(processed, total) {
		this.setProgress(Math.ceil((processed / total) * 100));
	}
	/**
	 * Defines the icon of the step, displayed near the step label
	 * @param {String} iconName the name of the icon, (a svg file, without the
	 * extension, from the Media/Icons/Vector/icons.zip file)
	 */
	setIcon(iconName) {
		if (ant_utils_getCachedSvgIcon(iconName) !== null) {
			// the svg content is already in cache
			this.#iconCell.innerHTML = ant_utils_getCachedSvgIcon(iconName);
		} else {
			// first a placeholder will be inserted
			this.#iconCell.innerHTML = '<div class="ant_loading_stepPlaceholder"></div>';
			// then the content will be requested from the cache
			ant_utils_getSvgIcon(iconName).then((svgContent) => {
				this.#iconCell.innerHTML = svgContent;
			}).catch((error) => {
				throw error;
			});
		}	
	}
}
/**
 * Starts the loading animation
 * @param {Boolean} formMode if defined and true then the funcion will
 * return true. Used then the function is called from the onSubmit event
 * inside a form tag
 * @returns {Boolean|void} true if formMode is true, void otherwise
 */
function ant_loading_start(formMode) {
	formMode = formMode || false;
	let element = document.getElementById('ant_loading');
	if (element === null) {
		element = document.createElement("div");
		element.id = "ant_loading";
		document.body.appendChild(element);
	} else {
		element.innerHTML = '';
	}
	switch (ant_theme_backdrop) {
		case "simple":
			element.classList.remove("ant-blur");
			break;
		case "blur":
			element.classList.add("ant-blur");
			break;
		default:
	}
	if (AntheiaLoadingStep.loadingContainer === null) {
		// plain animation, with no steps
		element.classList.add("ant-simple");
		if (formMode) {
			return true;
		}
	} else {
		// animation with steps
		element.classList.remove("ant-simple");
		element.appendChild(AntheiaLoadingStep.loadingContainer);
	}
}
/**
 * Stops the loading animation
 */
function ant_loading_stop() {
	if (document.getElementById('ant_loading') !== null) {
		document.body.removeChild(document.getElementById('ant_loading'));
	}
}