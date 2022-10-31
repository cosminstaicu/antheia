<?php
namespace Antheia\Antheia\Classes\Panel\FileBrowser;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconPixelBig;
use Antheia\Antheia\Classes\Panel\PanelFileBrowser;
use Antheia\Antheia\Interfaces\BeforeAfterCallback;
use Antheia\Antheia\Interfaces\HtmlAttribute;
use Antheia\Antheia\Interfaces\HtmlCode;
/**
 * An item from the file browser list (a file or a folder)
 * @author Cosmin Staicu
 */
abstract class AbstractItem
extends AbstractClass implements HtmlCode, BeforeAfterCallback, HtmlAttribute {
	private $panel;
	private $name;
	private $attributes;
	private $icon;
	private $iconAltText;
	private $classes;
	private $pre;
	private $post;
	private $hiddenItems;
	public function __construct(?PanelFileBrowser $panel) {
		parent::__construct();
		if ($panel === null) {
			throw new Exception('Panel not defined');
		}
		$this->panel = $panel;
		$this->name = '';
		$this->icon = null;
		$this->attributes = [];
		$this->classes = [];
		$this->pre = '';
		$this->post = '';
		$this->hiddenItems = [];
	}
	/**
	 * Defines the name of the item
	 * @param string $name the name of the item
	 */
	public function setName(string $name):void {
		$this->name = $name;
	}
	/**
	 * Defines the icon to be shown near the name of the item. If the method
	 * is not called then a default icon will be used
	 * @param IconPixelBig $icon the icon to be shown to the left of the name
	 */
	public function setIcon(IconPixelBig $icon):void {
		$this->icon = $icon;
	}
	/**
	 * Defines the alternative text for the icon
	 * @param string $altText the alternate text for the icon
	 */
	protected function setIconAltText(string $altText):void {
		$this->iconAltText = $altText;
	}
	public function addAttribute(string $name, string $value):void {
		$this->attributes[] = [$name, $value];
	}
	public function addTextAttribute(string $name, string $value):void {
		$this->addAttribute('data-text-'.$name, Texts::get($value));
	}
	/**
	 * Adds a class to the container html tag
	 * @param string $class the name of the class to be added to the html tab
	 */
	public function addClass(string $class):void {
		$this->classes[] = $class;
	}
	public function setBeforeCallback(string $functionName):void {
		$this->pre = $functionName;
	}
	public function setAfterCallback(string $functionName):void {
		$this->post = $functionName;
	}
	/**
	 * Adds a hidden item that will be visible only when the item is selected
	 * @param HtmlCode $item the item that will be visible only when the
	 * item is selected
	 */
	public function addHiddenItem(HtmlCode $item):void {
		$this->hiddenItems[] = $item;
	}
	public function getHtml():string {
		if ($this->icon === null) {
			$this->setIcon(new IconPixelBig('document_empty'));
		}
		$code = '<div class="';
		$code .= implode(' ', array_unique($this->classes));
		$code .='"';
		if ($this->pre !== '') {
			$code .= ' data-pre="'.$this->pre.'"';
		}
		if ($this->post !== '') {
			$code .= ' data-post="'.$this->post.'"';
		}
		foreach ($this->attributes as $attribute) {
			$code .= ' '.$attribute[0].'="'.$attribute[1].'"';
		}
		$code .='>';
		$code .= '<a href="javascript:void(0)" ';
		$code .= ' onclick="ant_panel_fileBrowserItemClick(this)">';
		$code .= $this->icon->getHtml($this->iconAltText);
		$code .= ' '.$this->name;
		$code .= '</a>';
		if (count($this->hiddenItems) > 0) {
			$code .= '<div>';
			/** @var HtmlCode $item */
			foreach ($this->hiddenItems as $item) {
				$code .= $item->getHtml();
			}
			$code .= '</div>';
		}
		$code .= '</div>';
		return $code;
	}
}
?>