<?php
namespace Antheia\Antheia\Classes\InlineButton;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
use Antheia\Antheia\Classes\Icon\IconPixelSmall;
/**
 * Class to be extended by all classes defining an inline button.
 * @author Cosmin Staicu
 */
abstract class AbstractInlineButton extends AbstractClass implements HtmlCode, HtmlId {
	private $text;
	private $htmlId;
	private $classes;
	private $onClick;
	private $icon;
	public function __construct() {
		parent::__construct();
		$this->text = '';
		$this->htmlId = '';
		$this->classes = ['ant_inlineButton'];
		$this->onClick = 'void(0)';
		$this->icon = NULL;
	}
	/**
	 * Adds a class to the button
	 * @param string $class the name of the class to be added to the button
	 */
	public function addClass(string $class):void {
		$this->classes[] = $class;
	}
	/**
	 * Defines the text shown when the item is clicked
	 * @param string $text the text shown when the item is clicked. The text
	 * will be escaped by default (using htmlspecialchars)
	 */
	public function setText(string $text):void {
		$this->text = $text;
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	/**
	 * Defines the javascript code that will be triggered when the user clicks
	 * on the input. The script adds ";" to the end of the line, if no
	 * such symbol already exists.
	 * @param string $javascript the onClick script that will be triggered when
	 * the user clicks on the element
	 */
	public function setOnClick(string $javascript):void {
		$this->onClick = $javascript;
		if (substr($this->onClick, -1) != ';') {
			$this->onClick.= ';';
		}
	}
	/**
	 * Defines the icon for the button.
	 * @param string $icon the icon for the button (the name of the png icon
	 * located in the 16x16 folder) or null if no item is required
	 */
	public function setIcon(?string $icon):void {
		$this->icon = $icon;
	}
	public function getHtml():string {
		$code = '<button class="';
		$code .= implode(' ', array_unique($this->classes));
		$code .='"';
		if ($this->htmlId != '') {
			$code .= ' id="'.$this->htmlId.'"';
		}
		$code .= ' onClick="'.$this->onClick.'">';
		if ($this->icon !== NULL) {
			$icon = new IconPixelSmall($this->icon);
			$code .= '<img src="'.$icon->getUrl()
				.'" width="16" height="16" alt="'.addslashes($this->text).'">';
		}
		$code .= htmlspecialchars($this->text).'</button>';
		return $code;
	}
}
?>