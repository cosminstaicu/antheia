<?php
namespace Cosmin\Antheia\Scripts\Ajax;
include '../../Classes/Globals.php';
use Cosmin\Antheia\Classes\Globals;
include '../../Classes/Texts.php';
require_once '../../Classes/Texts/AbstractText.php';
require_once '../../Classes/Texts/English.php';
require_once '../../Classes/Texts/Romana.php';
use Cosmin\Antheia\Classes\Texts;
/**
 * The script is requested by the date input, when selecting a value
 * @author Cosmin Staicu
 */
$curentMonth = (int) $_POST['m'];
$curentYear = (int) $_POST['y'];
Globals::setLanguage($_POST['lg']);
$previousYear = $curentYear;
$previousMonth = $curentMonth - 1;
if ($previousMonth === 0) {
	$previousMonth = 12;
	$previousYear--;
}
$nextYear = $curentYear;
$nextMonth = $curentMonth + 1;
if ($nextMonth === 13) {
	$nextMonth = 1;
	$nextYear++;
}
$today = date('Ymd');
$monthText = Texts::getMonth($curentMonth);
// ********************************************************************* BUTTONS
$code = '<div>'
	.'<input type="button" value="<" onClick="jsf_inputDate_changeMonth('
	.$previousMonth.','.$previousYear.')"><input type="button" value="'
	.$monthText.'" onClick="jsf_inputDate_showMonths()">'
	.'<input type="button" value="'
	.$curentYear.'" onClick="jsf_inputDate_clickYear(this)">'
	.'<input type="button" value=">" onClick="jsf_inputDate_changeMonth('
	.$nextMonth.','.$nextYear.')">'
	.'</div>'
	.'<div>'
	.'<input type="button" value="<" onClick="jsf_inputDate_changeYears(this)">'
	.'<input type="button" value=">" onClick="jsf_inputDate_changeYears(this)">'
	.'</div>'
	.'<table>';
// ***************************************************************** MONTH TABLE	
$code .= '<thead><tr>'
		.'<th>'.substr(Texts::get('MONDAY'), 0, 1).'</th>'
		.'<th>'.substr(Texts::get('TUESDAY'), 0, 1).'</th>'
		.'<th>'.substr(Texts::get('WEDNESDAY'), 0, 1).'</th>'
		.'<th>'.substr(Texts::get('THURSDAY'), 0, 1).'</th>'
		.'<th>'.substr(Texts::get('FRIDAY'), 0, 1).'</th>'
		.'<th>'.substr(Texts::get('SATURDAY'), 0, 1).'</th>'
		.'<th>'.substr(Texts::get('SUNDAY'), 0, 1).'</th>'
	.'</tr></thead><tbody><tr>';
$dateJulian = cal_to_jd ( CAL_GREGORIAN, $curentMonth, 1, $curentYear );
$daysInMonth = cal_days_in_month ( CAL_GREGORIAN, $curentMonth, $curentYear);
$dayOfWeek = jddayofweek ( $dateJulian, 0 );
if ($dayOfWeek == 0) {
	$dayOfWeek = 7;
}
// if the month does not start on monday, empty cells will fill the empty days
$currentColumn = $dayOfWeek;
for ($i = 1; $i < $dayOfWeek; $i ++) {
	$code .='<td>&nbsp;</td>';
}
$monthPrefix = "";
if ($curentMonth < 10) {
	$monthPrefix = "0";
}
for ($i = 1; $i <= $daysInMonth; $i ++) {
	if ($currentColumn == 8) {
		$currentColumn = 1;
		$code .= '</tr><tr>';
	}
	$inputValue = $curentYear.$monthPrefix.$curentMonth;
	if ($i < 10) {
		$inputValue .= '0';
	}
	$inputValue .= $i;
	$code .= '<td><a href="javascript:void(0)" data-value="'.$inputValue.'"'
		.'data-text="'.$i.' '.$monthText.' '.$curentYear.'" '
		.'onClick="jsf_inputDate_select(this)"';
	if ($today === $inputValue) {
		$code .= ' class="jsf_today"';
	}
	$code .='>'.$i.'</a></td>';
	$currentColumn ++;
}
// if the month does not end on a sunday, empty cells will fill in the days
for( $i = $currentColumn; $i <= 7; $i ++) {
	$code .='<td>&nbsp;</td>';
}
$code .= '</tr></tbody></table>';
// ************************************************************* MONTH SELECTION
$code .= '<div>';
for ($i = 1; $i <= 12; $i++) {
	$code .= '<input type="button" value="'.Texts::getMonth($i)
		.'" onClick="jsf_inputDate_changeMonth('.$i.')">';
}
$code .='</div>';
// ************************************************************** YEAR SELECTION
$code .= '<div></div>';
echo $code;
?>