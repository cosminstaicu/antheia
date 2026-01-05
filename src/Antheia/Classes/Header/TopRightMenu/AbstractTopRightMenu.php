<?php
namespace Antheia\Antheia\Classes\Header\TopRightMenu;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Internals;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Icon\IconVector;
use Antheia\Antheia\Interfaces\HtmlCode;
use Antheia\Antheia\Interfaces\HtmlId;
use Antheia\Antheia\Interfaces\LinkButtonRender;
/**
 * Abstract class that is extended by all menu items that can be inserted into
 * the top right menu
 * @author Cosmin Staicu
 */
abstract class AbstractTopRightMenu extends AbstractClass
implements HtmlCode, LinkButtonRender, HtmlId {
	private $href;
	private $onClick;
	private $name;
	private $icon;
	private $startLoadingAnimationOnClick;
	private $targetBlank;
	private $renderType;
	private $htmlId;
	private $testId;
	public function __construct() {
		parent::__construct();
		$this->href = '';
		$this->onClick = '';
		$this->name = '';
		$this->htmlId = '';
		$this->testId = '';
		$this->icon = new IconVector();
		$this->icon->setSize(20);
		$this->startLoadingAnimationOnClick = false;
		$this->targetBlank = false;
		$this->renderType = self::LINK;
		$this->setName(Texts::get('UNDEFINED'));
	}
	public function setOnClick(string $code):void {
		$this->onClick = $code;
	}
	public function setRender(string $type):void {
		$this->renderType = $type;
	}
	/**
	 * Defines if the action is executed in a new browser window or not
	 * (if a a target=_blank attribute will be inserted into the html tag).
	 * Only used if the render type is set to LINK
	 * @param boolean $status (optional) (default true) if true then a new
	 * browser window will be opened on click
	 */
	public function setTargetBlank(bool $status = true):void {
		$this->targetBlank = $status;
	}
	/**
	 * The name of the menu (the text that will be displayed on the menu)
	 * @param string $name the name of the menu
	 */
	public function setName(string $name):void {
		$this->name = $name;
	}
	public function setHref(string $href):void {
		$this->href = $href;
	}
	/**
	 * Defines the symbol used for the menu
	 * @param string $icon the  icon used for the menu
	 * @see IconVector::setIcon()
	 */
	public function setIcon(string $icon):void {
		$this->icon->setIcon($icon);
	}
	/**
	 * Calling the method will set up the menu to trigger a loading animation
	 * when the menu is clicked
	 */
	public function startLoadingOnClick():void {
		$this->startLoadingAnimationOnClick = true;
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	public function setTestId(string $id):void {
		$this->testId = $id;
	}
	public function getHtml():string {
		$code = '';
		switch ($this->renderType) {
			case self::LINK:
				if ($this->href === '') {
					$this->href = 'javascript:void(0)';
				}
				$code .= '<a href="'.$this->href.'" ';
				if ($this->targetBlank) {
					$code .= ' target="_blank" ';
				}
				break;
			case self::BUTTON:
				$code .= '<button type="button" ';
				break;
			default:
				throw new Exception('Invalid type '.$this->renderType);
		}
		$code .= Internals::getHtmlIdCode($this->htmlId, $this->testId);
		$onClick = '';
		if ($this->startLoadingAnimationOnClick) {
			$onClick .= 'ant_loading_start();';
		}
		if ($this->onClick !== '') {
			$onClick .= $this->onClick;
		}
		if ($onClick !== '') {
			$code .= ' onClick="'.$onClick.'"';
		}
		$code .= '>';
		$code .= $this->icon->getHtml();
		$code .= '<span>'.$this->name.'</span>';
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
