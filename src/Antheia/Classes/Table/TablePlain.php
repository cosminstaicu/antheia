<?php
namespace Cosmin\Antheia\Classes\Table;
use Cosmin\Antheia\Classes\AbstractClass;
use Cosmin\Antheia\Interfaces\HtmlCode;
use Cosmin\Antheia\Interfaces\HtmlId;
use Cosmin\Antheia\Classes\Exception;
use Cosmin\Antheia\Classes\Table\Plain\Row;
/**
 * A simple table, without any formatting, classes etc.
 * @author Cosmin Staicu
 */
class TablePlain extends AbstractClass implements HtmlCode, HtmlId {
	private $rows;
	private $width;
	private $classes;
	private $inlineCss;
	private $displayTitle;
	private $horizontalScroll;
	private $htmlId;
	public function __construct() {
		parent::__construct();
		$this->rows = [];
		$this->classes = [];
		$this->inlineCss = [];
		$this->width = '';
		$this->displayTitle = false;
		$this->horizontalScroll = false;
		$this->htmlId = '';
	}
	public function setHtmlId(string $id):void {
		$this->htmlId = $id;
	}
	/**
	 * Defines if a horizontal scroll should be displayed when the table is
	 * wider than the available space
	 * @param boolean $status true if the scrollbar is enabled, false if not
	 */
	public function setHorizontalScroll(bool $status = true):void {
		$this->horizontalScroll = $status;
	}
	/**
	 * Defines if the first row of the table should be formatted as a header row
	 * @param boolean $status true if the first row should be formated as a
	 * header row, false if not
	 */
	protected function setHeaderRowStatus(bool $status = true):void {
		$this->displayTitle = $status;
	}
	/**
	 * Returns the status for formating the first row as a header row
	 * @return boolean true if the first row should be formated as a
	 * header row, false if not
	 */
	protected function getHeaderRowStatus():bool {
		return $this->displayTitle;
	}
	/**
	 * Returns the row list defined for the table
	 * @return Row[] the row list of the table
	 */
	protected function getRows():array {
		return $this->rows;
	}
	/**
	 * Adds a css property to the tag table definition
	 * @param string $code the css property added (ex: "width: 30px").
	 * If the string does not end with a semicolon, then one will be appended
	 * automatically
	 *
	 */
	public function addCss(string $code):void {
		if (substr($code, -1) != ';') {
			$code .= ';';
		}
		$this->inlineCss[] = $code;
	}
	/**
	 * Adds a css class to the html tag
	 * @param string $class the name of the css class added
	 */
	public function addClass(string $class):void {
		$this->classes[] = $class;
	}
	/**
	 * Defines the width of the table
	 * @param string $width the width of the table, usind a css format
	 */
	public function setWidth(string $width):void {
		$this->width = $width;
	}
	/**
	 * Adds a row to the table
	 * @param Row $row (optional) the row to be added. If the
	 * parameter is not defined then a new row will be created
	 * @return Row the added row
	 */
	public function addRow(Row $row = NULL):Row {
		if ($row === null) {
			$row = new Row();
		}
		if (!is_a($row, 'Cosmin\Antheia\Classes\Table\Plain\Row')) {
			throw new Exception(
				'Only Cosmin\Antheia\Classes\Table\Plain\Row instances allowed'
			);
		}
		$this->rows[] = $row;
		return $row;
	}
	public function getHtml():string {
		if (count($this->rows) === 0) {
			throw new Exception('No rows defined');
		}
		if ($this->width != '') {
			$this->addCss('width: '.$this->width.';');
		}
		$code = '';
		if ($this->horizontalScroll) {
			$code .= '<div class="ant_table-scroll">';
		}
		$code .= '<table ';
		if (count($this->classes) > 0) {
			$code .= ' class="'.implode(' ', $this->classes).'"';
		}
		if (count($this->inlineCss) > 0) {
			$code .= ' style="';
			$code .= implode(' ', $this->inlineCss);
			$code .= '"';
		}
		if ($this->htmlId != '') {
			$code .= ' id="'.$this->htmlId.'"';
		}
		$code .= '>';
		if ($this->displayTitle) {
			$code .= '<thead>';
		} else {
			$code .= '<tbody>';
		}
		/** @var Row $element */
		foreach ($this->rows as $index => $element) {
			if ($index == 0) {
				if ($this->displayTitle) {
					$element->formatAsTitle();
				}
			}
			$code .= $element->getHtml();
			if ($index == 0) {
				if ($this->displayTitle) {
					$code .= '</thead><tbody>';
				}
			}
		}
		$code .= '</tbody></table>';
		if ($this->horizontalScroll) {
			$code .= '</div>';
		}
		return $code;
	}
}
?>