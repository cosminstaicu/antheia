/**
 * The function is called when the user has pressed a button for inputting
 * a new password
 * @param {Element} element the button that has been pressed
 */
function jsf_inputNewPassword_start(element) {
	jsf_utils_preCallback(element.nextElementSibling.nextElementSibling);
	let inputHidden = element.nextElementSibling.nextElementSibling;
	let modal = new jsf_modal();
	let items = {};
	items.trigger = element;
	items.rules = {};
	items.inputNew = document.createElement("input");
	items.inputRepeat = document.createElement("input");
	modal.setHeader(element.dataset.label);
	modal.setContentAlign('left');
	let form = document.createElement("form");
	form.id = "jsf_inputNewPassword";
	form.onsubmit = () => {
		if (!jsf_inputNewPassword_check(items)) {
			return false;
		}
		inputHidden.value = items.inputNew.value;
		element.value = element.dataset.textFinal;
		modal.hide();
		jsf_forms_updateStatus(inputHidden.id);
		jsf_utils_postCallback(inputHidden);
		return false;
	};
	let label = null;
	let input = null;
	let div = null;
	let paragraph = null;
	let rules = null;
	let rule = null;
	// the container with the password mandatory rules
	div = document.createElement("div");
	// info
	paragraph = document.createElement("p");
	paragraph.innerHTML = element.dataset.textMustContain;
	div.appendChild(paragraph);
	// mandatory rules list
	rules = document.createElement("ul");
	rule = document.createElement("li");
	rule.innerHTML = element.dataset.textMin + " " + element.dataset.min 
			+ " " + element.dataset.textChr;
	rules.appendChild(rule);
	items.rules.min = rule;
	if (element.dataset.max !== "0") {
		rule = document.createElement("li");
		rule.innerHTML = element.dataset.textMax + " " + element.dataset.max
				+ " " + element.dataset.textChr;
		rules.appendChild(rule);
		items.rules.max = rule;
	}
	if (element.dataset.onlyDigits === "yes") {
		rule = document.createElement("li");
		rule.innerHTML = element.dataset.textOnlyDigits;
		rules.appendChild(rule);
		items.rules.justDigits = rule;
	}
	if (element.dataset.uppercase === "yes") {
		rule = document.createElement("li");
		rule.innerHTML = element.dataset.textUppercase;
		rules.appendChild(rule);
		items.rules.uppercase = rule;
	}
	if (element.dataset.lowercase === "yes") {
		rule = document.createElement("li");
		rule.innerHTML = element.dataset.textLowercase;
		rules.appendChild(rule);
		items.rules.lowercase = rule;
	}
	if (element.dataset.digits === "yes") {
		rule = document.createElement("li");
		rule.innerHTML = element.dataset.textDigits;
		rules.appendChild(rule);
		items.rules.digits = rule;
	}
	if (element.dataset.symbols === "yes") {
		rule = document.createElement("li");
		rule.innerHTML = element.dataset.textSymbols;
		rules.appendChild(rule);
		items.rules.symbols = rule;
	}
	rule = document.createElement("li");
	rule.innerHTML = element.dataset.textIdentical;
	rules.appendChild(rule);
	items.rules.identical = rule;
	div.appendChild(rules);
	form.appendChild(div);
	// a hidden text input for username
	// used for browser keychain compatibility
	if (element.dataset.username !== '') {
		input = document.createElement("input");
		input.type = "text";
		input.name = "username";
		input.autocomplete = "username";
		input.value = element.dataset.username;
		input.style.display = "none";
		form.appendChild(input);
	}
	// type password input
	label = document.createElement("label");
	label.innerHTML = element.dataset.textNewPassword;
	label.for = "jsf_inputNewPassword_new";
	form.appendChild(label);
	div = document.createElement("div");
	div.classList.add("jsf_form-item");
	div.classList.add("jsf-status");
	div.classList.add("jsf-valid");
	items.inputNew.type = "password";
	items.inputNew.placeholder
		= "---" + element.dataset.textNewPassword.toLowerCase() + "---";
	items.inputNew.id = "jsf_inputNewPassword_new";
	items.inputNew.autocomplete = "new-password";
	items.inputNew.addEventListener("change", () => {
		jsf_inputNewPassword_check(items);
	});
	items.inputNew.addEventListener("keyup", () => {
		jsf_inputNewPassword_check(items);
	});
	div.appendChild(items.inputNew);
	form.appendChild(div);
	// retype password input
	label = document.createElement("label");
	label.innerHTML = element.dataset.textRetype;
	label.for = "jsf_inputNewPassword_repeat";
	form.appendChild(label);
	div = document.createElement("div");
	div.classList.add("jsf_form-item");
	div.classList.add("jsf-status");
	div.classList.add("jsf-valid");
	items.inputRepeat.type = "password";
	items.inputRepeat.placeholder 
		= "---" + element.dataset.textRetype.toLowerCase() + "---";
	items.inputRepeat.id = "jsf_inputNewPassword_repeat";
	items.inputRepeat.autocomplete = "new-password";
	items.inputRepeat.addEventListener("change", () => {
		jsf_inputNewPassword_check(items);
	});
	items.inputRepeat.addEventListener("keyup", () => {
		jsf_inputNewPassword_check(items);
	});
	div.appendChild(items.inputRepeat);
	form.appendChild(div);
	// submit button
	div = document.createElement("div");
	input = document.createElement("input");
	input.type = "submit";
	input.value = element.dataset.textSubmit;
	div.appendChild(input);
	form.appendChild(div);
	modal.setContent(form);
	modal.show();
	jsf_inputNewPassword_check(items);
	items.inputNew.focus();
}
/**
 * Updates the interface with the defined rules status
 * @param {Object} items the items used by the process
 * @param {HTMLElement} items.trigger the button that triggered the modal
 * @param {Object} items.rules the rules used for complexity validation
 * @param {HTMLElement} items.inputNew the input with the password
 * @param {HTMLElement} items.inputRepeat the input with the retyped password
 * @returns {Boolean} true if the password complies will all defined rules,
 * false if not
 */
