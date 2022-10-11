<?php
namespace Antheia\Antheia\Classes;
/**
 * The general exception for the entire library
 * @author Cosmin Staicu
 */
class Exception extends \Exception {
	public function __construct($message) {
		parent::__construct($message);
	}
}
?>