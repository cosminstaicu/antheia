<?php
use Antheia\Antheia\Classes\Page\PageMessage;
// init.php is used for initializing the framework
require '../_utils/init.php';
$page = new PageMessage();
// this function is defined inside utils/init.php required file
init_configurePage($page);
$page->setTitle('Message page');
$page->setMessage('Just a message to be displayed to the user', 'The title');
// adding a panel to display page source info
// the function is defined inside the utils/init.php file
init_insertPageSource($page, 'message', [
		['name' => 'index.php', 'info' => 'main']
], 'Example%3A-Message');
// page export
echo $page->getHtml();
?>
