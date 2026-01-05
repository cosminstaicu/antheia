<?php
use Antheia\Antheia\Classes\Page\PageEmpty;
use Antheia\Antheia\Classes\Theme\ThemeDarkAesthetics;
// init.php is used for initializing the framework
require '../_utils/init.php';
$page = new PageEmpty();
// this function is defined inside utils/init.php required file
init_configurePage($page);
// defines the theme (overwrites the theme from the init_configurePage function)
$page->setTheme(new ThemeDarkAesthetics());
$page->setTitle('Dark Aesthetics theme');
// color scheme credits
$wireframe = $page->addWireframe();
$wireframe->setType($wireframe::TYPE_FIXED);
$row = $wireframe->addRow();
$cell = $row->addCell();
$cell->addWidth('xs', 12);
$panel = $cell->addPanel();
$panel->addText('<p>Colors provided freely by
<a href="https://www.schemecolor.com/dark-aesthetics-2.php" target="_blank">Scheme Color</a>.
</p>');
require '_placeholder.php';
?>
