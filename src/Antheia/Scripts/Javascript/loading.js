/**
 * A loading step, that includes a progress bar.
 * A loading screen can have multiple steps.
 */
class jsf_loading_step {
	static stepsContainer = null;
	constructor () {
		this.row = document.createElement("tr");
		this.iconCell = document.createElement("td");
		this.row.appendChild(this.iconCell);
		this.labelCell = document.createElement("td");
		this.row.appendChild(this.labelCell);
		this.statusCell = document.createElement("td");
		this.row.appendChild(this.statusCell);
		this.setIcon("info");
		this.setLabel("---");
		this.setProgress(null);
		if (jsf_loading_step.stepsContainer === null) {
			jsf_loading_step.stepsContainer = document.createElement("table");
		}
		jsf_loading_step.stepsContainer.appendChild(this.row);
	}
	/**
	 * Resets (removes) all existing steps from memory. The method will not
	 * update the interface. An interface update can be later started by
	 * calling jsf_loading_start() method
	 */
	static reset() {
		this.stepsContainer = null;
	}
	/**
	 * Defines the label of the step
	 * @param {String} label the label of the step, as it will be displayed
	 */
	setLabel(label) {
		this.labelCell.innerHTML = label;
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
		let cssClass = 'jsf-waiting';
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
				icon = "schedule";
				background = "var(--jsf-theme-loadingProgressRight)";
				cssClass = 'jsf-waiting';
				this.labelCell.removeAttribute("title");
				break;
			case 100:
				// the step is completed
				icon = "done";
				background = "var(--jsf-theme-loadingProgressLeft)";
				cssClass = 'jsf-completed';
				this.labelCell.removeAttribute("title");
				break;
			default:
				// the step is in progress
				icon = "hourglass_empty";
				background = "linear-gradient(to right, var(--jsf-theme-loadingProgressLeft) " 
					+ percent + "%, var(--jsf-theme-loadingProgressRight) " + percent + "%)";
				cssClass = 'jsf-running';
				this.labelCell.title = percent + '%';
		}
		this.row.style.background = background;
		this.row.classList.remove("jsf-waiting");
		this.row.classList.remove("jsf-running");
		this.row.classList.remove("jsf-completed");
		this.statusCell.innerHTML = '<i class="material-icons">' + icon + '</i>';
		this.row.classList.add(cssClass);
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
	 * @param {String} icon the name of the icon, as a material icon value
	 */
	setIcon(icon) {
		this.iconCell.innerHTML = '<i class="material-icons">' + icon + '</i>';
	}
}
/**
 * Starts the loading animation
 * @param {Boolean} formMode if defined and true then the funcion will
 * return true. Used then the function is called from the onSubmit event
 * inside a form tag
 * @returns {Boolean|void} true if formMode is true, void otherwise
 */
function jsf_loading_start(formMode) {
	formMode = formMode || false;
	let element = document.getElementById('jsf_loading');
	if (element === null) {
		element = document.createElement("div");
		element.id = "jsf_loading";
		document.body.appendChild(element);
	} else {
		element.innerHTML = '';
	}
	switch (jsf_theme_backdrop) {
		case "simple":
			element.classList.remove("jsf-blur");
			break;
		case "blur":
			element.classList.add("jsf-blur");
			break;
		default:
	}
	if (jsf_loading_step.stepsContainer === null) {
		// plain animation, with no steps
		element.classList.add("jsf-simple");
		if (formMode) {
			return true;
		}
	} else {
		// animation with steps
		element.classList.remove("jsf-simple");
		element.appendChild(jsf_loading_step.stepsContainer);
	}
}
/**
 * Stops the loading animation
 */
function jsf_loading_stop() {
	if (document.getElementById('jsf_loading') !== null) {
		document.body.removeChild(document.getElementById('jsf_loading'));
	}
}