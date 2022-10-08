<?php
namespace Cosmin\Antheia\Classes\Panel\FileBrowser;
use Cosmin\Antheia\Classes\Panel\PanelFileBrowser;
use Cosmin\Antheia\Classes\Texts;
use Cosmin\Antheia\Classes\Icon\IconPixelBig;
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
		$this->addClass('jsf-folder');
	}
}
?>