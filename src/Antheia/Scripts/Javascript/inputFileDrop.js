/**
 * Called after the user selected a file from the browse button
 * @param {HTMLInputElement} button the browse button
 */
function jsf_inputFileDrop_fileSelected(button) {
	jsf_inputFileDrop_selectionFinished(
		button.parentElement.parentElement,
		button.files
	);
}
/**
 * Called after a selection of files has been made (either by dropping or by
 * selecting a file using the file browser)
 * @param {HTMLElement} dropArea the file drop element that triggered
 * the actions
 * @param {FileList} fileList the file list to be processed
 */
function jsf_inputFileDrop_selectionFinished(dropArea, fileList) {
	// checking the files against the rules
	if (fileList.length === 0) {
		return false;
	}
	if (dropArea.dataset.maxFiles != 0) {
		if (fileList.length > dropArea.dataset.maxFiles) {
			jsf_alert.quickError(
				dropArea.dataset.textTotalFiles + " (max "
				+ dropArea.dataset.maxFiles
				+ ")");
			return false;
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
	dropArea.jsf_fileList = [];
	for (i = 0; i < fileList.length; i++) {
		if (extensions.length > 0) {
			extension = "." + fileList[i].name.split('.').pop().toLowerCase();
			if (extensions.indexOf(extension) === -1) {
				jsf_alert.quickError(
					dropArea.dataset.textExtension + " (" + fileList[i].name + ")"
				);
				dropArea.jsf_fileList = [];
				return false;
			}
		}
		fileSizeKb = Math.round(fileList[i].size / 1024);
		if (maxFileSizeKb != 0) {
			if (fileSizeKb > maxFileSizeKb) {
				jsf_alert.quickError(
					dropArea.dataset.textFileSize + " (" + fileList[i].name + ")"
				);
				dropArea.jsf_fileList = [];
				return false;
			}
		}
		totalSizeKb += fileSizeKb;
		if (maxTotalSizeKb != 0) {
			if (totalSizeKb > maxTotalSizeKb) {
				jsf_alert.quickError(
					dropArea.dataset.textTotalSize 
					+ " (max " + dropArea.dataset.maxTotalSize + " MB)"
				);
				dropArea.jsf_fileList = [];
				return false;
			}
		}
		dropArea.jsf_fileList.push({
			file : fileList[i]
		});
	}
	if (dropArea.dataset.pre !== undefined) {
		if (dropArea.dataset.pre !== '') {
			if (window[dropArea.dataset.pre](dropArea) !== true) {
				return false;
			}
		}
	}
	// creating the loading interface
	jsf_loading_step.reset();
	for (i = 0; i < fileList.length; i++) {
		fileName = fileList[i].name;
		if (fileName.length > 20) {
			fileName = fileName.slice(0, 18) + "...";
		}
		loadingStep = new jsf_loading_step();
		loadingStep.setLabel(fileName);
		loadingStep.setIcon("file_upload");
		loadingSteps.push(loadingStep);
	}
	jsf_loading_start();
	jsf_inputFileDrop_uploadFile(dropArea, fileList, loadingSteps, 0);
}
/**
 * Starts uploading a file from the filelist to the server, updating the
 * interface also
 * @param {HTMLElement} dropArea the file drop element that triggered
 * the actions
 * @param {FileList} fileList the list of files to be uploaded
 * @param {jsf_loading_step[]} loadingSteps a list with all rendered steps
 * inside the interface
 * @param {Number} index the index of the file (from the fileList parameter)
 * to be uploaded
 */
function jsf_inputFileDrop_uploadFile(dropArea, fileList, loadingSteps, index) {
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
			jsf_inputFileDrop_uploadFile(dropArea, fileList, loadingSteps, index);
		} else {
			window[dropArea.dataset.post](dropArea);
		}
	};
	req.send(formData);
}
// sets the required listeners after the DOM has been loaded
document.addEventListener("DOMContentLoaded", () => {
	let elements = document.getElementsByClassName("jsf_inputFileDrop");
	let i = 0;
	for (i = 0; i < elements.length; i++) {
		elements[i].addEventListener("dragenter", function (event) {
			this.classList.add("jsf-active");
			event.preventDefault();
		});
		elements[i].addEventListener("dragover", function (event) {
			this.classList.add("jsf-active");
			event.preventDefault();
		});
		elements[i].addEventListener("dragleave", function (event) {
			this.classList.remove("jsf-active");
			event.preventDefault();
		});
		elements[i].addEventListener("drop", function (event) {
			this.classList.remove("jsf-active");
			event.preventDefault();
			jsf_inputFileDrop_selectionFinished(this, event.dataTransfer.files);
		});
	}
});
