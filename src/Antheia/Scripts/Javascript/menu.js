/**
 * Toogles the visibility of a menu container. Called when the user presses
 * the button that toogles the menu
 * @param {Element} element the item clicked by the user
 */
function jsf_menu_toogle(element) {
	element.parentElement.classList.toggle("jsf-active");
}
