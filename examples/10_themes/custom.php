<?php
use Antheia\Antheia\Classes\Page\PageEditTheme;
// init.php is used for initializing the framework
require '../utils/init.php';
$page = new PageEditTheme();
// this function is defined inside utils/init.php required file
init_configurePage($page);
// adding a panel to display page source info
// the function is defined inside the utils/init.php file
init_insertPageSource($page, '10_themes', [
		['name' => 'custom.php', 'info' => 'main']
], 'Example-10%3A-Themes');
echo $page->getHtml();
?>