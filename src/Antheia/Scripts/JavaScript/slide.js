/**
 * Toogles a slide between expanded and condensed status
 * @param {HTMLButtonElement} element the button pressed by the user
 */
function ant_slide_click(element) {
	if (element.classList.contains("ant-enabled")) {
		element.classList.remove("ant-enabled");
		document.getElementById(element.dataset.container).classList.remove("ant-enabled");
	} else {
		element.classList.add("ant-enabled");
		document.getElementById(element.dataset.container).classList.add("ant-enabled");
	}
	if (element.dataset.post !== undefined) {
		if (element.dataset.post !== "") {
			window[element.dataset.post](element);
		}
	}
}