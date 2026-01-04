"use strict";
/**
 * Shows a simple modal
 */
 function simpleModal() {
	let modal = new AntheiaModal();
	modal.setHeader('Simple modal');
	modal.setContent('content html code here');
	modal.setFooter('Footer text');
	modal.setPanelId('simpleModal');
	modal.show();
}
/**
 * A modal that updates the content after it has been displayed
 */
function contentUpdateModal() {
	let modal = new AntheiaModal();
	modal.setHeader('Content update modal');
	modal.setContent('Wait 2 seconds for the content to be updated');
	modal.setFooter('A button will be placed here');
	modal.setPanelId('contentUpdateModal');
	modal.show();
	setTimeout(() => {
		modal.setHeader('Content updated');
		modal.setContent('In 2 more seconds a button will be added to the footer');
		modal.setFooter(null);
	}, 2000);
	setTimeout(() => {
		let button = document.createElement('INPUT');
		button.type = "button";
		button.value = "Close it?";
		button.id = 'contentUpdateModalCloseButton';
		button.addEventListener("click", () => {
			AntheiaConfirm.quick("Close the modal?", () => {
				modal.hide();
			});
		});
		modal.setFooter(button);
	}, 4000);
}
/**
 * A modal that starts a loading animation, updates the content (while
 * the animation is displayed and the content is hidden) and then finishes the
 * animation, to show the content
 */
function loadingModal() {
	let modal = new AntheiaModal();
	modal.setHeader('Animation modal');
	modal.setContent('The animation starts in 2 seconds');
	modal.setPanelId('loadingModal');
	modal.show();
	// start the loading animation in 2 seconds
	setTimeout(() =>  {
		modal.startLoading({
			hideHeader: true,
			hideFooter: true
		});
	}, 2000);
	// after 3 seconds update the modal (while animation is running)
	setTimeout(() => {
		modal.setContent('Finished');
		let button = document.createElement('INPUT');
		button.type = "button";
		button.value = "Close it?";
		button.id = 'loadingModalCloseButton';
		button.addEventListener("click", () => {
			AntheiaConfirm.quick("Close the modal?", () => {
				modal.hide();
			});
		});
		modal.setFooter(button);
	}, 3000);
	// after 4 seconds stop the animation to show the new content
	setTimeout(() => {
		modal.stopLoading();
	}, 4000);
}
/**
 * Constructs and shows a modal with options
 */
function modalWithOptions() {
	let modal = new AntheiaModalMenu();
	modal.setPanelId('menuModal');
	modal.addMenuOption({
		title : "First option",
		description : "This is a description for the first button with close on click",
		icon : "user",
		id : "modalMenuItem1"
	}).addEventListener("click", () => {
		console.log("click on 1");
		modal.hide();
	});
	modal.addMenuOption({
		title : "Second option",
		description : "This is a description for the second button in the list with close on click",
		icon : "phone",
		iconAddon : "user",
		iconType : 'vector',
		id : "modalMenuItem2"
	}).addEventListener("click", () => {
		console.log("click on 2");
		modal.hide();
	});
	modal.addMenuOption({
		title : "Third option",
		description : "This is a description for the third button in the list, no close on click",
		icon : "default",
		id : "modalMenuItem3"
	}).addEventListener("click", () => {
		console.log("click on 3");
	});
	modal.setHeader("A modal with menu items");
	modal.show();
}
