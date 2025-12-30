<?php
namespace Antheia\Antheia\Classes\Search;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Internals;
use Antheia\Antheia\Classes\Icon\AbstractIcon;
/**
 * A search result from a search. The result contains only the raw data of the
 * result. An instance of this class will be later rendered using one of the
 * available renders (AbstractSearchView) that will display the result
 * as a table, a card, an accordion etc
 * @author Cosmin Staicu
 */
class SearchResult extends AbstractClass {
	const IMAGE_SIZE_MEDIUM = 'medium';
	const IMAGE_SIZE_MAXIMUM = 'maximum';
	const IMAGE_AREA_FIT = 'fit';
	const IMAGE_AREA_FILL = 'fill';
	const LINK = 'link';
	const BUTTON = 'button';
	private $name;
	private $description;
	private $accessText;
	private $accessHref;
	private $accessOnClick;
	private $accessRender;
	private $properties;
	private $resultId;
	private $image;
	private $icon;
	private $buttons;
	private $imageSize;
	private $imageArea;
	private $imageLink;
	public function __construct() {
		parent::__construct();
		$this->setName('Undefined');
		$this->description = '';
		$this->properties = [];
		$this->setAccessHref('#');
		$this->accessText = '';
		$this->accessOnClick = '';
		$this->accessRender = self::LINK;
		$this->resultId = '';
		$this->image = Internals::getCacheUrl().'/logo.svg';
		$this->icon = null;
		$this->buttons = [];
		$this->imageSize = self::IMAGE_SIZE_MEDIUM;
		$this->imageArea = self::IMAGE_AREA_FIT;
		$this->imageLink = '';
	}
	/**
	 * Defines the id of the result. The id is used to identify the items that
	 * have a selected checkbox. The selected elements are returned by the
	 * javascript function ant_search_getSelected()
	 * @param string $id the id of the result
	 */
	public function setItemId(string $id):void {
		$this->resultId = $id;
	}
	/**
	 * Returns the id of the result. The id is used to identify the items
	 * that have a selected checkbox. The selected elements are returned
	 * by the javascript function ant_search_getSelected()
	 * @return string the id of the result
	 */
	public function getItemId():string {
		return $this->resultId;
	}
	/**
	 * Defines the render to be used for the access button.
	 * The access button is displayed by the accordion and card render.
	 * @param string $render the render to be used as one of the constants:
	 * \Antheia\Antheia\Classes\Search\SearchResult::LINK
	 * \Antheia\Antheia\Classes\Search\SearchResult::BUTTON
	 */
	public function setAccessRender(string $render):void {
		$this->accessRender = $render;
	}
	/**
	 * Returns the render type to be used for the access button.
	 * The access button is displayed by the accordion and card render.
	 * @return string the render to be used for the access button, as one
	 * of the constants:
	 * \Antheia\Antheia\Classes\Search\SearchResult::LINK
	 * \Antheia\Antheia\Classes\Search\SearchResult::BUTTON
	 */
	public function getAccessRender():string {
		return $this->accessRender;
	}
	/**
	 * Defines the href (the url) for the access button, used for accesing the
	 * entity details page.
	 * The access button is displayed by the accordion and card render
	 * @param string $href the href (the url) for the access button, used for
	 * accesing the entity details page.
	 */
	public function setAccessHref(string $href):void {
		$this->accessHref = $href;
	}
	/**
	 * Returns the href (the url) for the access button, used for accesing the
	 * entity details page.
	 * The access button is displayed by the accordion and card render
	 * @return string the href (the url) for the access button, used for
	 * accesing the entity details page.
	 */
	public function getAccessHref():string {
		return $this->accessHref;
	}
	/**
	 * Defines the on click script for the access button, used for accesing the
	 * entity details page.
	 * The access button is displayed by the accordion and card render.
	 * @param string $javascript the script for the access button, used for
	 * accesing the entity details page.
	 */
	public function setAccessOnClick(string $javascript):void {
		$this->accessOnClick = $javascript;
	}
	/**
	 * Returns the on click script for the access button, used for accesing the
	 * entity details page.
	 * The access button is displayed by the accordion and card render
	 * @return string on click script for the access button, used for
	 * accesing the entity details page.
	 */
	public function getAccessOnClick():string {
		return $this->accessOnClick;
	}
	/**
	 * Defines the text placed on the access button. It is used by the
	 * card view (text shown on the access button) and by the accordion view
	 * (title of the access button).
	 * @param string $text the text placed on the access button
	 */
	public function setAccessText(string $text):void {
		$this->accessText = $text;
	}
	/**
	 * Returns the text placed on the access button. It is used only by the
	 * card render.
	 * @return string the text placed on the access button. It is used only by the
	 * card render.
	 */
	public function getAccessText():string {
		return $this->accessText;
	}
	/**
	 * Defines the name of the item
	 * @param string $name the name of the item
	 */
	public function setName(string $name):void {
		$this->name = $name;
	}
	/**
	 * Returns the name of the item
	 * @return string the name of the item
	 */
	public function getName():string {
		return $this->name;
	}
	/**
	 * Defines a short description of the item. It is only used by the card
	 * render and the accordion render .
	 * @param string $description a short description of the item
	 */
	public function setDescription(string $description):void {
		$this->description = $description;
	}
	/**
	 * Returns a short description of the item. It is only used by the card
	 * render.
	 * @return string a short description of the item
	 */
	public function getDescription():string {
		return $this->description;
	}
	/**
	 * Defines an image for the item. The image is only used by the card render
	 * @param string $url the url of the image (relative to the url
	 * of the document.
	 */
	public function setImageUrl(string $url):void {
		$this->image = $url;
	}
	/**
	 * Returns the url of the image used for the item. The image is only used
	 * by the card render.
	 * @return string the url of the image, relative to the url of the document.
	 */
	public function getImageUrl():string {
		return $this->image;
	}
	/**
	 * Defines the size of the image to be displayed. It is only used by the
	 * card render.
	 * @param string $size the size of the image to be displayed inside
	 * the card, as a constant like SearchResult::IMAGE_SIZE_##
	 */
	public function setImageSize(string $size):void {
		$this->imageSize = $size;
	}
	/**
	 * Returns the size of the image to be displayed. It is only used by the
	 * card render.
	 * @return string the size of the image to be displayed inside
	 * the card, as a constant like SearchResult::IMAGE_SIZE_##
	 */
	public function getImageSize():string {
		return $this->imageSize;
	}
	/**
	 * Defines the fill type used for the image area inside a card element.
	 * @param string $type the fill type for the image area, defined with one of
	 * the constants:<br>
	 * - SearchResult::IMAGE_AREA_FIT - the entire image will be displayed
	 * but the image area will contain empty zones (fit image to area)<br>
	 * - SearchResult::IMAGE_AREA_FILL - the image will fill the available
	 * area but some parts of the image will not be visible (fill area with image)
	 */
	public function setImageArea(string $type):void {
		$this->imageArea = $type;
	}
	/**
	 * Returns the fill type used for the image area inside a card element.
	 * @return string the fill type for the image area, defined with one of
	 * the constants:<br>
	 * - SearchResult::IMAGE_AREA_FIT - the entire image will be displayed
	 * but the image area will contain empty zones (fit image to area)<br>
	 * - SearchResult::IMAGE_AREA_FILL - the image will fill the available
	 * area but some parts of the image will not be visible (fill area with image)
	 */
	public function getImageArea():string {
		return $this->imageArea;
	}
	/**
	 * Set a link for the image inside a card element.
	 * @param string $link the link to be attached to the image inside the card
	 * element. If no link is needed then the parameter should be an empty string
	 */
	public function setImageLink(string $link):void {
		$this->imageLink = $link;
	}
	/**
	 * Returns the link for the image inside a card element.
	 * @return string the link for the image inside a card element. If no link
	 * is needed then an empty string is returned.
	 */
	public function getImageLink():string {
		return $this->imageLink;
	}
	/**
	 * Defines the icon, used by the accordion and card renders.
	 * @param AbstractIcon $icon the icon used to render the result or null if
	 * no icon available
	 */
	public function setIcon(?AbstractIcon $icon):void {
		$this->icon = $icon;
	}
	/**
	 * Returns the icon used by the accordion and card renders.
	 * @return NULL|AbstractIcon the icon used by the render or null if no icon
	 * is defined
	 */
	public function getIcon():?AbstractIcon {
		return $this->icon;
	}
	/**
	 * Adds a property for the item (a property that will be displayed inside
	 * the rendered element)
	 * @param string $label the label of the property
	 * @param string $value the value of the property
	 */
	public function addProperty(string $label, string $value):void {
		$this->properties[] = ['label' => $label, 'value' => $value];
	}
	/**
	 * Returns a list with all defined properties of the item
	 * @return string[][] all properties of the item as an array. Each item
	 * inside the array has 2 items: label (the label of the property) and
	 * "value" (the value of the property
	 */
	public function getProperties():array {
		return $this->properties;
	}
	/**
	 * Defines a button to be added to the displayed element. The button is only
	 * displayed when an accordion is rendered.
	 * @param string $text the text of the button
	 * @param string $onClick the javascript code to be executed when the button
	 * is clicked
	 */
	public function addButton(string $text, string $onClick):void {
		$buton = ['text'=>$text, 'onClick'=>$onClick];
		$this->buttons[] = $buton;
	}
	/**
	 * Returns a list with all buttons to be added to the item
	 * @return string[][] a list with all buttons to be added to the item. Each
	 * item in the list is an array with 2 properties: "text" (the text to be
	 * displayed on the button) and "onClick" (the javascript code to be
	 * executed when the button is clicked)
	 */
	public function getButtons():array {
		return $this->buttons;
	}
}
?>