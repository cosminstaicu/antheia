/**
 * Toogles the accordion item being clicked and collapse all other items
 * @param {HTMLButtonElement} element the item that has been selected to be expanded
 */
function ant_accordion_click(element) {
	let i = 0;
	let items = element.parentElement.children;
	for (i = 0; i < items.length; i++) {
		if (items[i] === element) {
			element.classList.toggle('ant-selected');
		} else {
			items[i].classList.remove('ant-selected');
		}
	}
}