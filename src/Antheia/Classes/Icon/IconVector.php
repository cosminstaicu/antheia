<?php
namespace Cosmin\Antheia\Classes\Icon;
use Cosmin\Antheia\Interfaces\HtmlCode;
use Cosmin\Antheia\Classes\Exception;
use Cosmin\Antheia\Classes\Icon\VectorSet\MaterialDesign;
/**
 * A vector based icon, from a selectable set (Google Material Design)
 * @author Cosmin Staicu
 */
class IconVector implements HtmlCode {
	const TYPE_MATERIAL_DESIGN = 1;
	// available icons
	const ICON_ADD = 1;
	const ICON_ADD_INFO = 2;
	const ICON_ALERT = 3;
	const ICON_BACK = 4;
	const ICON_BUG = 5;
	const ICON_BUILDING = 6;
	const ICON_CHECKED = 7;
	const ICON_CLOSE = 8;
	const ICON_COLOR = 9;
	const ICON_COMPONENT = 10;
	const ICON_COPY = 11;
	const ICON_DOWN = 12;
	const ICON_DOWNLOAD = 13;
	const ICON_DATE = 14;
	const ICON_DELETE = 15;
	const ICON_EDIT = 16;
	const ICON_EMAIL= 17;
	const ICON_EXIT = 18;
	const ICON_FILE = 19;
	const ICON_FOLDER = 20;
	const ICON_FOLDER_EMPTY = 21;
	const ICON_HELP = 22;
	const ICON_INFO = 23;
	const ICON_LANGUAGE = 24;
	const ICON_LEFT = 25;
	const ICON_LOCATION = 26;
	const ICON_MENU = 27;
	const ICON_MESSAGE = 28;
	const ICON_NUMBER = 29;
	const ICON_ON_OFF = 30;
	const ICON_PASSWORD = 31;
	const ICON_PHONE = 32;
	const ICON_RIGHT = 33;
	const ICON_SEARCH = 34;
	const ICON_SETTINGS = 35;
	const ICON_SHOPPING = 36;
	const ICON_SHOPPING_ADD = 37;
	const ICON_SORT = 38;
	const ICON_SORT_ASC = 39;
	const ICON_SORT_DESC = 40;
	const ICON_STATUS = 41;
	const ICON_TIME = 42;
	const ICON_TRANSFER = 43;
	const ICON_UNCHECKED = 44;
	const ICON_UP = 45;
	const ICON_UPDATE = 46;
	const ICON_UPLOAD = 47;
	const ICON_USER = 48;
	const ICON_VALID = 49;
	// size of the icon
	const SIZE_SMALL = 1;
	const SIZE_NORMAL = 2;
	const SIZE_LARGE = 3;
	const SIZE_XL = 4;
	private $iconType;
	private $icon;
	private $size;
	private $symbol;
	private static $iconList = null;
	public function __construct() {
		$this->iconType = self::TYPE_MATERIAL_DESIGN;
		$this->icon = null;
		$this->size = self::SIZE_NORMAL;
		$this->symbol = self::ICON_ALERT;
		if (self::$iconList === null) {
			self::$iconList = [];
			$classDefinition = new \ReflectionClass(__CLASS__);
			$constantList = $classDefinition->getConstants();
			foreach ($constantList as $name => $value) {
				if (substr($name, 0, 5) == 'ICON_') {
					self::$iconList[] = $value;
				}
			}
		}
	}
	/**
	 * The type of the icon to be displayed (the render)
	 * @param integer $iconType the icon type, as a constant like
	 * IconVector::TIP_ICON_###
	 */
	public function setIconType(int $iconType):void {
		$this->iconType = $iconType;
	}
	/**
	 * The size of the icon
	 * @param integer $size the size of the element, as a constant like
	 * IconVector::SIZE_##
	 */
	public function setSize(int $size):void {
		$this->size = $size;
	}
	/**
	 * The icon to be displayed
	 * @param integer $icon the icon to be displayed, as a constant like
	 * IconVector::ICON_##
	 */
	public function setIcon(int $icon):void {
		if (!in_array($icon, self::$iconList)) {
			throw new Exception('Unknown constant');
		}
		$this->symbol = $icon;
	}
	/**
	 * Returns the name of the icon, as it is defined inside the render
	 * @return string the name of the icon
	 */
	public function getIconName():string {
		switch ($this->iconType) {
			case self::TYPE_MATERIAL_DESIGN:
				$this->icon = new MaterialDesign();
				$this->icon->setIcon($this->symbol);
				return $this->icon->getIconName();
				break;
			default:
				throw new Exception($this->iconType);
		}
	}
	public function getHtml():string {
		switch ($this->iconType) {
			case self::TYPE_MATERIAL_DESIGN:
				$this->icon = new MaterialDesign();
				break;
			default:
				throw new Exception($this->iconType);
		}
		$this->icon->setSize($this->size);
		$this->icon->setIcon($this->symbol);
		return $this->icon->getHtml();
	}
}
?>