function jsf_inputNewPassword_check(items) {
	let i = 0;
	let asciiCode = 0;
	let validRules = true;
	let password = items.inputNew.value;
	let retyped = items.inputRepeat.value;
	// rules to be checked
	let ruleOnlyDigits = true;
	let ruleDigits = false;
	let ruleUppercase = false;
	let ruleLowercase = false;
	let ruleSymbols = false;
	if (password === "") {
		ruleOnlyDigits = false;
	}
	// checking every character inside the password
	for (i = 0; i < password.length; i++) {
		asciiCode = password.charCodeAt(i);
		if (asciiCode < 32) {
			// ignoring any control characters
			continue;
		}
		if ( (48 <= asciiCode) && (asciiCode <= 57) ) {
			// a digit
			ruleDigits = true;
			continue;
		}
		// if here then this is not a digit
		ruleOnlyDigits = false;
		if ( (65 <= asciiCode) && (asciiCode <= 90) ) {
			// uppercase letter
			ruleUppercase = true;
			continue;
		}
		if ( (97 <= asciiCode) && (asciiCode <= 122) ) {
			// lowercase letter
			ruleLowercase = true;
			continue;
		}
		// if here then this is a special character
		ruleSymbols = true;
	}
	if (password.length < parseInt(items.trigger.dataset.min)) {
		validRules = false;
		items.rules.min.classList.add("jsf-invalid");	
	} else {
		items.rules.min.classList.remove("jsf-invalid");
	}
	if (items.trigger.dataset.max !== "0") {
		if (parseInt(items.trigger.dataset.max) < password.length) {
			validRules = false;
			items.rules.max.classList.add("jsf-invalid");	
		} else {
			items.rules.max.classList.remove("jsf-invalid");	
		}
	}
	if (items.trigger.dataset.onlyDigits === "yes") {
		if (!ruleOnlyDigits) {
			validRules = false;
			items.rules.justDigits.classList.add("jsf-invalid");	
		} else {
			items.rules.justDigits.classList.remove("jsf-invalid");	
		}
	}
	if (items.trigger.dataset.uppercase === "yes") {
		if (!ruleUppercase) {
			validRules = false;
			items.rules.uppercase.classList.add("jsf-invalid");	
		} else {
			items.rules.uppercase.classList.remove("jsf-invalid");	
		}
	}
	if (items.trigger.dataset.lowercase === "yes") {
		if (!ruleLowercase) {
			validRules = false;
			items.rules.lowercase.classList.add("jsf-invalid");	
		} else {
			items.rules.lowercase.classList.remove("jsf-invalid");	
		}
	}
	if (items.trigger.dataset.digits === "yes") {
		if (!ruleDigits) {
			validRules = false;
			items.rules.digits.classList.add("jsf-invalid");	
		} else {
			items.rules.digits.classList.remove("jsf-invalid");	
		}
	}
	if (items.trigger.dataset.symbols === "yes") {
		if (!ruleSymbols) {
			validRules = false;
			items.rules.symbols.classList.add("jsf-invalid");	
		} else {
			items.rules.symbols.classList.remove("jsf-invalid");	
		}
	}
	if (validRules) {
		items.inputNew.parentElement.classList.add("jsf-valid");
		items.inputNew.parentElement.classList.remove("jsf-invalid");
	} else {
		items.inputNew.parentElement.classList.add("jsf-invalid");
		items.inputNew.parentElement.classList.remove("jsf-valid");
	}
	let identicalPasswords = true;
	if ( (password === "") && (retyped === "")) {
		identicalPasswords = false;
		validRules = false;
	} else {
		if (password === retyped) {
			identicalPasswords = true;
		} else {
			identicalPasswords = false;
			validRules = false;
		}
	}
	if (identicalPasswords) {
		items.rules.identical.classList.remove("jsf-invalid");
		items.inputRepeat.parentElement.classList.add("jsf-valid");
		items.inputRepeat.parentElement.classList.remove("jsf-invalid");
	} else {
		items.rules.identical.classList.add("jsf-invalid");
		items.inputRepeat.parentElement.classList.add("jsf-invalid");
		items.inputRepeat.parentElement.classList.remove("jsf-valid");
	}
	return validRules;
}