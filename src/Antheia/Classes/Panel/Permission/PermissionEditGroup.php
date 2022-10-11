<?php
namespace Antheia\Antheia\Classes\Panel\Permission;
use Antheia\Antheia\Classes\Panel\Panel;
use Antheia\Antheia\Classes\Wireframe\WireframeInput;
use Antheia\Antheia\Classes\Panel\AbstractPanel;
use Antheia\Antheia\Classes\Input\InputSelect;
/**
 * A group of permissions for the app, as inputs. For example, you can have a 
 * clients group that can contain all the permissions for clients: add, edit, 
 * view, delete etc.
 * WARNING! This class is not instantiated directly. You can get an instance
 * bu calling PanelPermissionEdit::getGroup() on the parent
 * @author Cosmin Staicu
 */
class PermissionEditGroup extends Panel {
	private $wireframe;
	public function __construct() {
		parent::__construct();
		$this->wireframe = new WireframeInput();
		$this->addElement($this->wireframe);
	}
	/**
	 * @see AbstractPanel::setTitle()
	 */
	public function setTitle(string $title, bool $smallFont = true):void {
		parent::setTitle($title, $smallFont);
	}
	/**
	 * Returns a new select input, used for defining the permission
	 * @param string $label the label for the permission
	 * (ex. view, edit etc.)
	 * @param string $nameId html tag name and id for the input element
	 * @param string $rowId (optional) a html id for the row containing the
	 * input or an empty string if no id is required
	 * @param string[] $rowClasses a list of classes to be added to the row
	 * definition
	 * @return InputSelect the select input for the permission
	 */
	public function getElement(
			string $label,
			string $nameId,
			string $rowId = '',
			array $rowClasses = []):InputSelect {
		$input = new InputSelect();
		$input->setLabel($label);
		$input->setNameId($nameId);
		$this->wireframe->addInput($input, $rowId, $rowClasses);
		return $input;	
	}
}
?>