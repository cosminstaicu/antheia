let ant_inputFileDrop_fullPageMode = false;
/**
 * Called after the user selected a file from the browse button
 * @param {HTMLInputElement} button the browse button
 */
function ant_inputFileDrop_fileSelected(button) {
	let dropArea = null;
	if (ant_inputFileDrop_fullPageMode) {
		dropArea = button.previousElementSibling;
	} else {
		dropArea = button.parentElement.parentElement;
	}
	ant_inputFileDrop_selectionFinished(dropArea, button.files);
}
/**
 * Removes important html characters from a text and returns it. It is used
 * for the filenames that are inserted into tags as innerHTML
 * @param {String} inputText the text to be escaped
 * @returns {String} the text with the html entities removed
 */
function ant_inputFileDrop_innerHtmlSafe(inputText) {
	let map = {
		'&': '',
		'<': '',
		'>': '',
		'"': '',
		"'": ''
	};
	return inputText.replace(/[&<>"']/g, (m) => { return map[m]; });
}
/**
 * Called after a selection of files has been made (either by dropping or by
 * selecting a file using the file browser)
 * @param {HTMLElement} dropArea the file drop element that triggered
 * the actions
 * @param {FileList} fileList the file list to be processed
 */
function ant_inputFileDrop_selectionFinished(dropArea, fileList) {
	// checking the files against the rules
	if (fileList.length === 0) {
		return;
	}
	if (dropArea.dataset.maxFiles != 0) {
		if (fileList.length > dropArea.dataset.maxFiles) {
			AntheiaAlert.quickError(
				dropArea.dataset.textTotalFiles + " (max "
				+ dropArea.dataset.maxFiles
				+ ")");
			return;
		}
	}
	let i = 0;
	let totalSizeKb = 0;
	let fileSizeKb = 0;
	let maxFileSizeKb = dropArea.dataset.maxFileSize * 1024;
	let maxTotalSizeKb = dropArea.dataset.maxTotalSize * 1024;
	let extensions = [];
	let extension = '';
	let loadingSteps = [];
	let loadingStep = null;
	let fileName = '';
	if (dropArea.dataset.extensions !== undefined) {
		extensions = dropArea.dataset.extensions.split(',');
	}
	dropArea.ant_fileList = [];
	// validating the extension and file size
	for (i = 0; i < fileList.length; i++) {
		fileName = ant_inputFileDrop_innerHtmlSafe(fileList[i].name);
		if (extensions.length > 0) {
			extension = "." + fileList[i].name.split('.').pop().toLowerCase();
			if (extensions.indexOf(extension) === -1) {
				AntheiaAlert.quickError(
					dropArea.dataset.textExtension + " (" + fileName + ")"
				);
				dropArea.ant_fileList = [];
				return;
			}
		}
		fileSizeKb = Math.round(fileList[i].size / 1024);
		if (maxFileSizeKb != 0) {
			if (fileSizeKb > maxFileSizeKb) {
				AntheiaAlert.quickError(
					dropArea.dataset.textFileSize + " (" + fileName + ")"
				);
				dropArea.ant_fileList = [];
				return;
			}
		}
		totalSizeKb += fileSizeKb;
		if (maxTotalSizeKb != 0) {
			if (totalSizeKb > maxTotalSizeKb) {
				AntheiaAlert.quickError(
					dropArea.dataset.textTotalSize 
					+ " (max " + dropArea.dataset.maxTotalSize + " MB)"
				);
				dropArea.ant_fileList = [];
				return;
			}
		}
		dropArea.ant_fileList.push({
			file : fileList[i]
		});
	}
	if (dropArea.dataset.pre !== undefined) {
		if (dropArea.dataset.pre !== '') {
			if (window[dropArea.dataset.pre](dropArea) !== true) {
				return;
			}
		}
	}
	// creating the loading interface
	AntheiaLoadingStep.reset();
	for (i = 0; i < fileList.length; i++) {
		fileName = ant_inputFileDrop_innerHtmlSafe(fileList[i].name);
		if (fileName.length > 20) {
			fileName = fileName.slice(0, 18) + "...";
		}
		loadingStep = new AntheiaLoadingStep();
		loadingStep.setLabel(fileName);
		loadingStep.setIcon("cloud-upload");
		loadingSteps.push(loadingStep);
	}
	ant_loading_start();
	ant_inputFileDrop_uploadFile(dropArea, fileList, loadingSteps, 0);
}
/**
 * Starts uploading a file from the filelist to the server, updating the
 * interface also
 * @param {HTMLElement} dropArea the file drop element that triggered
 * the actions
 * @param {FileList} fileList the list of files to be uploaded
 * @param {AntheiaLoadingStep[]} loadingSteps a list with all rendered steps
 * inside the interface
 * @param {Number} index the index of the file (from the fileList parameter)
 * to be uploaded
 */
function ant_inputFileDrop_uploadFile(dropArea, fileList, loadingSteps, index) {
	let formData = new FormData();
	formData.append(dropArea.dataset.name, fileList[index]);
	let req = new XMLHttpRequest();
	req.open("POST", dropArea.dataset.url);
	// req.setRequestHeader("Content-Type","multipart/form-data");
	req.upload.addEventListener("progress", (event) => {
		loadingSteps[index].computeProgress(event.loaded, event.total);
	});
	req.onreadystatechange = () => {
		if (req.readyState !== 4) {
			return false;
		}
		if (req.status !== 200) {
			return false;
		}
		index++;
		if (index < fileList.length) {
			ant_inputFileDrop_uploadFile(dropArea, fileList, loadingSteps, index);
		} else {
			window[dropArea.dataset.post](dropArea);
		}
	};
	req.send(formData);
}
/**
 * Called after the html code for a full page drop input
 */
function ant_inputFileDrop_enableFullPageDrop() {
	ant_inputFileDrop_fullPageMode = true;
}
let ant_inputFileDrop_timeoutLeave = null;
// sets the required listeners after the DOM has been loaded
document.addEventListener("DOMContentLoaded", () => {
	let elements = document.getElementsByClassName("ant_inputFileDrop");
	if (ant_inputFileDrop_fullPageMode) {
		document.addEventListener('dragenter', (event) => {
			document.body.classList.add('ant_inputFileDrop-dragActive');
			clearTimeout(ant_inputFileDrop_timeoutLeave);
			event.preventDefault();
		});
		document.addEventListener('dragover', (event) => {
			document.body.classList.add('ant_inputFileDrop-dragActive');
			clearTimeout(ant_inputFileDrop_timeoutLeave);
			event.preventDefault();
		});
		document.addEventListener('dragleave', () => {
			ant_inputFileDrop_timeoutLeave = setTimeout(() => {
				document.body.classList.remove('ant_inputFileDrop-dragActive');
			}, 1000);
		});
		elements[0].addEventListener("drop", function (event) {
			document.body.classList.remove('ant_inputFileDrop-dragActive');
			event.preventDefault();
			ant_inputFileDrop_selectionFinished(this, event.dataTransfer.files);
		});
	} else {
		let i = 0;
		for (i = 0; i < elements.length; i++) {
			elements[i].addEventListener("dragenter", function (event) {
				this.classList.add("ant-active");
				event.preventDefault();
			});
			elements[i].addEventListener("dragover", function (event) {
				this.classList.add("ant-active");
				event.preventDefault();
			});
			elements[i].addEventListener("dragleave", function (event) {
				this.classList.remove("ant-active");
				event.preventDefault();
			});
			elements[i].addEventListener("drop", function (event) {
				this.classList.remove("ant-active");
				event.preventDefault();
				ant_inputFileDrop_selectionFinished(this, event.dataTransfer.files);
			});
		}
	}

});
