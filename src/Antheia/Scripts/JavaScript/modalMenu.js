/**
 * Defines a modal that contains a menu with options rendered as buttons
 */
class AntheiaModalMenu extends AntheiaModal {
	constructor() {
		super();
		this.addContentClass('ant_modalMenu');
	}
	/**
	 * Adds an item to the menu and returns the item (the button that was added).
	 * @param {Object} options options for the item
	 * @param {String} options.icon the icon that will be shown at the top of
	 * the button, as the name of a png/svg file (without the extension)
	 * inside the Media/Icons/Pixel or Media/Icons/Vector folder
	 * @param {String} options.iconAddon (only available for pixel type icons)
	 * the small icon that will be displayed on the bottom right side of the
	 * main icon, as the name of a png file (without the .png extension) inside
	 * the 16x16 media folder
	 * @param {'pixel'|'vector'} options.iconType (default 'pixel') the type of
	 * icon to be displayed: pixel (created from a png file, inside the
	 * Media/Icons/Pixel/32px.zip file) or vector (created from a svg file,
	 * inside the Media/Icons/Vector/icons.zip file)
	 * @param {String} options.title the title of the menu
	 * @param {String} options.description the description of the menu
	 * @param {String} options.id the id of the button or null for no id
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
		if (options.iconType === undefined) {
			options.iconType = "pixel";
		}
		if (options.title === undefined) {
			options.title = '';
		}
		if (options.description === undefined) {
			options.description = '';
		}
		if (options.id === undefined) {
			options.id = null;
		}
		let item = document.createElement('button');
		if (options.id !== null) {
			item.id = options.id;
		}
		let addonUrl = '';
		if (options.iconAddon !== '') {
			addonUrl += "&a=" + options.iconAddon;
		}
		let innerHtml = '';
		let htmlTitleDescription = '<p>' + options.title +'</p><p>'
			+ options.description + '</p>';
		switch (options.iconType) {
			case "pixel":
				innerHtml = '<img src="' + ant_antheiaCacheUrl 
					+ 'iconPixel32.php?i=' + options.icon + addonUrl
					+ '" width=32 height=32 alt="Icon">';
				break;
			case "vector":
					let preSvg = "<svg preserveAspectRatio='xMidYMid meet' "
						+ "viewBox='0 0 24 24' width='32' height='32'>";
					let postSvg = '</svg>';
					if (ant_utils_getCachedSvgIcon(options.icon) !== null) {
						// the svg content is already in cache
						innerHtml = preSvg + ant_utils_getCachedSvgIcon(options.icon) + postSvg;
					} else {
						// first a placeholder will be inserted
						innerHtml = '<div class="ant_modalMenu_iconPlaceholder"></div>';
						// then the content will be requested from the server
						ant_utils_getSvgIcon(options.icon).then((svgContent) => {
							item.innerHTML = preSvg + svgContent + postSvg
								+ htmlTitleDescription;
						}).catch((error) => {
							throw error;
						});
					}
				break;
			default:
				throw new Error('Invalid type ' + options.iconType);
		}	
		innerHtml += htmlTitleDescription;
		item.innerHTML = innerHtml;
		this.appendContent(item);
		return item;
	}
}