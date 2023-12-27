<?php
namespace Antheia\Antheia\Classes\Menu\Item;
/**
 * A shortcut class for generating any menu item without adding the namespace
 * to the document use section (as a page uses many types of menus, the
 * namespace declaration section can become crowded)
 * @author Cosmin Staicu
 */
abstract class NewMenu {
	private function __constructor() {}
	/**
	 * Creates an add menu and returns it
	 * @see \Antheia\Antheia\Classes\Menu\Item\MenuAdd
	 * @return MenuAdd the new input that has been created
	 */
	public static function add():MenuAdd {
		return new MenuAdd();
	}
	/**
	 * Creates a close menu and returns it
	 * @see \Antheia\Antheia\Classes\Menu\Item\MenuClose
	 * @return MenuClose the new input that has been created
	 */
	public static function close():MenuClose {
		return new MenuClose();
	}
	/**
	 * Creates a delete confirmation menu and returns it
	 * @see \Antheia\Antheia\Classes\Menu\Item\MenuConfirmDelete
	 * @return MenuConfirmDelete the new input that has been created
	 */
	public static function confirmDelete():MenuConfirmDelete {
		return new MenuConfirmDelete();
	}
	/**
	 * Creates a copy menu and returns it
	 * @see \Antheia\Antheia\Classes\Menu\Item\MenuCopy
	 * @return MenuCopy the new input that has been created
	 */
	public static function copy():MenuCopy {
		return new MenuCopy();
	}
	/**
	 * Creates a custom menu and returns it
	 * @see \Antheia\Antheia\Classes\Menu\Item\MenuCustom
	 * @return MenuCustom the new input that has been created
	 */
	public static function custom():MenuCustom {
		return new MenuCustom();
	}
	/**
	 * Creates a delete menu and returns it
	 * @see \Antheia\Antheia\Classes\Menu\Item\MenuDelete
	 * @return MenuDelete the new input that has been created
	 */
	public static function delete():MenuDelete {
		return new MenuDelete();
	}
	/**
	 * Creates a download menu and returns it
	 * @see \Antheia\Antheia\Classes\Menu\Item\MenuDownload
	 * @return MenuDownload the new input that has been created
	 */
	public static function download():MenuDownload {
		return new MenuDownload();
	}
	/**
	 * Creates an edit menu and returns it
	 * @see \Antheia\Antheia\Classes\Menu\Item\MenuEdit
	 * @return MenuEdit the new input that has been created
	 */
	public static function edit():MenuEdit {
		return new MenuEdit();
	}
	/**
	 * Creates an info menu and returns it
	 * @see \Antheia\Antheia\Classes\Menu\Item\MenuInfo
	 * @return MenuInfo the new input that has been created
	 */
	public static function info():MenuInfo {
		return new MenuInfo();
	}
	/**
	 * Creates a playback menu and returns it
	 * @see \Antheia\Antheia\Classes\Menu\Item\MenuPlay
	 * @return MenuShopping the new input that has been created
	 */
	public static function play():MenuPlay {
		return new MenuPlay();
	}
	/**
	 * Creates a shopping menu and returns it
	 * @see \Antheia\Antheia\Classes\Menu\Item\MenuShopping
	 * @return MenuShopping the new input that has been created
	 */
	public static function shopping():MenuShopping {
		return new MenuShopping();
	}
	/**
	 * Creates a startStop menu and returns it
	 * @see \Antheia\Antheia\Classes\Menu\Item\MenuStartStop
	 * @return MenuStartStop the new input that has been created
	 */
	public static function startStop():MenuStartStop {
		return new MenuStartStop();
	}
	/**
	 * Creates an update menu and returns it
	 * @see \Antheia\Antheia\Classes\Menu\Item\MenuUpdate
	 * @return MenuUpdate the new input that has been created
	 */
	public static function update():MenuUpdate {
		return new MenuUpdate();
	}
	/**
	 * Creates an upload menu and returns it
	 * @see \Antheia\Antheia\Classes\Menu\Item\MenuUpload
	 * @return MenuUpload the new input that has been created
	 */
	public static function upload():MenuUpload {
		return new MenuUpload();
	}
	/**
	 * Creates a valid menu and returns it
	 * @see \Antheia\Antheia\Classes\Menu\Item\MenuValid
	 * @return MenuValid the new input that has been created
	 */
	public static function valid():MenuValid {
		return new MenuValid();
	}
	/**
	 * Creates a view menu and returns it
	 * @see \Antheia\Antheia\Classes\Menu\Item\MenuView
	 * @return MenuView the new input that has been created
	 */
	public static function view():MenuView {
		return new MenuView();
	}
}
?>