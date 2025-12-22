/**
 * Defines a modal that can be added to the document
 */
class AntheiaModal {
	/** @type {HTMLDivElement} */
	#content;
	/** @type {HTMLDivElement|null} */
	#footer;
	/** @type {"left"|"center"|"right"} */
	#footerAlign;
	/** @type {HTMLDivElement} */
	#header;
	/** @type {"left"|"center"|"right"} */
	#headerAlign;
	/** @type {HTMLDivElement} */
	#htmlElement;
	/** @type {CallableFunction|null} */
	#onClose;
	/** @type {HTMLDivElement} */
	#panel;
	constructor () {
		this.#htmlElement = document.createElement("DIV");
		this.#htmlElement.classList.add('ant_modal');
		switch (ant_theme_backdrop) {
			case "simple":
				this.#htmlElement.classList.remove("ant-blur");
				break;
			case "blur":
				this.#htmlElement.classList.add("ant-blur");
				break;
			default:
		}
		this.#htmlElement.addEventListener("closeOnEsc", () => {
			this.hide();
		});
		this.#htmlElement.addEventListener("mousedown", (event) => {
			event.stopPropagation();
			this.hide();
		});
		this.#panel = document.createElement("DIV");
		this.#panel.classList.add("ant_panel");
		this.#panel.addEventListener("mousedown", (event) => {
			event.stopPropagation();
		});
		this.#header = null;
		this.setHeaderAlign('left');
		this.#content = document.createElement("DIV");
		this.#content.classList.add("ant_modal-content");
		this.#panel.append(this.#content);	
		this.#footer = null;
		this.setFooterAlign('right');
		this.#htmlElement.append(this.#panel);
		this.#onClose = null;
	}
	/**
	 * Sets an element align, by setting a class name
	 * @param {HTMLElement} element the element to be aligned
	 * @param {"left"|"center"|"right"} align the align to be set as: left, center, right
	 */
	#setElementAlign(element, align) {
		element.classList.remove('ant-left');
		element.classList.remove('ant-center');
		element.classList.remove('ant-right');
		element.classList.add('ant-' + align);
	}
	/**
	 * Sets the html code for the header of the modal
	 * @param {String|HTMLElement|null} headerCode the code to be inserted into
	 * into header of the modal. It can be null, a string or a HTMLElement:
	 * - null: no header will be displayed (if already displayed then the header
	 * will be removed)
	 * - string: the parameter will be inserted into the innerHTML property
	 * of the header
	 * - HTMLElement: all children of the header will be removed and the parameter
	 * will be inserted as a header child
	 */
	setHeader(headerCode) {
		if (headerCode === null) {
			// the current header should be remove, if it exists
			if (this.#header !== null) {
				this.#header.remove();
			}
			this.#header = null;
			return false;
		}
		// the header must exists
		if (this.#header === null) {
			this.#header = document.createElement("DIV");
			this.#header.classList.add("ant_modal-header");
			this.#panel.prepend(this.#header);
			this.setHeaderAlign(this.#headerAlign);
		}
		if (typeof headerCode === "string") {
			this.#header.innerHTML = headerCode;
			return false;
		}
		this.#header.innerHTML = '';
		this.#header.append(headerCode);
	}
	/**
	 * Sets the alignment of the header elements.
	 * @param {"left"|"center"|"right"} align the alignment of the header as:
	 * left, center, right.
	 */
	setHeaderAlign(align) {
		if (this.#header !== null) {
			this.#setElementAlign(this.#header, align);
		}
		this.#headerAlign = align;
	}
	/**
	 * Sets the html code for the content of the modal
	 * @param {String|HTMLElement} contentCode the code to be inserted into
	 * the content of the modal. It can be a string or a HTMLElement:
	 * - string: the parameter will be inserted into the innerHTML property
	 * of the content
	 * - HTMLElement: all children of the content will be removed and the parameter
	 * will be inserted as a content child
	 */
	setContent(contentCode) {
		if (typeof contentCode === "string") {
			this.#content.innerHTML = contentCode;
			return false;
		}
		this.#content.innerHTML = '';
		this.#content.appendChild(contentCode);
	}
	/**
	 * Adds a HTMLElement to the content of the modal. Existing elements will
	 * be preserved.
	 * @param {HTMLElement} htmlElement the html element to be added to the
	 * content of the modal
	 */
	appendContent(htmlElement) {
		this.#content.appendChild(htmlElement);
	}
	/**
	 * Sets the alignment of the content elements.
	 * @param {"left"|"center"|"right"} align the alignment of the content as:
	 * left, center, right.
	 */
	setContentAlign(align) {
		this.#setElementAlign(this.#content, align);
	}
	/**
	 * Adds a class to the main content container
	 * @param {String} className the class to be added
	 */
	addContentClass(className) {
		this.#content.classList.add(className);
	}
	/**
	 * Sets the html code for the footer of the modal
	 * @param {String|HTMLElement|null} footerCode the code to be inserted into
	 * into footer of the modal. It can be null, a string or a HTMLElement:
	 * - null: no footer will be displayed (if already displayed then the footer
	 * will be removed)
	 * - string: the parameter will be inserted into the innerHTML property
	 * of the footer
	 * - HTMLElement: all children of the footer will be removed and the parameter
	 * will be inserted as a footer child
	 */
	setFooter(footerCode) {
		if (footerCode === null) {
			// the current footer should be remove, if it exists
			if (this.#footer !== null) {
				this.#footer.remove();
			}
			this.#footer = null;
			return false;
		}
		// the footer must exists
		if (this.#footer === null) {
			this.#footer = document.createElement("DIV");
			this.#footer.classList.add("ant_modal-footer");
			this.#panel.append(this.#footer);
			this.setFooterAlign(this.#footerAlign);
		}
		if (typeof footerCode === "string") {
			this.#footer.innerHTML = footerCode;
			return false;
		}
		this.#footer.innerHTML = '';
		this.#footer.append(footerCode);
	}
	/**
	 * Adds a HTMLElement to the footer of the modal. Existing elements will
	 * be preserved.
	 * @param {HTMLElement} htmlElement the html element to be added to the
	 * footer of the modal
	 */
	appendFooter(htmlElement) {
		if (this.#footer === null) {
			this.#footer = document.createElement("DIV");
			this.#footer.classList.add("ant_modal-footer");
			this.#panel.append(this.#footer);
			this.setFooterAlign(this.#footerAlign);
		}
		this.#footer.append(htmlElement);
	}
	/**
	 * Sets the alignment of the footer elements.
	 * @param {"left"|"center"|"right"} align the alignment of the footer as:
	 * left, center, right.
	 */
	setFooterAlign(align) {
		if (this.#footer !== null) {
			this.#setElementAlign(this.#footer, align);
		}
		this.#footerAlign = align;
	}
	/**
	 * Defines the function to be called when the modal is closed.
	 * @param {CallableFunction|null} callback the function to be called when
	 * the modal is closed or null if no callback is needed
	 */
	setOnClose(callback) {
		this.#onClose = callback;
	}
	/**
	 * Shows the modal (inserts the html code into the body of the page)
	 */
	show() {
		this.#htmlElement.classList.add("ant-hidden");
		document.body.append(this.#htmlElement);
		setTimeout(() => {
			this.#htmlElement.classList.remove("ant-hidden");
		}, 50);
	}
	/**
	 * Starts a loading animation inside the modal
	 * @param {JSON} params loading animation parameters
	 * @param {Boolean} params.hideHeader (default false) true if the header
	 * should be visible during the loading animation, false if the header should
	 * hide during the animation
	 * @param {Boolean} params.hideFooter (default true) true if the footer
	 * should be visible during the loading animation, false if the footer should
	 * hide during the animation
	 */
	startLoading(params) {
		let hideHeader = false;
		let hideFooter = true;
		if (params !== undefined) {
			if (params.hideHeader !== undefined) {
				hideHeader = params.hideHeader;
			}
			if (params.hideFooter !== undefined) {
				hideFooter = params.hideFooter;
			}
		}
		this.#panel.classList.add("ant-loading");
		if (hideHeader) {
			this.#panel.classList.add("ant-no-header");
		}
		if (hideFooter) {
			this.#panel.classList.add("ant-no-footer");
		}
	}
	/**
	 * Stops any loading animation inside the modal
	 */
	stopLoading() {
		this.#panel.classList.remove("ant-loading");
		this.#panel.classList.remove("ant-no-header");
		this.#panel.classList.remove("ant-no-footer");
	}
	/**
	 * Removes the html element from the body of the page
	 */
	hide() {
		if (this.#htmlElement.classList.contains("ant-hidden")) {
			return false;
		}
		if (this.#onClose !== null) {
			this.#onClose();
		}
		setTimeout(() => {
			this.#htmlElement.remove();
		}, 500);
		this.#htmlElement.classList.add("ant-hidden");
	}
}
// adding an global listener for the ESC key, that will close the last opened
// modal (if it exists)
addEventListener("keyup", (event) => {
	if (event.key !== "Escape") {
		return;
	}
	let modals = document.querySelectorAll("div.ant_modal");
	if (modals.length === 0) {
		return;
	}
	modals[modals.length - 1].dispatchEvent(new CustomEvent("closeOnEsc"));
});