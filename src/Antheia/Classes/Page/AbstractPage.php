<?php
namespace Antheia\Antheia\Classes\Page;
use Antheia\Antheia\Classes\AbstractClass;
use Antheia\Antheia\Classes\Globals;
use Antheia\Antheia\Classes\Html;
use Antheia\Antheia\Classes\Internals;
use Antheia\Antheia\Classes\Texts;
use Antheia\Antheia\Classes\Theme\AbstractTheme;
use Antheia\Antheia\Classes\Theme\ThemeDefault;
use Antheia\Antheia\Interfaces\HtmlCode;
/**
 * Abstract class to be extended by all pages
 * @author Cosmin Staicu
 */
abstract class AbstractPage extends AbstractClass {
	private $pageTitle;
	private $javascriptFiles;
	private $cssFiles;
	private $bodyTopJavascript;
	private $codeElements;
	private $bodyBottomJavascript;
	private $headCss;
	private $headJavascript;
	private $headRows;
	private $htmlClasses;
	private $bodyClasses;
	private $onLoad;
	private $theme;
	private $onlyLocalFiles;
	public function __construct() {
		parent::__construct();
		$this->javascriptFiles = [];
		$this->cssFiles = [];
		$this->pageTitle = Globals::getAppName();
		$this->bodyTopJavascript = [];
		$this->codeElements = [];
		$this->bodyBottomJavascript = [];
		$this->headCss = '';
		$this->headJavascript = '';
		$this->onLoad = '';
		$this->headRows = [];
		$this->theme = new ThemeDefault();
		$this->htmlClasses = [];
		$this->bodyClasses = [];
		$this->onlyLocalFiles = false;
	}
	/**
	 * Defines the location for loading external libraries
	 * (like Material Icons). Can be used if the project using this library runs
	 * without internet connection
	 * @param bool $onlyLocal (optional) (default true) if true then
	 * the external libraries used by antheia will be loaded from the local files,
	 * otherwise the external libraries location will be used.
	 */
	public function onlyLocalFiles(bool $onlyLocal = true):void {
		$this->onlyLocalFiles = $onlyLocal;
	}
	/**
	 * Checks if the browser supports the javascript features used by the 
	 * framework. The test will be performed after the page loads. If the browser
	 * does not support all framework features then the script will be redirected
	 * to a page with details.
	 * @param string $url (optional) the url where the page should redirect when
	 * the browser is not compatible. If not defined (or null) the browser will
	 * be redirected to a standard library page
	 */
	public function checkCompatibility(string $url = null):void {
		if ($url === null) {
			// checking if the invalid browser files are available
			// inside the cache folder
			foreach ([
				'invalidBrowser.css',
				'invalidBrowser.html',
				'background.jpg',
				'chrome.svg',
				'firefox.svg'
			] as $fileName) {
				$cacheFile = Internals::getCachePath($fileName);
				if (!is_file($cacheFile)) {
					copy(Internals::getFolder(['Media']).$fileName, $cacheFile);
				}
			}
			$url = Internals::getCacheUrl().'invalidBrowser.html';
		}
		$this->addOnLoad('ant_checkCompatibility()');
		$this->addElement(new Html(
			'<script id="ant_compatibilityScript">
				function ant_checkCompatibility() {
					try {
						ant_utils_checkCompatibility();
					} catch (error) {
						document.location.href="'.$url.'";
					}
				}
			</script>'
		));
	}
	/**
	 * Defines the framework theme to be used for the page
	 * @param AbstractTheme $theme used framwework theme
	 */
	public function setTheme(AbstractTheme $theme):void {
		$this->theme = $theme;
	}
	/**
	 * Returns the selected theme for the framework
	 * @return AbstractTheme the selected theme
	 */
	public function getTheme():AbstractTheme {
		return $this->theme;
	}
	/**
	 * Adds a class to the html tag
	 * @param string $class the added class name
	 */
	public function addHtmlClass(string $class):void {
		$this->htmlClasses[] = $class;
	}
	/**
	 * Adds a class to the body tag
	 * @param string $class the added class name
	 */
	public function addBodyClass(string $class):void {
		$this->bodyClasses[] = $class;
	}
	/**
	 * Adds a row to the head of the page. Used for adding meta like data.
	 * Each call of the method will add a new row
	 * @param string $row the added text
	 */
	public function addHeadText(string $row):void {
		$this->headRows[] = $row;
	}
	/**
	 * Adds javascript code to be inserted into the onLoad attribute of the
	 * body tag.
	 * @param string $script the script to be inserted (if it does not ends with
	 * a semicolon then that symbol will be added)
	 */
	public function addOnLoad(string $script):void {
		$this->onLoad .= $script;
		if (substr($this->onLoad, -1) != ';') {
			$this->onLoad .= ';';
		}
	}
	/**
	 * Defines the page title
	 * @param string $title the page title
	 */
	public function setTitle(string $title):void {
		$this->pageTitle = $title;
	}
	/**
	 * Returns the page title
	 * @return string the page title
	 */
	public function getTitle():string {
		return $this->pageTitle;
	}
	/**
	 * Adds a javascript file to the page
	 * @param string $url file location (url)
	 * @param string[] $attributes (optional) a list with attributes to be
	 * added to the script tag (index = "value")
	 */
	public function addJavascriptFile($url, $attributes = []):void {
		$this->javascriptFiles[] = [
			'url' => $url,
			'attributes' => $attributes
		];
	}
	/**
	 * Adds a css file to the page
	 * @param string $url file location (url)
	 * @param string[] $attributes (optional) a list with attributes to be
	 * added to the script tag (index = "value")
	 */
	public function addCssFile($url, $attributes = []):void {
		$this->cssFiles[] = [
			'url' => $url,
			'attributes' => $attributes
		];
	}
	/**
	 * Add css code to be inserted into the head of the page
	 * @param string $css css code to be inserted into the head of the page
	 */
	public function addCss(string $css):void {
		$this->headCss .= $css;
	}
	/**
	 * Add css code to be inserted into the head of the page
	 * @param string $javascript javascript code to be inserted into the head
	 * of the page
	 */
	public function addJavascript(string $javascript):void {
		$this->headJavascript .= $javascript;
	}
	/**
	 * Adds an element to the page content
	 * @param HtmlCode $item the item to be added to the page
	 */
	public function addElement(HtmlCode $item):void {
		$this->codeElements[] = $item;
	}
	/**
	 * Adds javascript code to the top of the body of the document. The code
	 * will be placed inside a SCRIPT tag pair
	 * @param string $code the javascript code to be added to the top of the body
	 * of the page
	 * @param string $id (optional) the id of the javascript tag to be added
	 */
	public function addJavascriptBodyTop(string $code, ?string $id = NULL):void {
		$finalCode = '<script';
		if ($id !== null) {
			$finalCode .= ' id="'.$id.'"';
		}
		$finalCode .= '>'.$code.'</script>';
		$this->bodyTopJavascript[] = new Html($finalCode);
	}
	/**
	 * Alias for addJavascriptBodyBottom() method.
	 * Adds javascript code to the bottom of the body of the document. The code
	 * will be placed inside a SCRIPT tag pair
	 * @param string $code the javascript code to be added to the bottom of
	 * the body of the page
	 * @param string $id (optional) the id of the javascript tag to be added
	 * @see AbstractPage::addJavascriptBodyBottom()
	 */
	public function addJavascriptBody(string $code, ?string $id = NULL):void {
		$this->addJavascriptBodyBottom($code, $id);
	}
	/**
	 * Adds javascript code to the bottom of the body of the document. The code will be
	 * placed inside a SCRIPT tag pair
	 * @param string $code the javascript code to be added to the bottom of the body
	 * of the page
	 * @param string $id (optional) the id of the javascript tag to be added
	 */
	public function addJavascriptBodyBottom(string $code, ?string $id = NULL):void {
		$finalCode = '<script';
		if ($id !== null) {
			$finalCode .= ' id="'.$id.'"';
		}
		$finalCode .= '>'.$code.'</script>';
		$this->bodyBottomJavascript[] = new Html($finalCode);
	}
	/**
	 * Returns the HTML code for the page
	 * @return string the HTML code for the page
	 */
	public function getHtml():string {
		$jsFile = Texts::get('LANGUAGE_ID').'_scripts.js';
		// creating (if necessary) the cache files
		$icon32Path = Internals::getCachePath().'iconPixel32.php';
		if (!is_file($icon32Path)) {
			$content = '<?php
				$cachePath = dirname(__DIR__, 1).DIRECTORY_SEPARATOR;
				require_once(\''.dirname(__DIR__, 2).'/Scripts/Media/iconPixel32.php\');
			?>';
			file_put_contents($icon32Path, $content);
		}
		$jsPath = Internals::getCachePath().$jsFile;
		if (!is_file($jsPath) || Globals::getDebug()) {
			// javascript file does not exists, so it will be created
			$jsRootPath = Internals::getFolder(['Scripts','JavaScript']);
			$jsPrimaryFiles = [
				'accordion.js',
				'alert.js',
				'appMenu.js',
				'confirm.js',
				'deleteConfirmation.js',
				'forms.js',
				'inlineHelp.js',
				'inputDate.js',
				'inputFile.js',
				'inputFileDrop.js',
				'inputNewPassword.js',
				'inputSearch.js',
				'inputSelect.js',
				'inputText.js',
				'inputTime.js',
				'loading.js',
				'menu.js',
				'message.js',
				'modal.js',
				'modalMenu.js',
				'panel.js',
				'search.js',
				'slide.js',
				'tab.js',
				'theme.js',
				'utils.js',
				'search'.DIRECTORY_SEPARATOR.'accordion.js',
				'search'.DIRECTORY_SEPARATOR.'card.js',
				'search'.DIRECTORY_SEPARATOR.'table.js'
			];
			// creating the javascript file
			$file = '"use strict";'."\n";
			$file .= 'let ant_text_months = {};'."\n";
			for ($i = 1; $i <= 12; $i++) {
				$file .= 'ant_text_months["';
				if ($i < 10) {
					$file .= '0';
				}
				$file .= $i.'"] = "';
				$file .= Texts::getMonth($i);
				$file .= '";'."\n";
			}
			$file .= 'let ant_text = {};'."\n";
			$file .= 'ant_text["cancel"] = "'.Texts::get('CANCEL').'";'."\n";
			$file .= 'ant_text["invalidInputValue"] = "'.Texts::get('INVALID_INPUT_VALUE').'";'."\n";
			$file .= 'ant_text["ok"] = "'.Texts::get('OK').'";'."\n";
			$file .= 'let ant_antheiaCacheUrl = "'.Internals::getCacheUrl().'";'."\n";
			foreach ($jsPrimaryFiles as $jsPrimaryFile) {
				$file .= file_get_contents($jsRootPath.$jsPrimaryFile)."\n";
			}
			file_put_contents($jsPath, $file);
		}
		$cssFile = 'styles.css';
		$cssPath = Internals::getCachePath().$cssFile;
		if (!is_file($cssPath) || Globals::getDebug()) {
			// css file does not exists, so it will be created
			$cssRootPath = Internals::getFolder(['Scripts','Css']);	
			$cssPrimaryFiles = [
					'_layers.css',
					'_var.css',
					'accordion.css',
					'appMenu.css',
					'content.css',
					'fixedButton.css',
					'form.css',
					'header.css',
					'info.css',
					'inlineButton.css',
					'inlineHelp.css',
					'inputDate.css',
					'inputFile.css',
					'inputFileDrop.css',
					'inputNewPassword.css',
					'inputSearch.css',
					'inputSelect.css',
					'inputText.css',
					'inputTime.css',
					'loading.css',
					'login.css',
					'menu.css',
					'message.css',
					'modal.css',
					'modalMenu.css',
					'panel.css',
					'permissions.css',
					'search.css',
					'slide.css',
					'table.css',
					'tags.css',
					'theme.css',
					'topBar.css',
					'wireframe.css',
					'search'.DIRECTORY_SEPARATOR.'accordion.css',
					'search'.DIRECTORY_SEPARATOR.'card.css',
					'search'.DIRECTORY_SEPARATOR.'table.css'
					
			];
			$file = '@CHARSET "UTF-8";'."\n";
			foreach ($cssPrimaryFiles as $cssPrimaryFile) {
				$file .= file_get_contents($cssRootPath.$cssPrimaryFile)."\n";
			}
			file_put_contents($cssPath, $file);
		}
		$defaultLogo = Internals::getCachePath('logo.png');
		if (!is_file($defaultLogo)) {
			copy(Internals::getFolder(['Media']).'logo.png', $defaultLogo);
		}
		$code = '<!DOCTYPE html><html lang="'.Texts::get('LANGUAGE_ID').'"';
		if (count($this->htmlClasses) !== 0) {
			$code .= ' class="'.implode(' ', array_unique($this->htmlClasses)).'"';
		}
		$code .= '><head><meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">';
		foreach ($this->headRows as $rand) {
			$code .= $rand;
		}
		$code .= '
		<title>'.$this->getTitle().'</title>
		<link rel="stylesheet" href="'.Internals::getCacheUrl().$cssFile.'">';
		if ($this->onlyLocalFiles) {
			$folderCacheMaterialIcons = Internals::getCachePath()
				.'material-icons'.DIRECTORY_SEPARATOR;
			if (!is_dir($folderCacheMaterialIcons)) {
				mkdir($folderCacheMaterialIcons);
				$sourceDir = Internals::getFolder(['Media','material-icons']);
				$dirHandle = opendir($sourceDir);
				while (($file = readdir($dirHandle)) !== FALSE) {
					if ($file === '.') {
						continue;
					}
					if ($file === '..') {
						continue;
					}
					if (is_file($sourceDir.$file)) {
						copy($sourceDir.$file, $folderCacheMaterialIcons.$file);
					}
				}
			}
			$code .= '<link rel="stylesheet" href="'.Internals::getCacheUrl()
				.'/material-icons/material-icons.css">';
		} else {
			$code .= '<link rel="stylesheet" 
				href="https://fonts.googleapis.com/icon?family=Material+Icons">';
		}
		foreach ($this->cssFiles as $file) {
			$code .= '<link rel="stylesheet" href="'.$file['url'].'"';
			if (count($file['attributes']) > 0) {
				$code .= ' '.implode(' ', $file['attributes']);
			}
			$code .= '>';			
		}
		$code .= '<script src="'.Internals::getCacheUrl().$jsFile.'"></script>';
		foreach ($this->javascriptFiles as $file) {
			$code .= '<script src="'.$file['url'].'"';
			if (count($file['attributes']) > 0) {
				$code .= ' '.implode(' ', $file['attributes']);
			}
			$code .= '></script>';
		}
		// the colors from the theme
		$code .= '<style>';
		$code .= ':root {';
		$code .= ' --ant-theme-warning: '.$this->theme->getWarning().';';
		$code .= ' --ant-theme-valid: '.$this->theme->getValid().';';
		$code .= ' --ant-theme-link: '.$this->theme->getLink().';';
		$code .= ' --ant-theme-linkHover: '.$this->theme->getLinkHover().';';
		$code .= ' --ant-theme-text: '.$this->theme->getText().';';
		$code .= ' --ant-theme-topBottomBarText: '.$this->theme->getTopBottomBarText().';';
		$code .= ' --ant-theme-topBottomBarBackground: '.$this->theme->getTopBottomBarBackground().';';
		$code .= ' --ant-theme-menuText: '.$this->theme->getMenuText().';';
		$code .= ' --ant-theme-menuBackground: '.$this->theme->getMenuBackground().';';
		$hover = $this->theme->getMenuText('decimal');
		$code .= ' --ant-theme-menuBackgroundHover: rgba('.$hover[0].','.$hover[1].','.$hover[2].',0.5);';
		$code .= ' --ant-theme-headerText: '.$this->theme->getHeaderText().';';
		$code .= ' --ant-theme-headerBackground: '.$this->theme->getHeaderBackground().';';
		$code .= ' --ant-theme-tabText: '.$this->theme->getTabText().';';
		$code .= ' --ant-theme-tabBackground: '.$this->theme->getTabBackground().';';
		$code .= ' --ant-theme-background: '.$this->theme->getBackground().';';
		$code .= ' --ant-theme-panelBorder: '.$this->theme->getPanelBorder().';';
		$code .= ' --ant-theme-panelTitle: '.$this->theme->getPanelTitle().';';
		$code .= ' --ant-theme-panelBackground: '.$this->theme->getPanelBackground().';';
		$code .= ' --ant-theme-panelSecondaryBackground: '.$this->theme->getPanelSecondaryBackground().';';
		$code .= ' --ant-theme-inputBorder: '.$this->theme->getInputBorder().';';
		$code .= ' --ant-theme-inputIcon: '.$this->theme->getInputIcon().';';
		$code .= ' --ant-theme-inputBackground: '.$this->theme->getInputBackground().';';
		$code .= ' --ant-theme-inputText: '.$this->theme->getInputText().';';
		$code .= ' --ant-theme-inputLabel: '.$this->theme->getInputLabel().';';
		$code .= ' --ant-theme-buttonBackground: '.$this->theme->getButtonBackground().';';
		$code .= ' --ant-theme-buttonBackgroundHover: '.$this->theme->getButtonBackgroundHover().';';
		$code .= ' --ant-theme-buttonText: '.$this->theme->getButtonText().';';
		$code .= ' --ant-theme-loadingA: '.$this->theme->getLoadingA().';';
		$code .= ' --ant-theme-loadingB: '.$this->theme->getLoadingB().';';
		$code .= ' --ant-theme-loadingStepBackground: '.$this->theme->getLoadingStepBackground().';';
		$code .= ' --ant-theme-loadingStepBorder: '.$this->theme->getLoadingStepBorder().';';
		$code .= ' --ant-theme-loadingStepText: '.$this->theme->getLoadingStepText().';';
		$code .= ' --ant-theme-loadingProgressLeft: '.$this->theme->getLoadingProgressLeft().';';
		$code .= ' --ant-theme-loadingProgressRight: '.$this->theme->getLoadingProgressRight().';';
		$over = $this->theme->getMenuBackground('decimal');
		$code .= ' --ant-theme-overlay: rgba('.$over[0].','.$over[1].','.$over[2].',0.5);';
		$code .= ' --ant-theme-shadow: '.$this->theme->getShadow().';';
		$code .= '}';
		$code .= $this->headCss.'</style>';
		if ($this->headJavascript !== '') {
			if (substr($this->headJavascript, -1) !== ';') {
				$this->headJavascript .= '; ';
			}
		}
		$this->headJavascript .= 'let ant_theme_backdrop = "'
				.$this->theme->getLoadingBackdrop().'";';
		$code .= '<script>'.$this->headJavascript.'</script>';
		$code .= '</head><body';
		if (count($this->bodyClasses) !== 0) {
			$code .= ' class="'.implode(' ', array_unique($this->bodyClasses)).'"';
		}
		if ($this->onLoad != '') {
			$code .= ' onLoad="'.$this->onLoad.'"';
		}
		$code .='>';
		/** @var HtmlCode $item */
		foreach ($this->bodyTopJavascript as $item) {
			$code .= $item->getHtml();
		}
		/** @var HtmlCode $item */
		foreach ($this->codeElements as $item) {
			$code .= $item->getHtml();
		}
		if (Globals::getDebug()) {
			$code .= '<div id="ant_content-debug">Antheia debug mode enabled</div>';
		}
		/** @var HtmlCode $item */
		foreach ($this->bodyBottomJavascript as $item) {
			$code .= $item->getHtml();
		}
		$code .= '</body></html>';
		$lines = preg_split("/\r\n|\n|\r/", $code);
		$noLines = '';
		foreach ($lines as $line) {
			$trimmed = trim($line);
			if ($trimmed !== '') {
				$noLines .= $trimmed.' ';
			}
		}
		return $noLines;
	}
}
?>