<?php
use Antheia\Antheia\Classes\Page\PageEmpty;
use Antheia\Antheia\Classes\Theme\ThemeSoftWarm;
// init.php is used for initializing the framework
require '../_utils/init.php';
$page = new PageEmpty();
// this function is defined inside utils/init.php required file
init_configurePage($page);
// defines the theme (overwrites the theme from the init_configurePage function)
$page->setTheme(new ThemeSoftWarm());
$page->setTitle('Soft warm theme');
// color scheme credits
$wireframe = $page->addWireframe();
$wireframe->setType($wireframe::TYPE_FIXED);
$row = $wireframe->addRow();
$cell = $row->addCell();
$cell->addWidth('xs', 12);
$panel = $cell->addPanel();
$panel->addText('<p>Colors provided freely by
<a href="https://www.schemecolor.com/soft-and-warm.php" target="_blank">Scheme Color</a>.
</p>');
require '_placeholder.php';
?>
