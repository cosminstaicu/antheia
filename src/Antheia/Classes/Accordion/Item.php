<?php
namespace Antheia\Antheia\Classes\Accordion;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Interfaces\HtmlCode;
/**
 * The class defines an accordion item. The item can be clicked, to be expanded
 * and show some content
 * WARNING! The class should not be directly instanced. A new instance can
 * be generated by callind the method getNewItem() from the container instance
 * @author Cosmin Staicu
 *
 */
class Item extends AbstractClass implements HtmlCode {
	private $title;
	private $list;
	/**
	 * The class should not be directly constructed. A new instance can
	 * be generated by calling the method getNewItem() from the container instance
	 * @param Accordion $container the container that the item
	 * will be attached to
	 * @throws Exception
	 */
	public function __construct(Accordion $container = null) {
		parent::__construct();
		if ($container === null) {
			throw new Exception('Missing container');
		}
		$this->title = 'Undefined';
		$this->list = [];
		$this->container = $container;
	}
	/**
	 * Defines the title of the item. The title can contain html code, as it
	 * will be inserted as it is (function htmlspecialchars() is not called)
	 * @param string $title the title of the item
	 */
	public function setTitle($title):void {
		$this->title = $title;
	}
	/**
	 * Add some element that will be inserted into the list that will be visible
	 * when the item is expandes
	 * @param HtmlCode $item the element that will be added to the item
	 */
	public function addElement(HtmlCode $item):void {
		$this->list[] = $item;
	}
	public function getHtml():string {
		$open = new IconVector();
		$open->setIcon(IconVector::ICON_DOWN);
		$close = new IconVector();
		$close->setIcon(IconVector::ICON_UP);
		// start head
		$code = '<a href="javascript:void(0)" onClick="ant_accordion_click(this)">';
		$code .= '<span>'.$open->getHtml().'</span>';
		$code .= '<span>'.$close->getHtml().'</span>';
		$code .= $this->title.'</a>';
		$code .= '<div>';
		/** @var HtmlCode $element */
		foreach ($this->list as $item) {
			$code .= $item->getHtml();
		}
		$code .= '</div>';
		return $code;
	}
}
?>