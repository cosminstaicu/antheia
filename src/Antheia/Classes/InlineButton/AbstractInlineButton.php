<?php
namespace Antheia\Antheia\Classes\InlineButton;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
use Antheia\Antheia\Classes\Icon\IconPixelSmall;
use Antheia\Antheia\Classes\Exception;
/**
 * Class to be extended by all classes defining an inline button.
 * @author Cosmin Staicu
 */
abstract class AbstractInlineButton extends AbstractClass implements HtmlCode, HtmlId {
	const HIGH = 'high';
	const MEDIUM = 'medium';
	const LOW = 'low';
	private $text;
	private $htmlId;
	private $classes;
	private $onClick;
	private $icon;
	private $title;
	private $intensity;
	public function __construct() {
		parent::__construct();
		$this->text = '';
		$this->htmlId = '';
		$this->classes = ['ant_inlineButton'];
		$this->onClick = 'void(0)';
		$this->icon = NULL;
		$this->title = NULL;
		$this->intensity = self::MEDIUM;
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
	/**
	 * Defines a title for the button
	 * @param string|NULL $title the title for the button or null if no title
	 * is required
	 */
	public function setTitle(?string $title):void {
		$this->title = $title;
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
	/**
	 * Defines the intensity for the button (how much constrast will be between
	 * the button and the regular text
	 * @param string $intensity the intensity for the button, as one of the
	 * constants: AbstractInlineButton::LOW, AbstractInlineButton::MEDIUM,
	 * AbstractInlineButton::HIGH
	 * @throws Exception if the value is not valid
	 */
	public function setIntensity(string $intensity):void {
		if (!in_array($intensity, [self::LOW, self::MEDIUM, self::HIGH])) {
			throw new Exception('Intensity is not valid '.$intensity);
		}
		$this->intensity = $intensity;
	}
	public function getHtml():string {
		$this->addClass('ant-'.$this->intensity);
		$code = '<button class="';
		$code .= implode(' ', array_unique($this->classes));
		$code .='"';
		if ($this->htmlId != '') {
			$code .= ' id="'.$this->htmlId.'"';
		}
		if ($this->title !== NULL) {
			$code .= ' title="'.$this->title.'"';
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