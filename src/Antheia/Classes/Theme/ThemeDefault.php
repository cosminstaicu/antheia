<?php
namespace Antheia\Antheia\Classes\Theme;
/**
 * Default library theme
 * @author Cosmin Staicu
 */
class ThemeDefault extends AbstractTheme {
	public function __construct() {
		parent::__construct();
		$this->setName('Just Blue');
		$this->setDescription(
			'The Sea meets the Sky and they are locked in a dream, with a touch of waves.'
		);
	}
}
?>
