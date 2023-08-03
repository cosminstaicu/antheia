/**
 * Defines a modal that contains a menu with options rendered as buttons
 */
class ant_modalMenu extends ant_modal {
	constructor() {
		super();
		this.addContentClass('ant_modalMenu');
	}
	/**
	 * Adds an item to the menu and returns the item (the button that was added).
	 * @param {Object} options options for the item
	 * @param {String} options.icon the icon that will be shown at the top of
	 * the button, as the name of a png file (without the .png extension)
	 * inside the 32x32 media folder
	 * @param {String} options.iconAddon the small icon that will be displayed
	 * on the bottom right side of the main icon, as the name of a png file
	 * (without the .png extension) inside the 16x16 media folder
	 * @param {String} options.title the title of the menu
	 * @param {String} options.description the description of the menu
	 * @returns {HTMLButtonElement} the button that will be displayed
	 */
	addMenuOption(options) {
		if (options === undefined) {
			options = {};
		}
		if (options.icon === undefined) {
			options.icon = "default";
		}
		if (options.iconAddon === undefined) {
			options.iconAddon = "";
		}
		if (options.title === undefined) {
			options.title = '';
		}
		if (options.description === undefined) {
			options.description = '';
		}
		let item = document.createElement('button');
		let addonUrl = '';
		if (options.iconAddon !== '') {
			addonUrl += "&a=" + options.iconAddon;
		}
		item.innerHTML = '<img src="' + ant_antheiaCacheUrl 
			+ 'iconPixel32.php?i=' + options.icon + addonUrl
			+ '" width=32 height=32 alt="Icon"><p>'
			+ options.title +'</p><p>' + options.description + '</p>';
		this.appendContent(item);
		return item;
	}
}