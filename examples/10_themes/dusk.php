<?php
use Cosmin\Antheia\Classes\Page\PageEmpty;
use Cosmin\Antheia\Classes\Theme\ThemeDusk;
// init.php is used for initializing the framework
require '../utils/init.php';
$page = new PageEmpty();
// this function is defined inside utils/init.php required file
init_configurePage($page);
// defines the theme (overwrites the theme from the init_configurePage function)
$page->setTheme(new ThemeDusk());
$page->setTitle('Dusk theme');
// color scheme credits
$wireframe = $page->addWireframe();
$wireframe->setType($wireframe::TYPE_FIXED);
$row = $wireframe->addRow();
$cell = $row->addCell();
$cell->addWidth('xs', 12);
$panel = $cell->addPanel();
$panel->addText('<p>Colors provided freely by
<a href="https://www.schemecolor.com/gradient-at-dusk.php" target="_blank">Scheme Color</a>.
</p>');
require '_placeholder.php';
?>