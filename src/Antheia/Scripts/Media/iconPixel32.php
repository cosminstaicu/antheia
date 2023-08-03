<?php
namespace Antheia\Antheia\Scripts\Media;
use Antheia\Antheia\Classes\Icon\IconPixelBig;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Globals;
include __DIR__.'/../../Classes/Exception.php';
include __DIR__.'/../../Classes/Globals.php';
include __DIR__.'/../../Classes/Internals.php';
include __DIR__.'/../../Classes/Icon/AbstractPixelIcon.php';
include __DIR__.'/../../Classes/Icon/IconPixelBig.php';
/**
 * @var string $cachePath the path of the cache folder, defined inside
 * iconPixel32.php file, inside the cache folder
 */
Globals::setCache('', $cachePath);
if (!isset($_GET['i'])) {
	throw new Exception('Missing parameter');
}
$addon = '';
if (isset($_GET['a'])) {
	$addon = $_GET['a'];
}
$icon = new IconPixelBig($_GET['i'], $addon);
$absolutePath = $cachePath.$icon->getUrl();
header("Content-type: image/png");
header('Expires: 0');
header('Content-Length: ' . filesize($absolutePath));
readfile($absolutePath);
?>