<?php
use Cosmin\Antheia\Classes\Page\PageEmpty;
use Cosmin\Antheia\Classes\Theme\ThemeDefault;
// init.php is used for initializing the framework
require '../utils/init.php';
$page = new PageEmpty();
// this function is defined inside utils/init.php required file
init_configurePage($page);
// defines the theme (overwrites the theme from the init_configurePage function)
$page->setTheme(new ThemeDefault());
$page->setTitle('Default theme');
require '_placeholder.php';
?>