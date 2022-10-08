<?php
namespace Cosmin\Antheia\Classes\Panel;
use Cosmin\Antheia\Classes\Html;
use Cosmin\Antheia\Classes\Panel\Permission\PermissionInfoGroup;
use Cosmin\Antheia\Classes\Table\Table;
/**
 * A panel with permission, displayed in groups.
 * Can be used for viewing the permission for a user, inside the app.
 * The permissions are grouped (for example, for the users group, the app can 
 * have permissions like add, remove, edit etc., for the clients group you can
 * also have add, edit, remove etc.)
 * @author Cosmin Staicu
 */
class PanelPermissionInfo extends Panel {
	private $list;
	public function __construct() {
		parent::__construct();
		$this->list = [];
	}
	/**
	 * Returns a panel that contains a permission group
	 * @return PermissionInfoGroup a panel that contains
	 * a permission group
	 */
	public function getGroup():PermissionInfoGroup {
		$panel = new PermissionInfoGroup();
		$this->list[] = $panel;
		return $panel;
	}
	public function getHtml():string {
		/** @var PermissionInfoGroup $panel */
		foreach ($this->list as $panel) {
			$list = $panel->getList();
			$table = new Table();
			$table->addClass('jsf_permissions');
			$table->setAlternateRows();
			$cell = $table->addRow()->addCell();
			$cell->setColspan(3);
			$cell->addText('<p>'.$panel->getTitle().'</p>');
			$row = $table->addRow();
			$cell = $row->addCell();
			$cell->addText('<p>'.$panel->getTitle().'</p>');
			$cell->setRowspan(count($list) + 1);
			foreach ($list as $name => $value) {
				$row = $table->addRow();
				$cell = $row->addCell();
				$cell->addElement(new Html($name));
				$cell = $row->addCell();
				$cell->addElement(new Html($value));
			}
			$this->addElement($table);
		}
		return parent::getHtml();
	}
}
?>