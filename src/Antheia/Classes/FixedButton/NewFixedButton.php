<?php
namespace Antheia\Antheia\Classes\FixedButton;
/**
 * A shortcut class for generating any fixed button without adding the namespace
 * to the document use section (as a page can have more fixed buttons, the
 * namespace declaration section can become crowded)
 * @author Cosmin Staicu
 */
abstract class NewFixedButton {
	private function __constructor() {}
	/**
	 * Creates an add button and returns it
	 * @return FixedButtonAdd the new button that has been created
	 * @see \Antheia\Antheia\Classes\FixedButton\FixedButtonAdd
	 */
	public static function add():FixedButtonAdd {
		return new FixedButtonAdd();
	}
	/**
	 * Creates an add info button and returns it
	 * @return FixedButtonAddInfo the new button that has been created
	 * @see \Antheia\Antheia\Classes\FixedButton\FixedButtonAddInfo
	 */
	public static function addInfo():FixedButtonAddInfo {
		return new FixedButtonAddInfo();
	}
	/**
	 * Creates a back button and returns it
	 * @return FixedButtonBack the new button that has been created
	 * @see \Antheia\Antheia\Classes\FixedButton\FixedButtonBack
	 */
	public static function back():FixedButtonBack {
		return new FixedButtonBack();
	}
	/**
	 * Creates a bug button and returns it
	 * @return FixedButtonBug the new button that has been created
	 * @see \Antheia\Antheia\Classes\FixedButton\FixedButtonBug
	 */
	public static function bug():FixedButtonBug {
		return new FixedButtonBug();
	}
	/**
	 * Creates a cancel button and returns it
	 * @return FixedButtonCancel the new button that has been created
	 * @see \Antheia\Antheia\Classes\FixedButton\FixedButtonCancel
	 */
	public static function cancel():FixedButtonCancel {
		return new FixedButtonCancel();
	}
	/**
	 * Creates a download button and returns it
	 * @return FixedButtonDownload the new button that has been created
	 * @see \Antheia\Antheia\Classes\FixedButton\FixedButtonDownload
	 */
	public static function download():FixedButtonDownload {
		return new FixedButtonDownload();
	}
	/**
	 * Creates a forward button and returns it
	 * @return FixedButtonForward the new button that has been created
	 * @see \Antheia\Antheia\Classes\FixedButton\FixedButtonForward
	 */
	public static function forward():FixedButtonForward {
		return new FixedButtonForward();
	}
	/**
	 * Creates a shopping button and returns it
	 * @return FixedButtonShopping the new button that has been created
	 * @see \Antheia\Antheia\Classes\FixedButton\FixedButtonShopping
	 */
	public static function shopping():FixedButtonShopping {
		return new FixedButtonShopping();
	}
	/**
	 * Creates a shopping add button and returns it
	 * @return FixedButtonShoppingAdd the new button that has been created
	 * @see \Antheia\Antheia\Classes\FixedButton\FixedButtonShoppingAdd
	 */
	public static function shoppingAdd():FixedButtonShoppingAdd {
		return new FixedButtonShoppingAdd();
	}
	/**
	 * Creates an update button and returns it
	 * @return FixedButtonUpdate the new button that has been created
	 * @see \Antheia\Antheia\Classes\FixedButton\FixedButtonUpdate
	 */
	public static function update():FixedButtonUpdate {
		return new FixedButtonUpdate();
	}
	/**
	 * Creates an upload button and returns it
	 * @return FixedButtonUpload the new button that has been created
	 * @see \Antheia\Antheia\Classes\FixedButton\FixedButtonUpload
	 */
	public static function upload():FixedButtonUpload {
		return new FixedButtonUpload();
	}
	/**
	 * Creates a valid button and returns it
	 * @return FixedButtonValid the new button that has been created
	 * @see \Antheia\Antheia\Classes\FixedButton\FixedButtonValid
	 */
	public static function valid():FixedButtonValid {
		return new FixedButtonValid();
	}
}
