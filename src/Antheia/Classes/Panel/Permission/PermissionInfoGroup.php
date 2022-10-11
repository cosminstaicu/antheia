<?php
namespace Antheia\Antheia\Classes\Panel\Permission;
/**
 * A group of permission for the app. For example, you can have a clients group
 * that can contain all the permissions for clients: add, edit, view etc.
 * WARNING! This class is not instantiated directly. You can get an instance
 * bu calling PanelPermissionInfo::getGroup() on the parent
 * @author Cosmin Staicu
 */
class PermissionInfoGroup {
	private $title;
	private $list;
	public function __construct() {
		$this->title = 'undefined';
		$this->list = [];
	}
	/**
	 * The name for the permission group (ex. users, clients etc)
	 * @param string $title the name of the permission group
	 */
	public function setTitle(string $title):void {
		$this->title = $title;
	}
	/**
	 * Returns name for the permission group (ex. users, clients etc)
	 * @return string the name of the permission group
	 */
	public function getTitle():string {
		return $this->title;
	}
	/**
	 * Returns a list with all permissions defined for this category
	 * @return string[] a list with all permissions defined for this category
	 * like permissionName => permissionValue
	 */
	public function getList():array {
		return $this->list;
	}
	/**
	 * Adds a permission to the list
	 * @param string $name the name of the permission (ex. edit, delete)
	 * @param string $value the value of the permission (ex. allowed, not allowed)
	 */
	public function addElement(string $name, string $value) {
		$this->list[$name] = $value;
	}
}
?>