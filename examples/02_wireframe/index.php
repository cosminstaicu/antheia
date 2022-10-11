<?php
use Cosmin\Antheia\Classes\Page\PageEmpty;
use Cosmin\Antheia\Classes\Wireframe\Wireframe;
use Cosmin\Antheia\Classes\Panel\Panel;
use Cosmin\Antheia\Classes\Html;

// init.php is used for initializing the framework
require '../utils/init.php';
$page = new PageEmpty();
// this function is defined inside utils/init.php required file
init_configurePage($page);
$page->setTitle('Wireframe example');
// ************************************************************* FIXED WIREFRAME
$fixedWireframe = new Wireframe();
// the wireframe will have a fixed width, according to the window width
$fixedWireframe->setType($fixedWireframe::TYPE_FIXED);
// adding a row to the wireframe
// - a wireframe row is divided into 12 imaginary columns
// - a wireframe cell can have a width of 1 to 12 of the row's collumns
// - a wireframe cell is invizible to the user, but it can contain visible elements
$row1 = $fixedWireframe->addRow();
// the row will have 5 cells
$cell11 = $row1->addCell();
$cell12 = $row1->addCell();
$cell13 = $row1->addCell();
$cell14 = $row1->addCell();
$cell15 = $row1->addCell();
/**
 * A width can be defined for 4 types of devices
 * - xs (extra small devices): below 768px window width
 * - sm (small devices): above 768px window width
 * - md (medium devices): above 992px window width
 * - ls (large devices): above 1200px window width
 */
// On narrow devices (xs) the cells will have a width of 12 columns (maximum)
// When a width is defines for a specific device, that definition is used
// for that device and all larger devices
// (the definition for xs will also be used for sm, md, lg)
$cell11->addWidth('xs', 12);
$cell12->addWidth('xs', 12);
// $cell13->addWidth('xs', 12); intentionally commented, as xs:12 is default
$cell14->addWidth('xs', 12);
$cell15->addWidth('xs', 12);
// on smaller devices (sm) cell 2 and 3 will have a width of 50% (6 columns)
// the rest of the cells, since have no definition for sm will inherit
// the width of the previous definition (12 columns)
$cell13->addWidth('sm', 6);
$cell14->addWidth('sm', 6);
// on medium devices (md), cells 2, 3, 4 will have 4 columns each
$cell12->addWidth('md', 4);
$cell13->addWidth('md', 4);
$cell14->addWidth('md', 4);
// on large screens (lg), cells 2, 3, 4 si 5 will have 3 columns each
$cell12->addWidth('lg', 3);
$cell13->addWidth('lg', 3);
$cell14->addWidth('lg', 3);
$cell15->addWidth('lg', 3);
// each cell will get a panel, to have it's content visible
$panel = $cell11->addPanel();
$panel->addText('<p>cell 11 (fixed wireframe)</p>
<p>A fixed wireframe has a fixed size, depending on the screen size.</p>
<p>The wireframe contains 12 
columns. Each cell can span on a fixed number of columns, depending on the
screen size.</p>');
$panel = $cell12->addPanel();
$panel->addText('cell 12 (fixed wireframe)');
$panel = $cell13->addPanel();
$panel->addText('cell 13 (fixed wireframe)');
$panel = $cell14->addPanel();
$panel->addText('cell 14 (fixed wireframe)');
// just as an example, the panel for cell 15 is first defined and then added
$panel = new Panel();
// html code can be added using Html class
$panel->addElement(new Html('<b>HTML bold code</b> in cell 15  (fixed wireframe)'));
$cell15->addElement($panel);
// ************************************************************* FLUID WIREFRAME
// creating another wireframe, but a fluid one this time
// a fluid wireframe will stretch the entire available width
$fluidWireframe = new Wireframe();
$fluidWireframe->setType($fixedWireframe::TYPE_FLUID);
// creating a new row
$row1 = $fluidWireframe->addRow();
// creating a new cell inside the row
$cell11 = $row1->addCell();
// on xs devices and above (that means always) the cell will have a 50% width (6 columns)
$cell11->addWidth('xs', 6);
$cell11->addPanel()->addText(
'<p>cell 11 (fluid wireframe)</p>');
// creating another row
$row2 = $fluidWireframe->addRow();
$cell21 = $row2->addCell();
// this cell will only span 8 columns, even on small devices
$cell21->addWidth('xs', 8);
$cell21->addPanel()->addText('cell 21 (fluid wireframe)');
// another row with a maximum width cell
$row3 = $fluidWireframe->addRow();
$cell31 = $row3->addCell();
// $cell31->addWidth('xs', 12); this is the default definition: xs:12
$cell31->addPanel()->addText('<p>cell 31 (fluid wireframe)</p>
<p>A fluid wireframe spans on the entire available width.</p>');
// ******************************************* ADDING THE WIREFRAMES TO THE PAGE
$page->addElement($fixedWireframe);
$page->addElement($fluidWireframe);
// adding a panel to display page source info
// the function is defined inside the utils/init.php file
init_insertPageSource($page, '02_wireframe', [
		['name' => 'index.php', 'info' => 'main']
], 'Example-2%3A-Wireframe-example');
// exporting the page
echo $page->getHtml();
?>