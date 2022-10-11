/**
 * Toggles the main menu
 */
function ant_appMenu_toggle() {
	document.getElementById('ant_appMenu').classList.toggle("ant-enabled");
}
/**
 * Toggles the submenu list from a menu.
 * @param {Element} element the menu that contains the submenu
 */
function ant_appMenu_toggleSubmenu(element) {
	let i = 0;
	let menus = element.parentElement.children;
	for (i = 0; i < menus.length; i++) {
		if (menus[i] !== element) {
			menus[i].classList.remove('ant-selected');
		}
	}
	element.classList.toggle("ant-selected");
}