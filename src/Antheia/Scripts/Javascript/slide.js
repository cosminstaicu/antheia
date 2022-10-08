/**
 * Toogles a slide between expanded and condensed status
 * @param {Element} element the button pressed by the user
 */
function jsf_slide_click(element) {
	if (element.classList.contains("jsf-enabled")) {
		element.classList.remove("jsf-enabled");
		document.getElementById(element.dataset.container).classList.remove("jsf-enabled");
	} else {
		element.classList.add("jsf-enabled");
		document.getElementById(element.dataset.container).classList.add("jsf-enabled");
	}
	if (element.dataset.post !== undefined) {
		if (element.dataset.post !== "") {
			window[element.dataset.post](element);
		}
	}
}