<?php
namespace Cosmin\Antheia\Classes\Icon\VectorSet;
use Cosmin\Antheia\Interfaces\Icon;
use Cosmin\Antheia\Classes\Exception;
/**
 * An vector based icon from the material design set (Google)
 * Warning! This class should not be instanced by the user. A class of
 * Vector type should be used. This procedure allows for including
 * more icon sets in the final product.
 * @author Cosmin Staicu
 *
 */
class MaterialDesign implements Icon {
	private $icon;
	private $size;
	public function __construct() {
		$this->icon = 'warning';
		$this->size = 24;
	}
	public function setSize(int $size) {
		switch ($size) {
			case Icon::SIZE_SMALL:
				$this->size = 18;
				break;
			case Icon::SIZE_NORMAL:
				$this->size = 24;
				break;
			case Icon::SIZE_LARGE:
				$this->size = 36;
				break;
			case Icon::SIZE_XL:
				$this->size = 48;
				break;
			default:
				throw new Exception($size);
		}
	}
	public function setIcon(string $name) {
		switch ($name) {
			case Icon::ICON_ADD:
				$this->icon = 'add';
				break;
			case Icon::ICON_ADD_INFO:
				$this->icon = 'note_add';
				break;
			case Icon::ICON_ALERT:
				$this->icon = 'warning';
				break;
			case Icon::ICON_BACK:
				$this->icon = 'arrow_back';
				break;
			case Icon::ICON_BUG:
				$this->icon = 'bug_report';
				break;
			case Icon::ICON_BUILDING:
				$this->icon = 'business';
				break;
			case Icon::ICON_CHECKED:
				$this->icon = 'done';
				break;
			case Icon::ICON_CLOSE:
				$this->icon = 'close';
				break;
			case Icon::ICON_COLOR:
				$this->icon = 'palette';
				break;
			case Icon::ICON_COMPONENT:
				$this->icon = 'view_module';
				break;
			case Icon::ICON_COPY:
				$this->icon = 'content_copy';
				break;
			case Icon::ICON_DOWN:
				$this->icon = 'arrow_downward';
				break;
			case Icon::ICON_DOWNLOAD:
				$this->icon = 'file_download';
				break;
			case Icon::ICON_DATE:
				$this->icon = 'date_range';
				break;
			case Icon::ICON_DELETE:
				$this->icon = 'delete';
				break;
			case Icon::ICON_EDIT:
				$this->icon = 'mode_edit';
				break;
			case Icon::ICON_EMAIL:
				$this->icon = 'email';
				break;
			case Icon::ICON_EXIT:
				$this->icon = 'exit_to_app';
				break;
			case Icon::ICON_FILE:
				$this->icon = 'attachment';
				break;
			case Icon::ICON_FOLDER:
				$this->icon = 'folder';
				break;
			case Icon::ICON_FOLDER_EMPTY:
				$this->icon = 'folder_off';
				break;
			case Icon::ICON_HELP:
				$this->icon = 'help';
				break;
			case Icon::ICON_INFO:
				$this->icon = 'info_outline';
				break;
			case Icon::ICON_LANGUAGE:
				$this->icon = 'language';
				break;
			case Icon::ICON_LEFT:
				$this->icon = 'arrow_back';
				break;
			case Icon::ICON_LOCATION:
				$this->icon = 'place';
				break;
			case Icon::ICON_MENU:
				$this->icon = 'menu';
				break;
			case Icon::ICON_MESSAGE:
				$this->icon = 'message';
				break;
			case Icon::ICON_NUMBER:
				$this->icon = 'dialpad';
				break;
			case Icon::ICON_ON_OFF:
				$this->icon = 'power_settings_new';
				break;
			case Icon::ICON_PASSWORD:
				$this->icon = 'lock';
				break;
			case Icon::ICON_PHONE:
				$this->icon = 'phone';
				break;
			case Icon::ICON_RIGHT:
				$this->icon = 'arrow_forward';
				break;
			case Icon::ICON_SEARCH:
				$this->icon = 'search';
				break;
			case Icon::ICON_SETTINGS:
				$this->icon = 'settings';
				break;
			case Icon::ICON_SHOPPING:
				$this->icon = 'shopping_cart' ;
				break;
			case Icon::ICON_SHOPPING_ADD:
				$this->icon = 'add_shopping_cart';
				break;
			case Icon::ICON_SORT:
				$this->icon = 'sort';
				break;
			case Icon::ICON_SORT_ASC:
				$this->icon = 'expand_less';
				break;
			case Icon::ICON_SORT_DESC:
				$this->icon = 'expand_more';
				break;
			case Icon::ICON_STATUS:
				$this->icon = 'playlist_add_check';
				break;
			case Icon::ICON_TIME:
				$this->icon = 'access_time';
				break;
			case Icon::ICON_TRANSFER:
				$this->icon = 'compare_arrows';
				break;
			case Icon::ICON_UNCHECKED:
				$this->icon = 'check_box_outline_blank';
				break;
			case Icon::ICON_UP:
				$this->icon = 'arrow_upward';
				break;
			case Icon::ICON_UPDATE:
				$this->icon = 'autorenew';
				break;
			case Icon::ICON_UPLOAD:
				$this->icon = 'file_upload';
				break;
			case Icon::ICON_USER:
				$this->icon = 'person';
				break;
			case Icon::ICON_VALID:
				$this->icon = 'done';
				break;
			default:
				throw new Exception($name);
		}
	}
	public function getIconName():string {
		return $this->icon;
	}
	public function getHtml():string {
		$code = '<i class="material-icons"';
		$css = '';
		if ($this->size !== 24) {
			$css .= 'font-size: '.$this->size.'px;';
		}
		if ($css !== '') {
			$code .= ' style="'.$css.'" ';
		}
		$code .= '>'.$this->icon.'</i>';
		return $code;
	}
}
?>