<?php
use Antheia\Antheia\Classes\Page\PageEmpty;
use Antheia\Antheia\Classes\Table\Table;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Table\Formatted\Cell;
use Antheia\Antheia\Classes\Table\Formatted\Row;
use Antheia\Antheia\Classes\Menu\Item\MenuEdit;
use Antheia\Antheia\Classes\Table\TablePlain;
// init.php is used for initializing the framework
require '../_utils/init.php';
$page = new PageEmpty();
// this function is defined inside utils/init.php required file
init_configurePage($page);
$page->setTitle('Tables');
$wireframe = $page->addWireframe();
// *************************************************************** DEFAULT TABLE
$container = $wireframe->addRow()->addCell()->addPanel();
$container->setTitle('Default table');
$table = new Table();
$table->setWidth('100%');
$headerRow = $table->addRow();
$headerRow->addCell()->addText('Column 1');
$headerRow->addCell()->addElement(new Html('Column 2'));
$cell = new Cell();
$cell->addText('Column 3');
$headerRow->addCell($cell);
for ($i = 0; $i < 5; $i++) {
	$row = $table->addRow();
	$row->addCell()->addText('Row '.$i.' - Cell 1');
	$row->addCell()->addText('Row '.$i.' - Cell 2');
	$row->addCell()->addText('Row '.$i.' - Cell 3');
}
$row = new Row();
$cell = new Cell();
$cell->setColspan(3);
$button = new MenuEdit();
$button->setOnClick("alert('Button on colspan cell clicked')");
$cell->addElement($button);
$cell->setAlign($cell::ALIGN_CENTER);
$row->addCell($cell);
$table->addRow($row);
$container->addElement($table);
// **************************************** DEFAULT TABLE WITH HORIZONTAL SCROLL
$container = $wireframe->addRow()->addCell()->addPanel();
$container->setTitle('Default table with horizontal scroll');
$table = new Table();
$table->setHorizontalScroll();
for ($i = 0; $i < 5; $i++) {
	$row = $table->addRow();
	for ($j = 0; $j < 20; $j++) {
		$row->addCell()->addText('Row'.$i.'AndCell'.$j);
	}
}
$container->addElement($table);
// ******************************************** PLAIN HTML TABLE (NO FORMATTING)
$container = $wireframe->addRow()->addCell()->addPanel();
$container->setTitle('Plain HTML table');
$table = new TablePlain();
$table->setWidth('100%');
for ($i = 0; $i < 5; $i++) {
	$row = $table->addRow();
	$row->addCell()->addText('Row '.$i.' - Cell 1');
	$row->addCell()->addText('Row '.$i.' - Cell 2');
	$row->addCell()->addText('Row '.$i.' - Cell 3');
}
$container->addElement($table);
// adding a panel to display page source info
// the function is defined inside the utils/init.php file
init_insertPageSource($page, 'tables', [
		['name' => 'index.php', 'info' => 'main']
], 'Example%3A-Tables');
// page export
echo $page->getHtml();
?>