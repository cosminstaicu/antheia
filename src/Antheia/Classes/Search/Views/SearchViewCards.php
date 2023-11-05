<?php
namespace Antheia\Antheia\Classes\Search\Views;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Icon\IconPixelBig;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Classes\Input\Raw\InputRawCheckbox;
use Antheia\Antheia\Classes\Search\SearchResult;
use Antheia\Antheia\Classes\Wireframe\Wireframe;
/**
 * A search result render that displays the results as cards. The card has
 * an image being displayed that can slide to reveal additional info.
 * @author Cosmin Staicu
 */
class SearchViewCards extends AbstractSearchView {
	public function __construct() {
		parent::__construct();
	}
	public function getJavascriptStatusUpdate():string {
		return 'ant_search_card_statusUpdate();';
	}
	public function getHtml():string {
		$slideIcon = new IconVector();
		$slideIcon->setIcon(IconVector::ICON_UP);
		$closeIcon = new IconVector();
		$closeIcon->setIcon(IconVector::ICON_CLOSE);
		$results = $this->getItems();
		if (count($results) === 0) {
			$emptyList = new SearchViewEmpty();
			$emptyList->setText($this->getNoItemsText());
			return $emptyList->getHtml();
		}
		$wireframe = new Wireframe();
		$row = $wireframe->addRow();
		/** @var SearchResult $result */
		foreach ($results as $index => $result) {
			$cell = $row->addCell();
			$cell->addWidth('lg', 3);
			$cell->addWidth('md', 4);
			$cell->addWidth('sm', 6);
			$divClass = 'ant_search_card';
			switch ($result->getImageSize()) {
				case SearchResult::IMAGE_SIZE_MAXIMUM:
					$divClass .= ' ant-image-maximum';
					break;
				case SearchResult::IMAGE_SIZE_MEDIUM:
					$divClass .= ' ant-image-medium';
					break;
				default:
					throw new Exception($result->getImageSize());
			}
			$code = '<div id="ant_search_card_item_'.$index.'" class="'.$divClass.'">';
			// selection checkbox
			if ($this->getSelectionStatus()) {
				$code .= '<div class="ant_search_card-checkbox">';
				$check = new InputRawCheckbox();
				$check->setHtmlId('ant_search_checkboxItem'.$index);
				$check->setValue($result->getItemId());
				$check->setOnClick('ant_search_updateSelection()');
				$code .= $check->getHtml();
				$code .= '</div>';
			}
			$imageClass = 'ant-main';
			switch ($result->getImageArea()) {
				case SearchResult::IMAGE_AREA_FILL:
					$imageClass .= ' ant-fill';
					break;
				case SearchResult::IMAGE_AREA_FIT:
					$imageClass .= ' ant-fit';
					break;
				default:
					throw new Exception($result->getImageArea());
			}
			if ($result->getImageLink() !== '') {
				$code .= '<a href="'.$result->getImageLink().'"
					class="ant_search_card-imageLink" title="'
					.htmlspecialchars(strip_tags($result->getName())).'">';
			}
			$code .= '<img src="'.$result->getImageUrl().'" class="'
					.$imageClass.'" alt="Thumbnail">';
			if ($result->getImageLink() !== '') {
				$code .= '</a>';
			}
			if ($result->getIcon() !== NULL) {
				$icon = new IconPixelBig($result->getIcon()['icon']);
				if ($result->getIcon()['addon'] != '') {
					$icon->setBottomRightIcon($result->getIcon()['addon']);
				}
				$code .= '<div class="ant-icon"><img src="'.$icon->getUrl()
					.'" width="32" height="32" alt="'
					.str_replace(['"',"'","\\"], ['','',''], $result->getName())
					.'"></div>';
			}
			$code .= '<p>'.$result->getName().'</p>';
			if ($result->getImageSize() === SearchResult::IMAGE_SIZE_MEDIUM) {
				$code .= '<p>'.$result->getDescription().'</p>';
			}
			$onClick = $result->getAccessOnClick();
			if ($onClick !== '') {
				$onClick = ' onclick="'.$onClick.'"';
			}
			switch ($result->getAccessRender()) {
				case $result::LINK:
					$code .= '<a href="'.$result->getAccessHref().'"
						class="ant_search_card-access"'.$onClick.'>'
						.htmlspecialchars($result->getAccessText())
						.'</a>';
					break;
				case $result::BUTTON:
					$code .= '<button type="button" class="ant_search_card-access"'
						.$onClick.'>'.htmlspecialchars($result->getAccessText())
						.'</button>';
					break;
				default:
					throw new Exception('Invalid render '.$result->getAccessRender());
			}
			$code .= '<button type="button"
					onclick="ant_search_card_toggleInfo(this.parentElement)">'
					.$slideIcon->getHtml().'</button>';
			// the hidden container
			$code .= '<div>';
			$code .= '<p>'.$result->getName().'</p>';
			$properties = $result->getProperties();
			$code .= '<dl>';
			foreach ($properties as $property) {
				$code .= '<dt>'.htmlspecialchars($property['label']).'</dt>';
				$code .= '<dd>'.$property['value'].'</dd>';
			}
			$code .= '</dl>';
			$code .= '<button type="button"
				onclick="ant_search_card_toggleInfo(this.parentElement.parentElement)">'
				.$closeIcon->getHtml().'</button>';
			$code .= '</div>';
			$code .= '</div>';
			$cell->addElement(new Html($code));
		}
		return $wireframe->getHtml();
	}
}
?>