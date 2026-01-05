<?php
namespace Antheia\Antheia\Scripts\Media;
use Antheia\Antheia\Classes\Globals;
use Antheia\Antheia\Classes\Icon\IconVector;
include __DIR__.'/../../Interfaces/HtmlCode.php';
include __DIR__.'/../../Interfaces/HtmlId.php';
include __DIR__.'/../../Interfaces/HtmlAttribute.php';
include __DIR__.'/../../Interfaces/HtmlClass.php';
include __DIR__.'/../../Classes/Exception.php';
include __DIR__.'/../../Classes/Globals.php';
include __DIR__.'/../../Classes/Internals.php';
include __DIR__.'/../../Classes/Icon/AbstractIcon.php';
include __DIR__.'/../../Classes/Icon/IconVector.php';
/**
 * @var string $cachePath the path of the cache folder, defined inside
 * iconVector.php file, inside the cache folder
 */
Globals::setCache('', $cachePath);
if (!isset($_GET['i'])) {
	http_response_code(400);
	echo 'Missing parameter';
	exit();
}
if (!IconVector::imageExists($_GET['i'])) {
	http_response_code(400);
	echo 'Image not found';
	exit();
}
$icon = new IconVector($_GET['i']);
$absolutePath = $cachePath.substr($icon->getUrl(), 1);
header("Content-type: image/png");
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
header('Cache-Control: public, max-age=31536000, immutable');
readfile($absolutePath);
?>
