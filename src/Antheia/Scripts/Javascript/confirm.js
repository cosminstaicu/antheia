/**
 * Defines a confirmation message, with 2 options: ok and cancel
 */
 class jsf_confirm {
	constructor () {
		this.modal = new jsf_modal();
		this.modal.setContent('?');
		this.cancelButton = document.createElement("INPUT");
		this.cancelButton.type = "button";
		this.cancelButton.value = jsf_text["cancel"];
		this.cancelButton.classList.add("jsf_modal-footer-button");
		this.cancelButton.onclick = () => {
			this.optionSelected = true;
			if (this.onCancel !== null) {
				this.onCancel();
			}
			this.modal.hide();
		}
		this.submitButton = document.createElement("INPUT");
		this.submitButton.type = "button";
		this.submitButton.value = jsf_text["ok"];
		this.submitButton.classList.add("jsf_modal-footer-button");
		this.submitButton.onclick = () => {
			this.optionSelected = true;
			if (this.onSubmit !== null) {
				this.onSubmit();
			}
			this.modal.hide();
		}
		this.modal.setOnClose(() => {
			if (this.optionSelected) {
				// an option has been selected, so no further actions
				// are performed
				this.optionSelected = false;
				return false;
			}
			if (this.onCancel !== null) {
				this.onCancel();
			}
		});
		this.modal.appendFooter(this.cancelButton);
		this.modal.appendFooter(this.submitButton);
		this.modal.setContentAlign('center');
		this.modal.setFooterAlign('center');
		this.onSubmit = null;
		this.onCancel = null;
		this.optionSelected = false;
	}
	/**
	 * Defines the text to be displayed on the submit button
	 * @param {String} label the text to be displayed on the submit button
	 */
	setSubmitLabel(label) {
		this.submitButton.value = label;
	}
	/**
	 * Defines the text to be displayed on the cancel button
	 * @param {String} label the text to be displayed on the cancel button
	 */
	setCancelLabel(label) {
		this.cancelButton.value = label;
	}
	/**
	 * Defines the text to be displayed to the user, with info about the operation
	 * @param {String} infoText the text to be displayed to the user
	 */
	setText(infoText) {
		this.modal.setContent(infoText);
	}
	/**
	 * Set the function that will be called when the user presses the submit
	 * button.
	 * @param {CallableFunction|null} callback the callback to be executed when
	 * the user presses the submit button or null if no action is required
	 */
	setOnSubmit(callback) {
		this.onSubmit = callback;
	}
	/**
	 * Set the function that will be called when the user presses the cancel
	 * button.
	 * @param {CallableFunction|null} callback the callback to be executed when
	 * the user presses the cancel button or null if no action is required
	 */
	setOnCancel(callback) {
		this.onCancel = callback;
	}
	/**
	 * Shows the confirmation modal
	 */
	show() {
		this.optionSelected = false;
		this.modal.show();
	}
	/**
	 * A quick static method for showing a confirmation dialog
	 * @param {String} infoText the text to be displayed to the user
	 * @param {CallableFunction} onSubmit the callback executed when the user
	 * presses the submit button
	 * @param {CallableFunction} onCancel (optional) the callback executed
	 * when the user presses the cancel button or just closes the interface
	 */
	static quick(infoText, onSubmit, onCancel) {
		let confirm = new jsf_confirm();
		confirm.setText(infoText);
		confirm.setOnSubmit(onSubmit);
		if (onCancel !== undefined) {
			confirm.setOnCancel(onCancel);
		}
		confirm.show();
	}
}