<?php
namespace Antheia\Antheia\Classes\FixedButton;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Internals;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\LinkButtonRender;
use Antheia\Antheia\Interfaces\HtmlId;
/**
 * Defines a fixed button to be displayed on the bottom-right side of the page
 * @author Cosmin Staicu
 */
abstract class AbstractFixedButton extends AbstractClass
implements HtmlId, HtmlCode, LinkButtonRender {
	private $href;
	private $onClick;
	private $icon;
	private $title;
	private $htmlId;
	private $testId;
	private $classes;
	private $renderType;
	public function __construct() {
		parent::__construct();
		$this->href = 'javascript:void(0)';
		$this->htmlId = '';
		$this->testId = '';
		$this->onClick = '';
		$this->icon = new IconVector();
		$this->icon->setSize(48);
		$this->title = '';
		$this->classes = [];
		$this->renderType = self::BUTTON;
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	public function setTestId(string $id):void {
		$this->testId = $id;
	}
	public function setOnClick(string $code):void {
		$this->onClick = $code;
	}
	public function setRender(string $type):void {
		$this->renderType = $type;
	}
	/**
	 * The icon to be displayed on the button
	 * @param string $name the name of the simbol
	 */
	public function setIcon(string $name):void {
		$this->icon->setIcon($name);
	}
	/**
	 * The title of the button
	 * @param string $title the title of the button (displayed on hover)
	 */
	public function setTitle(string $title):void {
		$this->title = $title;
	}
	/**
	 * Adds a class to the button html definition
	 * @param string $class the name of the class added to the html definition
	 */
	public function addClass(string $class):void  {
		$this->classes[] = $class;
	}
	public function setHref(string $href = 'javascript:void(0)'):void  {
		$this->href = $href;
	}
	public function getHtml():string {
		$code = '';
		switch ($this->renderType) {
			case self::LINK:
				$code .= '<a href="'.$this->href.'" ';
				break;
			case self::BUTTON:
				$code .= '<button type="button" ';
				break;
			default:
				throw new Exception('Invalid type '.$this->renderType);
		}
		$code .= Internals::getHtmlIdCode($this->htmlId, $this->testId);
		$code .= 'class="'.implode(',', $this->classes).'"';
		if ($this->title != '') {
			$code .= ' title="'.$this->title.'"';
		}
		if ($this->onClick != '') {
			$code .= ' onClick="'.$this->onClick.'"';
		}
		$code .= '>';
		$code .= $this->icon->getHtml();
		switch ($this->renderType) {
			case self::LINK:
				$code .= '</a>';
				break;
			case self::BUTTON:
				$code .= '</button>';
				break;
			default:
				throw new Exception('Invalid type '.$this->renderType);
		}
		return $code;
	}
}
?>