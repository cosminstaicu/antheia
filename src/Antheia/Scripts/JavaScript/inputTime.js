let ant_inputTime_process = null;
/**
 * Called when the user presses the button to select or input a time value
 * @param {Element} element the button pressed by the user
 */
function ant_inputTime_start(element) {
	ant_inputTime_process = {
		modal : null,
		trigger : element,
		hiddenInput : element.nextElementSibling.nextElementSibling,
		selectMode : false,
		selectedHour : 0,
		selectedMinute : 0
	};
	ant_utils_preCallback(ant_inputTime_process.hiddenInput);
	let i = 0;
	let hourInput = null;
	let minuteInput = null;
	ant_inputTime_process.modal = new ant_modal();
	ant_inputTime_process.modal.setHeader(element.dataset.label);
	ant_inputTime_process.modal.addContentClass("ant_inputTime");
	ant_inputTime_process.modal.setOnClose(() => {
		ant_inputTime_process = null;
	});
	if (element.dataset.select === 'active') {
		ant_inputTime_process.selectMode = true;
	}
	if (ant_inputTime_process.selectMode) {
		let hourDiv = document.createElement("div");
		let title = document.createElement("p");
		title.innerHTML = "<b>" + element.dataset.textHour + "</b>:" + element.dataset.textMinute;
		hourDiv.appendChild(title);
		let start = parseInt(element.dataset.hourMin);
		let stop = parseInt(element.dataset.hourMax);
		let step = parseInt(element.dataset.hourStep);
		let option = null;
		hourDiv.id = "ant_inputTime-hours";
		for (i = start; i <= stop; i += step) {
			option = document.createElement("button");
			if (i < 10) {
				option.innerHTML = "<b>0" + i + "</b>:--";
			} else {
				option.innerHTML = "<b>" + i + "</b>:--";
			}
			option.dataset.value = i;
			option.onclick = function () {
				// the user clicked on a hour
				let i = 0;
				let option = null;
				let hourText = this.dataset.value;
				if (this.dataset.value < 10) {
					hourText = "0" + this.dataset.value;
				}
				hourText += ":<b>";
				if (this.dataset.value < 10) {
					ant_inputTime_process.selectedHour = "0" + this.dataset.value;
				} else {
					ant_inputTime_process.selectedHour = this.dataset.value;
				}
				let minuteDiv = document.createElement("div");
				let title = document.createElement("p");
				title.innerHTML = ant_inputTime_process.trigger.dataset.textHour + ":<b>" 
					+ ant_inputTime_process.trigger.dataset.textMinute + "</b>";
				minuteDiv.appendChild(title);
				minuteDiv.id = "ant_inputTime-minutes";
				let start = parseInt(ant_inputTime_process.trigger.dataset.minuteMin);
				let stop = parseInt(ant_inputTime_process.trigger.dataset.minuteMax);
				let step = parseInt(ant_inputTime_process.trigger.dataset.minuteStep);
				for (i = start; i <= stop; i += step) {
					option = document.createElement("button");
					if (i < 10) {
						option.innerHTML = hourText + "0" + i + "</b>";
					} else {
						option.innerHTML = hourText + i + "</b>";
					}
					option.dataset.value = i;
					option.onclick = function () {
						let value = ant_inputTime_process.selectedHour + ":";
						if (this.dataset.value < 10) {
							value += "0";
						}
						value += this.dataset.value;
						ant_inputTime_update(value);
					}
					minuteDiv.appendChild(option);
				}
				ant_inputTime_process.modal.setContent(minuteDiv);
			}
			hourDiv.appendChild(option);
		}
		ant_inputTime_process.modal.appendContent(hourDiv);
	} else {
		// hour label
		let hourLabel = document.createElement("label");
		hourLabel.for = "ant_inputTime_ora";
		hourLabel.innerHTML = element.dataset.textHour;
		ant_inputTime_process.modal.appendContent(hourLabel);
		// hour input
		hourInput = document.createElement("input");
		hourInput.type = "number";
		hourInput.id = "ant_inputTime_ora";
		hourInput.name = "hour";
		hourInput.value = "";
		hourInput.maxLength = 2;
		hourInput.min = 0;
		hourInput.max = 23;
		ant_inputTime_process.modal.appendContent(hourInput);
		// minute label
		let minuteLabel = document.createElement("label");
		minuteLabel.for = "ant_inputTime_minut";
		minuteLabel.innerHTML = element.dataset.textMinute;
		ant_inputTime_process.modal.appendContent(minuteLabel);
		// minute input
		minuteInput = document.createElement("input");
		minuteInput.type = "number";
		minuteInput.id = "ant_inputTime_minut";
		minuteInput.name = "minute";
		minuteInput.value = "";
		minuteInput.maxLength = 2;
		minuteInput.min = 0;
		minuteInput.max = 59;
		ant_inputTime_process.modal.appendContent(minuteInput);	
	}
	// footer
	if (element.dataset.showUndefined === "yes") {
		let button = document.createElement("input");
		button.type = "button";
		button.classList.add("ant_form-undefined-button");
		button.value = element.dataset.textUndefined;
		button.dataset.value = element.dataset.undefinedValue;
		button.onclick = function () {
			ant_inputTime_update(this.dataset.value);
		}
		ant_inputTime_process.modal.appendFooter(button);
	}
	// submit button
	if (!ant_inputTime_process.selectMode) {
		let button = document.createElement("input");
		button.type = "button";
		button.value = element.dataset.textSubmit;
		button.onclick = () => {
			let hour = hourInput.value;
			let minute = minuteInput.value;
			let errorText = element.dataset.textError;
			if (hour === "") {
				ant_alert.quickError(errorText, () => {
					hourInput.focus();
				});
				return false;
			}
			if (minute === "") {
				minute = 0;
			}
			hour = parseInt(hour);
			minute = parseInt(minute);
			if (isNaN(hour)) {
				ant_alert.quickError(errorText, () => {
					hourInput.focus();
				});
				return false;
			}
			if (isNaN(minute)) {
				ant_alert.quickError(errorText, () => {
					minuteInput.focus();
				});
				return false;
			}
			if ( (hour % 1) !== 0) {
				ant_alert.quickError(errorText, () => {
					hourInput.focus();
				});
				return false;
			}
			if ( (minute % 1) !== 0) {
				ant_alert.quickError(errorText, () => {
					minuteInput.focus();
				});
				return false;
			}
			if ((hour < 0 ) || (hour > 23)) {
				ant_alert.quickError(errorText, () => {
					hourInput.focus();
				});
				return false;
			}
			if ((minute < 0 ) || (minute > 59)) {
				ant_alert.quickError(errorText, () => {
					minuteInput.focus();
				});
				return false;
			}
			if (hour < 10) {
				hour = "0" + hour;
			}
			if (minute < 10) {
				minute = "0" + minute;
			}
			ant_inputTime_update(hour + ":" + minute);
		}
		ant_inputTime_process.modal.appendFooter(button);
	}
	ant_inputTime_process.modal.show();
	if (!ant_inputTime_process.selectMode) {
		hourInput.focus();
	}
}
/**
 * Called when a value is selected. The original input will be updated
 * @param {String} value the value to be updated
 */
function ant_inputTime_update(value) {
	if (ant_inputTime_process === null) {
		// the user closed the modal
		return false;
	}
	let hiddenInput = ant_inputTime_process.hiddenInput;
	if (value === ant_inputTime_process.trigger.dataset.undefinedValue) {
		ant_inputTime_process.trigger.value 
			= ant_inputTime_process.trigger.dataset.textUndefined;
	} else {
		ant_inputTime_process.trigger.value = value;
	}
	hiddenInput.value = value;
	ant_forms_updateStatus(hiddenInput.id);
	ant_inputTime_process.modal.hide();
	ant_utils_postCallback(hiddenInput);
}