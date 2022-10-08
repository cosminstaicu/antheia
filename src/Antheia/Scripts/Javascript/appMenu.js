/**
 * Toggles the main menu
 */
function jsf_appMenu_toggle() {
	document.getElementById('jsf_appMenu').classList.toggle("jsf-enabled");
}
/**
 * Toggles the submenu list from a menu.
 * @param {Element} element the menu that contains the submenu
 */
function jsf_appMenu_toggleSubmenu(element) {
	let i = 0;
	let menus = element.parentElement.children;
	for (i = 0; i < menus.length; i++) {
		if (menus[i] !== element) {
			menus[i].classList.remove('jsf-selected');
		}
	}
	element.classList.toggle("jsf-selected");
}