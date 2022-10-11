<?php
namespace Cosmin\Antheia\Classes\Search\Views;
use Cosmin\Antheia\Classes\Search\SearchResult;
use Cosmin\Antheia\Classes\Panel\Panel;
use Cosmin\Antheia\Classes\Html;
use Cosmin\Antheia\Classes\Input\Raw\InputRawCheckbox;
use Cosmin\Antheia\Classes\Icon\IconPixelBig;
use Cosmin\Antheia\Classes\Icon\IconVector;
use Cosmin\Antheia\Classes\Wireframe\Wireframe;
use Cosmin\Antheia\Classes\Slide\SlidePanel;
/**
 * A search result render that displays the results as an accordion
 * (only the name of the item is displayed, when clicked the panel will expand,
 * showing additional details)
 * @author Cosmin Staicu
 */
class SearchViewAccordion extends AbstractSearchView {
	public function __construct() {
		parent::__construct();
	}
	public function getJavascriptStatusUpdate():string {
		return 'ant_search_accordion_statusUpdate();';
	}
	public function getHtml():string {
		$results = $this->getItems();
		if (count($results) === 0) {
			$emptyList = new SearchViewEmpty();
			$emptyList->setText($this->getNoItemsText());
			return $emptyList->getHtml();
		}
		$code = '<div id="ant_search_accordion">';
		/** @var SearchResult $result */
		foreach ($results as $index => $result) {
			$panel = new Panel();
			$panel->setHtmlId('ant_search_accordion_item_'.$index);
			$slidePanel = new SlidePanel();
			$titleCode = new Html();
			// selection checkbox
			if ($this->getSelectionStatus()) {
				$check = new InputRawCheckbox();
				$check->setHtmlId('ant_search_checkboxItem'.$index);
				$check->setValue($result->getItemId());
				$check->setOnClick('ant_search_updateSelection()');
				$titleCode->addElement($check);
			}
			// left side icon
			$iconInfo = $result->getInfo();
			if ($iconInfo !== null) {
				$icon = new IconPixelBig($iconInfo['icon']);
				if ($iconInfo['addon'] != '') {
					$icon->setBottomRightIcon($iconInfo['addon']);
				}
				$titleCode->addRawCode(
					'<img src="'.$icon->getUrl().'" width="32" height="32" alt="Logo")">'
				);
			}
			// slide trigger
			$button = $slidePanel->getController();
			$button->setDisplayIcon(false);
			$button->setText($result->getName());
			$button->setAfterCallback('ant_search_accordion_click');
			$titleCode->addElement($button);
			// access button
			$icon = new IconVector();
			$icon->setIcon(IconVector::ICON_RIGHT);
			$titleCode->addRawCode(
				'<a href="'.$result->getAccessHref().'">'.$icon->getHtml().'</a>'
			);
			$panel->setHtmlTitle($titleCode);
			$wireframe = new Wireframe();
			// additional buttons
			$buttons = $result->getButtons();
			if (count($buttons) > 0) {
				$row = $wireframe->addRow();
				$row->addClass('ant-buttons-row');
				$cell = $row->addCell();
				foreach ($buttons as $buttonInfo) {
					$cell->addElement(new Html(
						'<input type="button" value="'
							.$buttonInfo['text'].'" onClick="'
							.$buttonInfo['onClick'].'">'
					));
				}
			}
			$row = $wireframe->addRow();
			$row->addClass('ant-properties-row');
			$properties = $result->getProperties();
			foreach ($properties as $property) {
				$cell = $row->addCell();
				$cell->addWidth('sm', 6);
				$cell->addWidth('md', 4);
				$cell->addWidth('lg', 3);
				$cell->addElement(new Html(
					'<div>'.$property['label'].'</div>
					<div>'.$property['value'].'</div>'	
				));
			}
			if ($result->getDescription() !== '') {
				$row = $wireframe->addRow();
				$cell = $row->addCell();
				$cell->addWidth('xs', 12);
				$cell->addElement(new Html($result->getDescription()));
			}
			$slidePanel->addHidden($wireframe);
			$panel->addElement($slidePanel);
			$code .= $panel->getHtml();
		}
		$code .= '</div>';
		return $code;
	}
}
?>