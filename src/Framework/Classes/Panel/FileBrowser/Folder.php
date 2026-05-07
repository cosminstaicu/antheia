<?php
namespace Antheia\Framework\Classes\Panel\FileBrowser;
use Antheia\Framework\Classes\Texts;
use Antheia\Framework\Classes\Icon\IconPixelBig;
use Antheia\Framework\Classes\Panel\PanelFileBrowser;
/**
 * A folder from the file browser list. The class should not be called
 * by the end user. The method addFolder from the fileBrowser panel should be used
 * @author Cosmin Staicu
 */
class Folder extends AbstractItem {
	private $panel;
	public function __construct(?PanelFileBrowser $panel) {
		parent::__construct($panel);
		$this->setIconAltText(Texts::get('FOLDER'));
		$this->setIcon(new IconPixelBig('folder'));
		$this->addClass('ant-folder');
	}
}
?>
