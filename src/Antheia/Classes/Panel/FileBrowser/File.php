<?php
namespace Antheia\Antheia\Classes\Panel\FileBrowser;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconPixelBig;
use Antheia\Antheia\Classes\Panel\PanelFileBrowser;
/**
 * A file from the file browser list. The class should not be called
 * by the end user. The method addFile from the fileBrowser panel should be used
 * @author Cosmin Staicu
 */
class File extends AbstractItem {
	private $panel;
	private $manualIcon;
	public function __construct(?PanelFileBrowser $panel) {
		parent::__construct($panel);
		$this->setIconAltText(Texts::get('FILE'));
		parent::setIcon(new IconPixelBig('document_empty'));
		$this->addClass('ant-file');
		$this->manualIcon = false;
	}
	public function setIcon(IconPixelBig $icon):void {
		$this->manualIcon = true;
		parent::setIcon($icon);
	}
	public function setName(string $name):void {
		parent::setName($name);
		if ($this->manualIcon) {
			return;
		}
		if (strpos($name, '.') === false) {
			return;
		}
		$extension = substr($name, 1 - strlen($name) + strrpos($name, '.'));
		if (strlen($extension) !== 3) {
			return;
		}
		$extension = 'file_extension_'.strtolower($extension);
		if (IconPixelBig::imageExists($extension)) {
			parent::setIcon(new IconPixelBig($extension));
		} else {
			parent::setIcon(new IconPixelBig('document_empty'));
		}
	}
}
?>
