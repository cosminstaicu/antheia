<?php
use Antheia\Antheia\Classes\Form;
use Antheia\Antheia\Classes\FixedButton\FixedButtonCancel;
use Antheia\Antheia\Classes\FixedButton\FixedButtonValid;
use Antheia\Antheia\Classes\Input\NewInput;
use Antheia\Antheia\Classes\Page\PageEmpty;
use Antheia\Antheia\Classes\Wireframe\Wireframe;
use Antheia\Antheia\Classes\Menu\Item\NewMenu;
// init.php is used for initializing the framework
require '../_utils/init.php';
$page = new PageEmpty();
// this function is defined inside utils/init.php required file
init_configurePage($page);
$page->addCss('.display-none {display: none !important}');
$page->addJavascriptFile('script.js');
$page->setTitle('Form example');
$wireframe = new Wireframe();
$wireframe->setType($wireframe::TYPE_FIXED);
$row = $wireframe->addRow();
$cell = $row->addCell();
$cell->addWidth('xs', 12);
// defining the form that will be attached to the wireframe
$form = new Form();
$form->setAction($_SERVER['PHP_SELF']);
$form->setMethod($form::METHOD_POST);
// the next method enables the file transfer (because we use a input file field)
$form->setFileMode();
// defining the panel that will be attached to the form
$panel = $form->addInputPanel();
// placing some buttons to the panel menu
$infoMenu = NewMenu::info();
$infoMenu->setOnClick('alert()');
$panel->addMenu($infoMenu);
$panel->setTitle('A form');
// ********************************************************************** hidden
$form->addHiddenInput('hiddenInputName', 'hiddenInputValue', 'optionalId');
// ************************************************************************ info
// just an info text (it will not be sent to the server)
$input = NewInput::info();
$input->setLabel('Info field');
$input->setValue('just a text');
$panel->addInput($input);
// ************************************************************************ text
$input = NewInput::text();
$input->setName('textInput');
if (isset($_POST['textInput'])) {
	$input->setValue($_POST['textInput']);
}
$input->setLabel('Text field');
$input->setPlaceholder('just a text field');
$panel->addInput($input);
// ********************************************************************** number
$input = NewInput::number();
$input->setNameId('digitsInput');
if (isset($_POST['digitsInput'])) {
	$input->setValue($_POST['digitsInput']);
}
$input->setLabel('Number with validation (min 3)');
$input->setPlaceholder('value');
$input->setValidation('digitsValidation');
$panel->addInput($input);
// ********************************************************************** select
$input = NewInput::select();
$input->setName('selectInput');
$input->setLabel('Select');
$input->addOption('Item 1', '1');
$input->addOption('Item 2', '2', false, 'Item 2 selected');
$input->addOption('Item 3', '3', false, 'Item 3 selected');
if (isset($_POST['selectInput'])) {
	$input->setValue($_POST['selectInput']);
}
$panel->addInput($input);
// ******************************************************************** password
$input = NewInput::password();
$input->setNameId('passwordInput');
$input->setLabel('Password');
$input->addAttribute('autocomplete', 'current-password');
$input->setInlineHelpText('All input fields can display additional info');
$input->setPlaceholder('a password can be typed here');
$panel->addInput($input);
// **************************************************************** new password
$input = NewInput::newPassword();
$input->setUsername('antheia');
$input->setNameId('newPassword');
$input->setLabel('Define a new password');
$input->setLength(3, 20);
$input->mustContainDigits();
$input->mustContainLowercase();
$input->mustContainUppercase();
$input->mustContainSymbols();
$input->setInitialText('define a new password');
$input->setFinalText('will be updated');
$panel->addInput($input);
// ********************************************************************** search
$input = NewInput::search();
$input->setLabel('Search<br>(server query)');
$input->displayUndefined('No selection', 'noSelection');
$input->setName('searchInput');
$input->setUrl('query.php');
$input->setInitialText('Initial value');
$panel->addInput($input);
// *********************************************************************** email
$input = NewInput::email();
$input->setName('emailInput');
$input->addAttribute('autocomplete', 'email');
$input->setLabel('Email');
$input->setPlaceholder('type an email here');
$panel->addInput($input);
// *********************************************************************** phone
$input = NewInput::phone();
$input->setName('phoneInput');
$input->setLabel('Phone');
$panel->addInput($input);
// ************************************************************************ date
$input = NewInput::date();
$input->setNameId('dateInput');
$input->setLabel('Date');
$input->setValue('19900225');
$input->displayToday();
$input->displayUndefined();
$panel->addInput($input, 'dateRow');
// ************************************************************************ time
$input = NewInput::time();
$input->setName('timeInput');
$input->setLabel('Time');
$panel->addInput($input);
// ************************************************************* predefined type
$input = NewInput::time();
$input->setName('timePredefinedInput');
$input->setLabel('Time (select)');
$input->setSelectionMode();
$input->setHourSelection(1, 8, 16);
$input->setMinuteSelection(10, 0, 59);
$input->displayUndefined();
$panel->addInput($input);
// *********************************************************************** color
$input = NewInput::color();
// setNameId defines the name and id in a single statement
$input->setNameId('colorInput');
$input->setLabel('Color select');
$input->setValue('#ff0000');
$panel->addInput($input);
// ******************************************************************** checkbox
$input = NewInput::checkbox();
$input->setName('checkboxInput');
$input->setLabel('A checkbox');
$input->setValue('yes');
$panel->addInput($input);
// ************************************************************************ file
$input = NewInput::file();
$input->setName('fileInput');
$input->setLabel('A file');
// if no extension is defined then the input accepts any file type
$input->addExtension('.mp3');
$panel->addInput($input);
// ******************************************************************* drop file
$input = NewInput::fileDrop();
$input->setName('droppedFile');
$input->setMaxFiles(3);
$input->setMaxSize(2, 2);
$input->addExtension('wav');
$input->setUrl('dragDropUpload.php');
$input->setAfterCallback('afterDropFileTransfer');
$input->setDisplayBrowser(false);
$panel->addInput($input);
// ******************************************************************** textarea
$input = NewInput::textarea();
$input->setName('textareaInput');
$input->setLabel('Textarea');
$panel->addInput($input);
// **************************************** simple button (hides the date field)
$input = NewInput::button();
$input->setValue('Hide date');
$input->setOnClick(
	"document.getElementById('dateRow').classList.add('display-none')"
);
$panel->addInput($input);
// **************************************** simple button (shows the date field)
$input = NewInput::button();
$input->setValue('Show date');
$input->setOnClick(
	"document.getElementById('dateRow').classList.remove('display-none')"
);
$panel->addInput($input);
// *************************************************************** simple button
$input = NewInput::button();
$input->setValue('Set date to 20 january 2009');
$input->setOnClick("ant_forms_updateValue('dateInput','20090120')");
$panel->addInput($input);
// *************************************************************** submit button
$input = NewInput::submit();
$panel->addInput($input);
// add the form to the wireframe cell
$cell->addElement($form);
// *********************************************** ADD THE WIREFRAME TO THE PAGE
$page->addElement($wireframe);
// fixed buttons
$cancelButton = new FixedButtonCancel();
$cancelButton->setOnClick("alert('Cancel action')");
$page->addFixedButton($cancelButton);
$validButton = new FixedButtonValid();
$validButton->setRender($validButton::LINK);
$validButton->setOnClick("alert('Valid action')");
$page->addFixedButton($validButton);
// adding a panel to display page source info
// the function is defined inside the utils/init.php file
init_insertPageSource($page, 'forms', [
		['name' => 'index.php', 'info' => 'main'],
		['name' => 'script.js', 'info' => 'js'],
		['name' => 'dragDropUpload.php', 'info' => 'Destination for drag and drop file upload input'],
		['name' => 'query.php', 'info' => 'Server processing for live search input']
], 'Example%3A-Forms');
// html export
echo $page->getHtml();
?>