<?php
namespace Antheia\Antheia\Scripts\Media;
use Antheia\Antheia\Classes\Globals;
use Antheia\Antheia\Classes\Icon\IconPixelBig;
include __DIR__.'/../../Interfaces/HtmlCode.php';
include __DIR__.'/../../Interfaces/HtmlId.php';
include __DIR__.'/../../Interfaces/HtmlAttribute.php';
include __DIR__.'/../../Interfaces/HtmlClass.php';
include __DIR__.'/../../Classes/Exception.php';
include __DIR__.'/../../Classes/Globals.php';
include __DIR__.'/../../Classes/Internals.php';
include __DIR__.'/../../Classes/Icon/AbstractIcon.php';
include __DIR__.'/../../Classes/Icon/AbstractIconPixel.php';
include __DIR__.'/../../Classes/Icon/IconPixelBig.php';
/**
 * @var string $cachePath the path of the cache folder, defined inside
 * iconPixel32.php file, inside the cache folder
 */
Globals::setCache('', $cachePath);
if (!isset($_GET['i'])) {
	http_response_code(400);
	echo 'Missing parameter';
	exit;
}
if (!IconPixelBig::imageExists($_GET['i'])) {
	http_response_code(400);
	echo 'Image not found';
	exit();
}
$addon = '';
if (isset($_GET['a'])) {
	$addon = $_GET['a'];
}
$icon = new IconPixelBig($_GET['i'], $addon);
$absolutePath = $cachePath.substr($icon->getUrl(), 1);
header("Content-type: image/png");
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
header('Cache-Control: public, max-age=31536000, immutable');
readfile($absolutePath);
?>
