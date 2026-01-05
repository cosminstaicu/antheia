<?php
namespace Antheia\Antheia\Classes\Page\Login;
use Antheia\Antheia\Classes\Exception;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Input\NewInput;
use Antheia\Antheia\Classes\Wireframe\Cell;
/**
 * A page that shows an "authentication failed" message,
 * along with a retry button
 * @author Cosmin Staicu
 */
class PageLoginFailed extends AbstractPageLogin {
	private $url;
	public function __construct() {
		parent::__construct();
		$this->url = '';
	}
	/**
	 * Defines the url for the retry button
	 * @param string $url the url for the retry button
	 */
	public function setUrl(string $url):void {
		$this->url = $url;
	}
	public function getHtml():string {
		if ($this->url == '') {
			throw new Exception('Retry URL is not defined');
		}
		$this->addJavascript(
			'
			function retry() {
				document.getElementById("loadingButton").remove();
				document.getElementById("info-text").innerHTML += "<br><br>'.Texts::get('LOADING').'...";
				setTimeout(() => {document.location.href="'.$this->url.'";}, 1000);
			}'
		);
		$content = $this->getContent();
		$content->setAlign(Cell::ALIGN_CENTER);
		$cod = new Html();
		$cod->addRawCode(
			'<p style="font-weight:bold; margin-top: 30px; margin-bottom: 30px;" id="info-text">
			'.Texts::get('LOGIN_FAILED').'</p>');
		$content->addElement($cod);
		$buton = NewInput::button();
		$buton->setHtmlId('loadingButton');
		$buton->setValue(Texts::get('RETRY'));
		$buton->setOnClick('retry()');
		$content->addElement($buton);
		return parent::getHtml();
	}
}
?>
