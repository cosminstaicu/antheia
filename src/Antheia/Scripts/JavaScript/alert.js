/**
 * Defines an alert message with an ok button
 */
 class ant_alert {
	/** @type {ant_modal} */
	#modal;
	/** @type {HTMLInputElement} */
	#okButton;
	/** @type {CallableFunction|null} */
	#onClose;
	constructor () {
		this.#modal = new ant_modal();
		this.#modal.setContent('---');
		this.#okButton = document.createElement("INPUT");
		this.#okButton.type = "button";
		this.#okButton.value = ant_text["ok"];
		this.#okButton.classList.add("ant_modal-footer-button");
		this.#okButton.onclick = () => {
			this.#modal.hide();
		}
		this.#modal.setOnClose(() => {
			if (this.#onClose !== null) {
				this.#onClose();
			}
		});
		this.#modal.appendFooter(this.#okButton);
		this.#modal.setContentAlign('center');
		this.#modal.setFooterAlign('center');
		this.#onClose = null;
	}
	/**
	 * Defines the text to be displayed on the ok button
	 * @param {String} label the text to be displayed on the ok button
	 */
	setButtonLabel(label) {
		this.#okButton.value = label;
	}
	/**
	 * Defines the text to be displayed to the user, with info about the operation
	 * @param {String} infoText the text to be displayed to the user
	 */
	setText(infoText) {
		this.#modal.setContent(infoText);
	}
	/**
	 * Set the function that will be called when the user presses the ok
	 * button or the entire modal is closed.
	 * @param {CallableFunction|null} callback the callback to be executed when
	 * the user presses the ok button or null if no action is required
	 */
	setOnClose(callback) {
		this.#onClose = callback;
	}
	/**
	 * Shows the confirmation modal
	 */
	show() {
		this.#modal.show();
		this.#okButton.focus();
	}
	/**
	 * A quick static method for showing an alert as an error
	 * @param {String} infoText the text to be displayed to the user
	 * @param {CallableFunction} onClose the callback executed when the user
	 * presses the ok button or the entire modal is closed
	 */
	static quickError(infoText, onClose) {
		let alertModal = new ant_alert();
		alertModal.setText(infoText);
		if (onClose !== undefined) {
			alertModal.setOnClose(onClose);
		}
		alertModal.show();
	}
	/**
	 * A quick static method for showing an alert as an info
	 * @param {String} infoText the text to be displayed to the user
	 * @param {CallableFunction} onClose the callback executed when the user
	 * presses the ok button or the entire modal is closed
	 */
	static quickInfo(infoText, onClose) {
		let alertModal = new ant_alert();
		alertModal.setText(infoText);
		if (onClose !== undefined) {
			alertModal.setOnClose(onClose);
		}
		alertModal.show();
	}
}