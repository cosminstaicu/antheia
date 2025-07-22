/**
 * Toggles the hidden options inside a WireframeInput
 * @param {HTMLButtonElement} button the button that has been clicked
 * by the user
 */
function ant_wireframe_toggleMoreOptions(button) {
	let wireframe = null;
	/** @type {HTMLElement} */
	let currentElement = button;
	while (wireframe === null) {
		if (currentElement.parentElement === null) {
			throw new Error('Unable to find parent wireframe');
		}
		if (currentElement.parentElement.classList.contains('contains-input-hidden-default')) {
			// found the wireframe
			currentElement.parentElement.classList.toggle('hide-input-hidden-default');
			break;
		} else {
			currentElement = currentElement.parentElement;
		}
	}
}