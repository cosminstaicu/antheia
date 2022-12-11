<?php
namespace Antheia\Antheia\Classes\Icon\VectorSet;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Interfaces\Icon;
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
	public function setSize(int $size):void {
		switch ($size) {
			case IconVector::SIZE_SMALL:
				$this->size = 18;
				break;
			case IconVector::SIZE_NORMAL:
				$this->size = 24;
				break;
			case IconVector::SIZE_LARGE:
				$this->size = 36;
				break;
			case IconVector::SIZE_XL:
				$this->size = 48;
				break;
			default:
				throw new Exception($size);
		}
	}
	public function setIcon(string $name):void {
		switch ($name) {
			case IconVector::ICON_ADD:
				$this->icon = 'add';
				break;
			case IconVector::ICON_ADD_INFO:
				$this->icon = 'note_add';
				break;
			case IconVector::ICON_ALERT:
				$this->icon = 'warning';
				break;
			case IconVector::ICON_BACK:
				$this->icon = 'arrow_back';
				break;
			case IconVector::ICON_BUG:
				$this->icon = 'bug_report';
				break;
			case IconVector::ICON_BUILDING:
				$this->icon = 'business';
				break;
			case IconVector::ICON_CHECKED:
				$this->icon = 'done';
				break;
			case IconVector::ICON_CLOSE:
				$this->icon = 'close';
				break;
			case IconVector::ICON_COLOR:
				$this->icon = 'palette';
				break;
			case IconVector::ICON_COMPONENT:
				$this->icon = 'view_module';
				break;
			case IconVector::ICON_COPY:
				$this->icon = 'content_copy';
				break;
			case IconVector::ICON_DOWN:
				$this->icon = 'arrow_downward';
				break;
			case IconVector::ICON_DOWNLOAD:
				$this->icon = 'file_download';
				break;
			case IconVector::ICON_DATE:
				$this->icon = 'date_range';
				break;
			case IconVector::ICON_DELETE:
				$this->icon = 'delete';
				break;
			case IconVector::ICON_EDIT:
				$this->icon = 'mode_edit';
				break;
			case IconVector::ICON_EMAIL:
				$this->icon = 'email';
				break;
			case IconVector::ICON_EXIT:
				$this->icon = 'exit_to_app';
				break;
			case IconVector::ICON_FILE:
				$this->icon = 'attachment';
				break;
			case IconVector::ICON_FOLDER:
				$this->icon = 'folder';
				break;
			case IconVector::ICON_FOLDER_EMPTY:
				$this->icon = 'folder_off';
				break;
			case IconVector::ICON_HELP:
				$this->icon = 'help';
				break;
			case IconVector::ICON_INFO:
				$this->icon = 'info_outline';
				break;
			case IconVector::ICON_LANGUAGE:
				$this->icon = 'language';
				break;
			case IconVector::ICON_LEFT:
				$this->icon = 'arrow_back';
				break;
			case IconVector::ICON_LOCATION:
				$this->icon = 'place';
				break;
			case IconVector::ICON_MENU:
				$this->icon = 'menu';
				break;
			case IconVector::ICON_MESSAGE:
				$this->icon = 'message';
				break;
			case IconVector::ICON_NUMBER:
				$this->icon = 'dialpad';
				break;
			case IconVector::ICON_ON_OFF:
				$this->icon = 'power_settings_new';
				break;
			case IconVector::ICON_PASSWORD:
				$this->icon = 'lock';
				break;
			case IconVector::ICON_PHONE:
				$this->icon = 'phone';
				break;
			case IconVector::ICON_RIGHT:
				$this->icon = 'arrow_forward';
				break;
			case IconVector::ICON_SEARCH:
				$this->icon = 'search';
				break;
			case IconVector::ICON_SETTINGS:
				$this->icon = 'settings';
				break;
			case IconVector::ICON_SHOPPING:
				$this->icon = 'shopping_cart' ;
				break;
			case IconVector::ICON_SHOPPING_ADD:
				$this->icon = 'add_shopping_cart';
				break;
			case IconVector::ICON_SORT:
				$this->icon = 'sort';
				break;
			case IconVector::ICON_SORT_ASC:
				$this->icon = 'expand_less';
				break;
			case IconVector::ICON_SORT_DESC:
				$this->icon = 'expand_more';
				break;
			case IconVector::ICON_STATUS:
				$this->icon = 'playlist_add_check';
				break;
			case IconVector::ICON_TIME:
				$this->icon = 'access_time';
				break;
			case IconVector::ICON_TRANSFER:
				$this->icon = 'compare_arrows';
				break;
			case IconVector::ICON_UNCHECKED:
				$this->icon = 'check_box_outline_blank';
				break;
			case IconVector::ICON_UP:
				$this->icon = 'arrow_upward';
				break;
			case IconVector::ICON_UPDATE:
				$this->icon = 'autorenew';
				break;
			case IconVector::ICON_UPLOAD:
				$this->icon = 'file_upload';
				break;
			case IconVector::ICON_USER:
				$this->icon = 'person';
				break;
			case IconVector::ICON_VALID:
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
		$css = 'font-size: var(--ant_var-rem'.$this->size.'px);';
		$code .= ' style="'.$css.'" ';
		$code .= '>'.$this->icon.'</i>';
		return $code;
	}
}
?>