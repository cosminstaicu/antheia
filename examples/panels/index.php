<?php
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Accordion\Accordion;
use Antheia\Antheia\Classes\InlineButton\InlineButton;
use Antheia\Antheia\Classes\Input\NewInput;
use Antheia\Antheia\Classes\Menu\Item\NewMenu;
use Antheia\Antheia\Classes\Page\PageEmpty;
use Antheia\Antheia\Classes\Panel\Panel;
use Antheia\Antheia\Classes\Panel\PanelInfo;
use Antheia\Antheia\Classes\Panel\PanelInput;
use Antheia\Antheia\Classes\Wireframe\Wireframe;
// init.php is used for initializing the framework
require '../_utils/init.php';
$page = new PageEmpty();
// this function is defined inside utils/init.php required file
init_configurePage($page);
$page->setTitle('Panels');
$page->addJavascriptFile('script.js');
$wireframe = new Wireframe();
$wireframe->setType($wireframe::TYPE_FIXED);
$row = $wireframe->addRow();
// ******************************************************* a panel WITH NO TITLE
// inside a cell with a width of 6 columns (50%) on medium and large devices
$cell = $row->addCell();
$cell->addWidth('md', 6);
$panel = new Panel();
$panel->addText('a panel without a title');
$codHtml = new Html();
$codHtml->addRawCode('<ul>');
$codHtml->addRawCode('<li>HTML code can be inserted inside a panel</li>');
$codHtml->addRawCode('<li>just like this list is placed</li>');
$codHtml->addRawCode('</ul>');
$panel->addElement($codHtml);
$panel->addElement(new Html('<p>Inside the panel you can add text or
	other PHP classes that are implementing the HtmlCode interface.'));
$panel->setFullHeight();
$cell->addElement($panel);
// ******************************************* a panel WITH A TITLE AND A FOOTER
// inside a cell with a width of 6 columns (50%) on medium and large devices
$cell = $row->addCell();
$cell->addWidth('md', 6);
$panel = new Panel();
$panel->setTitle('A panel with a title');
$panel->setHtmlId('panelWithActions');
$panel->addText('<p>This panel has the height forced to 100% of the available space</p>');
$panel->addElement(new Html('<p>If the method setFullHeight is removed,
	then the panel height will NOT match the height of the panel to the left.</p>'));
$button = NewInput::button();
$button->setText('Loading animation (3 sec)');
$button->setOnClick('startPanelLoadingAnimation()');
$panel->addFooterElement($button);
$panel->setFullHeight();
$cell->addElement($panel);
// *********************************************** a panel WITH A TITLE AND MENU
$row = $wireframe->addRow();
$cell = $row->addCell();
$cell->addWidth('md', 6);
// a panel with a title and a menu
// the panel is optimised for showing name-value pairs
$panel = new PanelInfo();
$panel->setTitle('Panel for entity info (ex: user info)');
// first, the menu items are defined
// an edit button
$button = NewMenu::edit();
$button->setHref("javascript:alert('some code here')");
$panel->addMenu($button);
// a delete confirmation
// if the user types DELETE in the input then a http request
// will be initiated, to the defined url, with the defined id as a parameter
$button = NewMenu::confirmDelete();
$button->setUrl('/url/for/request');
$button->setItemId('14');
$button->setFormTarget('_blank'); // could be in iframe
$panel->addMenu($button);
// the name-value pairs are added tot the panel
$panel->addNameValue('Given name', 'John');
$panel->addNameValue('Family name', 'Doe');
$panel->addDivider();
$panel->addNameValue(
	'website',
	'<a href="https://www.example.com">example.com</a>'
);
$panel->addNameValue(
	'e-mail',
	'<a href="mailto:john.doe@example.com">john.doe@example.com</a>'
);
$panel->addNameValue('Height', '173 cm');
// inserting a button with an image
$button = new InlineButton();
$button->setIcon('user');
$button->setText('High contrast button (with image)');
$button->setIntensity($button::HIGH);
$button->setOnClick('alert(\'on click action\')');
$button->setTitle('Button title');
$panel->addNameElement('High contrast button', $button);
// inserting a button without an image
$button = new InlineButton();
$button->setText('Medium contrast button (with image)');
$button->setIntensity($button::MEDIUM);
$button->setIcon('user');
$button->setOnClick('alert(\'on click action\')');
$panel->addNameElement('Medium contrast button', $button);
// low constract button
$button = new InlineButton();
$button->setText('Low contrast button (no image)');
$button->setIntensity($button::LOW);
$button->setOnClick('alert(\'on click action\')');
$panel->addNameElement('Low contrast button', $button);
$panel->addValue(
	'Some remarks can be shown using the entire panel width.
	Check the DELETE option in the panel menu, for a delete confirmation template.'
);
$cell->addElement($panel);
// ************************************************** a panel WITH FORM ELEMENTS
$cell = $row->addCell();
$cell->addWidth('md', 6);
$panel = new PanelInput();
$panel->setTitle('Panel for forms');
// info type input
$input = NewInput::info();
$input->setLabel('Info');
$input->setValue('A detailed description for forms can be found on the FORM example');
$panel->addInput($input);
// text input element
$input = NewInput::text();
$input->setLabel('Text field');
$input->setName('textFieldName');
$input->setPlaceholder('a placeholder text');
$panel->addInput($input);
// divider
$panel->addDivider();
// phone input element
$input = NewInput::phone();
$input->setLabel('Phone number');
$input->setPlaceholder('here you can type a phone number');
$input->setName('phone');
$panel->addInput($input);
// select element
$input = NewInput::select();
$input->setLabel('Select element');
$input->setName('selectElementName');
$input->addOption('Value 1', 'v1', false, 'info about the first value');
$input->addOption('Value 2', 'v2', false, 'info about the second value');
$input->addOption('Value 3', 'v3');
$input->addOption('Value 4', 'v4', false, 'info about the forth value');
$input->setValue('v2'); // default value can be set
$panel->addInput($input);
// adding the panel to the wireframe cell
$cell->addElement($panel);
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
$deleteButton = NewMenu::delete();
$deleteButton->setOnClick("console.log('delete it')");
$file->addHiddenItem($deleteButton);
$file->setName('a pdf file.pdf');
// adding another file
$file = $panel->addFile();
$file->setName('Second file.JpG');
$deleteButton = NewMenu::delete();
$deleteButton->setOnClick("console.log('delete it')");
$file->addHiddenItem($deleteButton);
// adding a file with multiple extension (last one will be used by the render
$file = $panel->addFile();
$file->setName('Third file.jpg.pdf');
$deleteButton = NewMenu::delete();
$deleteButton->setOnClick("console.log('delete it')");
$file->addHiddenItem($deleteButton);
// the last file has no extension
$file = $panel->addFile();
$file->setName('Fourth file');
$deleteButton = NewMenu::delete();
$deleteButton->setOnClick("console.log('delete it')");
$file->addHiddenItem($deleteButton);
// ******************************************** ADDING THE WIREFRAME TO THE PAGE
$page->addElement($wireframe);
// adding a panel to display page source info
// the function is defined inside the utils/init.php file
init_insertPageSource($page, 'panels', [
		['name' => 'index.php', 'info' => 'main'],
		['name' => 'script.js', 'info' => 'js']
], 'Example%3A-Panels');
// page export
echo $page->getHtml();
?>