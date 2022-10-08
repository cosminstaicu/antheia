<?php
namespace Cosmin\Antheia\Classes\Page;
/**
 * A blank page with just the head tag defined. No content is defined inside the
 * body tag. If you need a page with menus then use the jsc_page_empty class
 * @author Cosmin Staicu
 */
class PageBlank extends AbstractPage {
	public function __construct() {
		parent::__construct();
	}
}
?>