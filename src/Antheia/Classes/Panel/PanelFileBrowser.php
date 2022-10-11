<?php
namespace Antheia\Antheia\Classes\Panel;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Panel\FileBrowser\Folder;
use Antheia\Antheia\Classes\Panel\FileBrowser\File;
/**
 * A panel for browsing files and folders
 * @author Cosmin Staicu
 */
class PanelFileBrowser extends AbstractPanel {
	private $emptyText;
	private $files;
	private $folders;
	public function __construct() {
		parent::__construct();
		$this->emptyText = Texts::get('NO_ITEMS_FOUND');
		$this->files = [];
		$this->folders = [];
		$this->addClass('ant-fileBrowser');
	}
	/**
	 * Adds a new folder to the list. If no folder object is provided as a parameter
	 * then a new instance will be created
	 * @param Folder|NULL $folder (optional) the folder
	 * to be added. If the parameter is not defined then a new instance
	 * will be created
	 * @return Folder the added folder
	 */
	public function addFolder(Folder $folder = null):Folder {
		if ($folder === null) {
			$folder = new Folder($this);
		}
		$this->folders[] = $folder;
		return $folder;
	}
	/**
	 * Adds a new file to the list. If no folder object is provided as a parameter
	 * then a new instance will be created
	 * @param File|NULL $file (optional) the file
	 * to be added. If the parameter is not defined then a new instance
	 * will be created
	 * @return File the added file
	 */
	public function addFile(File $file = null):File {
		if ($file === null) {
			$file = new File($this);
		}
		$this->files[] = $file;
		return $file;
	}
	/**
	 * Set the text to be displayed when no items are available.
	 * @param string $text the text to be displayed when no items are available
	 */
	public function setEmptyText(string $text):void {
		$this->emptyText = $text;
	}
	public function addElement(HtmlCode $code):void {
		throw new Exception('Unable to add HTML elements to a file browser panel');
	}
	public function getHtml():string {
		$code = '';
		if ((count($this->folders) === 0) && (count($this->files) === 0)) {
			$icon = new IconVector();
			$icon->setIcon($icon::ICON_FOLDER_EMPTY);
			$icon->setSize($icon::SIZE_LARGE);
			$code .= '<p>'.$icon->getHtml();
			$code .= '<br>'.$this->emptyText.'</p>';
		}
		/** @var Folder $folder */
		foreach ($this->folders as $folder) {
			$code .= $folder->getHtml();
		}
		/** @var File $file */
		foreach ($this->files as $file) {
			$code .= $file->getHtml();
		}
		parent::addElement(new Html($code));
		return parent::getHtml();
	}
}
?>