/**
 * Toogles the visibility of a menu container. Called when the user presses
 * the button that toogles the menu
 * @param {HTMLButtonElement} element the item clicked by the user
 */
function ant_menu_toogle(element) {
	element.parentElement.classList.toggle("ant-active");
}
