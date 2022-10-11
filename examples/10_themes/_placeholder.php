<?php
use Cosmin\Antheia\Classes\Page\PageEmpty;
use Cosmin\Antheia\Classes\Html;
use Cosmin\Antheia\Classes\Input\InputButton;
use Cosmin\Antheia\Classes\Menu\Item\MenuEdit;
use Cosmin\Antheia\Classes\Menu\Item\MenuConfirmDelete;
use Cosmin\Antheia\Classes\Input\InputInfo;
use Cosmin\Antheia\Classes\Input\InputText;
use Cosmin\Antheia\Classes\Input\InputPhone;
use Cosmin\Antheia\Classes\Input\InputSelect;
use Cosmin\Antheia\Classes\Accordion\Accordion;
use Cosmin\Antheia\Classes\Menu\Item\MenuDelete;
/**
 * Just a placeholder file, to be rendered using different themes.
 * The file should not be accessed directly by the browser, but included from one
 * on the files defining the theme (from the same folder)
 */
/**
 * @var PageEmpty $page
 */
$wireframe = $page->addWireframe();
$row = $wireframe->addRow();
// ******************************************************* a panel WITH NO TITLE
// inside a cell with a width of 6 columns (50%) on medium and large devices
$cell = $row->addCell();
$cell->addWidth('md', 6);
$panel = $cell->addPanel();
$panel->addText('a panel without a title');
$codHtml = new Html();
$codHtml->addRawCode('<ul>');
$codHtml->addRawCode('<li>HTML code can be inserted inside a panel</li>');
$codHtml->addRawCode('<li>just like this list is placed</li>');
$codHtml->addRawCode('</ul>');
$panel->addElement($codHtml);
$panel->addElement(new Html('<p>Inside the panel you can add text or
	other PHP classes that are implementing the HtmlCode interface</p>'));
$panel->setFullHeight();
// ******************************************* a panel WITH A TITLE AND A FOOTER
// inside a cell with a width of 6 columns (50%) on medium and large devices
$cell = $row->addCell();
$cell->addWidth('md', 6);
$panel = $cell->addPanel();
$panel->setTitle('A panel with a title');
$panel->setHtmlId('panelWithActions');
$panel->addText('<p>This panel has the height forced to 100% of the available space</p>');
$panel->addElement(new Html('<p>If the method setFullHeight is removed,
	then the panel height will NOT match the height of the panel to the left.</p>'));
$button = new InputButton();
$button->setText('Footer button');
$button->setOnClick('alert()');
$panel->addFooterElement($button);
$panel->setFullHeight();
// *********************************************** a panel WITH A TITLE AND MENU
$row = $wireframe->addRow();
$cell = $row->addCell();
$cell->addWidth('md', 6);
// a panel with a title and a menu
// the panel is optimised for showing name-value pairs
$panel = $cell->addInfoPanel();
$panel->setTitle('Panel for entity info (ex: user info)');
// first, the menu items are defined
// an edit button
$button = new MenuEdit();
$button->setHref("javascript:alert()");
$panel->addMenu($button);
// a delete confirmation
// if the user types DELETE in the input then a http request
// will be initiated, to the defined url, with the defined id as a parameter
$button = new MenuConfirmDelete();
$button->setUrl('/url/for/request');
$button->setItemId('14');
$button->setFormTarget('_blank'); // could be in iframe
$panel->addMenu($button);
// the name-value pairs are added tot the panel
$panel->addNameValue('Given name', 'John');
$panel->addNameValue('Family name', 'Doe');
$panel->addNameValue(
	'website',
	'<a href="https://www.example.com">example.com</a>'
);
$panel->addNameValue(
	'e-mail',
	'<a href="mailto:john.doe@example.com">john.doe@example.com</a>'
);
$panel->addNameValue('Height', '173 cm');
$panel->addValue(
	'Some remarks can be shown using the entire panel width.
	Check the DELETE option in the panel menu, for a delete confirmation template.'
);
// ************************************************** a panel WITH FORM ELEMENTS
$cell = $row->addCell();
$cell->addWidth('md', 6);
$panel = $cell->addInputPanel();
$panel->setTitle('Panel for forms');
// info type input
$input = new InputInfo();
$input->setLabel('Info');
$input->setValue('A detailed description for forms can be found on the FORM example');
$panel->addInput($input);
// text input element
$input = new InputText();
$input->setLabel('Text field');
$input->setName('textFieldName');
$input->setPlaceholder('a placeholder text');
$panel->addInput($input);
// phone input element
$input = new InputPhone();
$input->setLabel('Phone number');
$input->setPlaceholder('here you can type a phone number');
$input->setName('phone');
$panel->addInput($input);
// select element
$input = new InputSelect();
$input->setLabel('Select element');
$input->setName('selectElementName');
$input->addOption('Value 1', 'v1', false, 'info about the first value');
$input->addOption('Value 2', 'v2', false, 'info about the second value');
$input->addOption('Value 3', 'v3');
$input->addOption('Value 4', 'v4', false, 'info about the forth value');
$input->setValue('v2'); // default value can be set
$panel->addInput($input);
// *************************************************** a panel WITH AN ACCORDION
$cell = $row->addCell();
$cell->addWidth('xs', 12);
$panel = $cell->addPanel();
$panel->setTitle('Panel with an accordion');
$accordion = new Accordion();
$accordionItem = $accordion->getNewItem();
$accordionItem->setTitle('First accordion item');
$accordionItem->addElement(new Html('First item content'));
$accordionItem = $accordion->getNewItem();
$accordionItem->setTitle('Second accordion item');
$accordionItem->addElement(new Html('Second item content'));
$accordionItem = $accordion->getNewItem();
$accordionItem->setTitle('Third accordion item');
$accordionItem->addElement(new Html('Third item content'));
$panel->addElement($accordion);
// ************************************************* a panel WITH A FILE BROWSER
$cell = $row->addCell();
$cell->addWidth('xs', 12);
$panel = $cell->addFileBrowserPanel();
$panel->setTitle('File browser');
// adding a folder
$folder = $panel->addFolder();
$folder->setName('First folder');
// adding a second folder
$folder = $panel->addFolder();
$folder->setName('Second folder');
// adding a file
$file = $panel->addFile();
$deleteButton = new MenuDelete();
$deleteButton->setOnClick("console.log('delete it')");
$file->addHiddenItem($deleteButton);
$file->setName('a pdf file.pdf');
// adding another file
$file = $panel->addFile();
$file->setName('Second file.jpg');
$deleteButton = new MenuDelete();
$deleteButton->setOnClick("console.log('delete it')");
$file->addHiddenItem($deleteButton);
// adding a panel to display page source info
// the function is defined inside the utils/init.php file
$fileName = lcfirst(str_replace(' ', '', ucwords($page->getTheme()->getName())));
$fileName = str_replace('And', '', $fileName);
init_insertPageSource($page, '10_themes', [[
	'name' => $fileName.'.php',
	'info' => 'main'	
]], 'Example-10%3A-Themes');
// page export
echo $page->getHtml();
?>