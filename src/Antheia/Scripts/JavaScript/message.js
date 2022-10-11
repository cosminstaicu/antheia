/**
 * Displays a message to the user. It will be displayed as a toast type popup
 * on the bottom right side of the page (if no image is provided) or as a
 * full screen text (if an image is provided)
 * @param {String} message the text to be displayed
 * @param {String} imageUrl (optional) url to an image if a fullscreen text
 * is to be displayed
 * @param {Boolean} closeMessageOnClick (optional) (default false) if set to true
 * then the fullscreen message can be dismissed by clicking on the image
 */
function ant_message(message, imageUrl, closeMessageOnClick) {
	if (imageUrl === undefined) {
		let container = document.getElementById('ant_message-text-container');
		if (container === null) {
			container = document.createElement("div");
			container.id = 'ant_message-text-container';
			document.body.appendChild(container);
		}
		let element = document.createElement("div");
		element.classList.add("ant_message-text");
		element.innerHTML = message;
		element.classList.add("ant-pre-visible");
		let slideDownPlaceholder = null;
		container.prepend(element);
		setTimeout(() => {
			element.classList.remove("ant-pre-visible");
		}, 500);
		setTimeout(() => {
			element.classList.add("ant-slide-out-mode");
			slideDownPlaceholder = document.createElement("div");
			slideDownPlaceholder.classList.add("ant-slide-down-placeholder");
			slideDownPlaceholder.style.height = element.clientHeight + 'px';
			container.append(slideDownPlaceholder);
		}, 4500);
		setTimeout(() => {
			element.classList.add("ant-end-slide");
			slideDownPlaceholder.style.height = '0px';
		}, 4550);
		setTimeout(() => {
			element.remove();
			slideDownPlaceholder.remove();
			if (!container.hasChildNodes()) {
				container.remove();
			}
		}, 5050);
	} else {
		if (closeMessageOnClick === undefined) {
			closeMessageOnClick = false;
		}
		let element = document.createElement("div");
		element.classList.add("ant_message-image");
		element.style.backgroundImage = 'url("' + imageUrl + '")';
		element.innerHTML = '<p>' + message + '</p>';
		document.body.append(element);
		setTimeout(() => {
			document.body.classList.remove("ant_message-active");
			element.classList.add('ant-visible');
			if (closeMessageOnClick) {
				element.classList.add('ant-close-on-click');
				element.addEventListener("click", () => {
					element.style.display = "none";
				});
			}
		}, 500);
		setTimeout(() => {
			element.classList.remove("ant-visible");
			element.classList.add('ant-finish');
		}, 3200);
		setTimeout(() => {
			element.remove();
		}, 4200);
	}
}