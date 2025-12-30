"use strict";

// the images for the loading steps can be preloaded (but it is optional)
ant_utils_getCachedSvgIcon("delete");
ant_utils_getCachedSvgIcon("component");

function load3seconds() {
	ant_loading_start();
	setTimeout(() => {
		ant_loading_stop();
	}, 3000);
}
function loadSteps() {
	// reset the steps
	AntheiaLoadingStep.reset();
	// define the first step
	let firstStep = new AntheiaLoadingStep();
	firstStep.setLabel("First step");
	firstStep.setIcon("cloud-upload");
	// define the second step
	let secondStep = new AntheiaLoadingStep();
	secondStep.setLabel("Second step");
	secondStep.setIcon("component");
	// showing the loading animation (steps are both in a waiting state)
	setTimeout(() => {
		ant_loading_start();
	}, 50);
	// running the first step (setProgress defines the percent completed)
	setTimeout(() => {
		firstStep.setProgress(20);
	}, 500);
	setTimeout(() => {
		firstStep.setProgress(50);
	}, 1000);
	setTimeout(() => {
		firstStep.setProgress(80);
	}, 1500);
	setTimeout(() => {
		firstStep.setProgress(100);
	}, 2000);
	// running the second step
	// (computeProgress computes the progress based on a partial value and a total value)
	setTimeout(() => {
		secondStep.computeProgress(123, 855);
	}, 2500);
	setTimeout(() => {
		secondStep.computeProgress(387, 855);
	}, 3000);
	setTimeout(() => {
		secondStep.computeProgress(562, 855);
	}, 3500);
	setTimeout(() => {
		secondStep.computeProgress(855, 855);
	}, 4000);
	setTimeout(() => {
		ant_loading_stop();
		AntheiaLoadingStep.reset();
	}, 4300);
}
/**
 * Example function that will be triggered if the user presses the cancel button
 */
function cancelAction() {
	console.log('cancel action triggered');
	ant_loading_stop();
	AntheiaLoadingStep.reset()
}
function loadStepsWithCancelButton() {
	loadSteps();
	setTimeout(() => {
		AntheiaLoadingStep.setCancelButton({
			function : "cancelAction"
		});
	}, 1000);
}