<?php
namespace Cosmin\Antheia\Classes\Search\Views;
use Cosmin\Antheia\Classes\Icon\IconVector;
use Cosmin\Antheia\Classes\Wireframe\Wireframe;
use Cosmin\Antheia\Classes\Search\SearchResult;
use Cosmin\Antheia\Classes\Input\Raw\InputRawCheckbox;
use Cosmin\Antheia\Classes\Exception;
use Cosmin\Antheia\Classes\Html;
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
		return 'jsf_search_card_statusUpdate();';
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
			$code = '<div id="jsf_search_card_item_'.$index.'" class="jsf_search_card">';
			// selection checkbox
			if ($this->getSelectionStatus()) {
				$code .= '<div class="jsf_search_card-checkbox">';
				$check = new InputRawCheckbox();
				$check->setHtmlId('jsf_search_checkboxItem'.$index);
				$check->setValue($result->getItemId());
				$check->setOnClick('jsf_search_updateSelection()');
				$code .= $check->getHtml();
				$code .= '</div>';
			}
			$imageClass = '';
			switch ($result->getImageSize()) {
				case SearchResult::IMAGE_SIZE_MAXIMUM:
					$imageClass .= 'maximum';
					break;
				case SearchResult::IMAGE_SIZE_MEDIUM:
					$imageClass .= 'medium';
					break;
				default:
					throw new Exception($result->getImageSize());
			}
			switch ($result->getImageArea()) {
				case SearchResult::IMAGE_AREA_FILL:
					$imageClass .= ' fill';
					break;
				case SearchResult::IMAGE_AREA_FIT:
					$imageClass .= ' fit';
					break;
				default:
					throw new Exception($result->getImageArea());
			}
			if ($result->getImageLink() !== '') {
				$code .= '<a href="'.$result->getImageLink().'"
					class="jsf_search_card-imageLink" title="'
					.htmlspecialchars($result->getName()).'">';
			}
			$code .= '<img src="'.$result->getImageUrl().'" class="'
					.$imageClass.'" alt="Thumbnail">';
			if ($result->getImageLink() !== '') {
				$code .= '</a>';
			}
			$code .= '<p>'.htmlspecialchars($result->getName()).'</p>';
			if ($result->getImageSize() === SearchResult::IMAGE_SIZE_MEDIUM) {
				$code .= '<p>'.htmlspecialchars($result->getDescription()).'</p>';
			}
			$code .= '<a href="'.$result->getAccessHref().'"
				class="jsf_search_card-access">'
				.htmlspecialchars($result->getAccessText())
				.'</a>';
			$code .= '<a href="javascript:void(0)"
					onclick="jsf_search_card_toggleInfo(this.parentElement)">'
					.$slideIcon->getHtml().'</a>';
			// the hidden container
			$code .= '<div>';
			$code .= '<p>'.htmlspecialchars($result->getName()).'</p>';
			$properties = $result->getProperties();
			$code .= '<dl>';
			foreach ($properties as $property) {
				$code .= '<dt>'.htmlspecialchars($property['label']).'</dt>';
				$code .= '<dd>'.$property['value'].'</dd>';
			}
			$code .= '</dl>';
			$code .= '<a href="javascript:void(0)"
				onclick="jsf_search_card_toggleInfo(this.parentElement.parentElement)">'
				.$closeIcon->getHtml().'</a>';
			$code .= '</div>';
			$code .= '</div>';
			$cell->addElement(new Html($code));
		}
		return $wireframe->getHtml();
	}
}
?>