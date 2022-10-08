<?php
namespace Cosmin\Antheia\Classes\Panel;
use Cosmin\Antheia\Classes\Wireframe\Wireframe;
use Cosmin\Antheia\Classes\Panel\Permission\PermissionEditGroup;
/**
 * A panel with permission, displayed in groups, as inputs.
 * Can be used for setting the permission for a user, inside the app.
 * The permissions are grouped (for example, for the users group the app can 
 * have permissions like add, remove, edit etc., for the clients group you can
 * also have add, edit, remove etc.)
 * @author Cosmin Staicu
 */
class PanelPermissionEdit extends Panel {
	private $row;
	public function __construct() {
		parent::__construct();
		$wireframe = new Wireframe();
		$this->row = $wireframe->addRow();
		$this->addElement($wireframe);
	}
	/**
	 * Adds a new panel for setting up a group of permissions and returns it.
	 * (fo example, client management group where you can have: add, edit, view etc.)
	 * @param boolean $fullWidth (optional) (default false) if true then the
	 * panel will have the full width of the parent panel and not just 50%
	 * as it is the default
	 * @return PermissionEditGroup the added panel
	 */
	public function getGroup($fullWidth = false):PermissionEditGroup {
		$cell = $this->row->addCell();
		if ($fullWidth) {
			$cell->addWidth('xs', 12);
		} else {
			$cell->addWidth('md', 6);
		}
		$panel = new PermissionEditGroup();
		$cell->addElement($panel);
		return $panel;
	}
}
?>