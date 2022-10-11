<?php
namespace Antheia\Antheia\Classes\Theme;
/**
 * Default framework theme
 * @author Cosmin Staicu
 */
class ThemeDefault extends AbstractTheme {
	public function __construct() {
		parent::__construct();
		$this->setName('Just Blue');
	}
}
?>