<?php
namespace Antheia\Antheia\Classes;
/**
 * Manages the texts used by the library, according to the selected language.
 * @author Cosmin Staicu
 */
class Texts {
	private function __construct() {
		
	}
	/**
	 * Returns a text, according to the selected language
	 * @param string $id the id of the text, (the name of the constant) as
	 * defined inside the language file
	 * @return string the text that will be displayed
	 */
	public static function get(string $id):string {
		return constant(Globals::getLanguage().'::'. $id);
	}
	/**
	 * Returns a lowercase text, according to the selected language
	 * @param string $id the id of the text, (the name of the constant) as
	 * defined inside the language file
	 * @return string the text that will be displayed
	 */
	public static function getLc(string $id):string {
		return strtolower(self::get($id));
	}
	/**
	 * Returns the name of a month, according to the index
	 * (1=january, 2=february etc)
	 * @param int $index the index of the month
	 * @param boolean $short (optional) (default false) if it is true then only
	 * the first 3 letters of the name are returned
	 * @return string name of the month
	 */
	public static function getMonth(int $index, $short = false):string {
		$indexMonth = (int) $index;
		if ($indexMonth < 10) {
			$indexMonth = '0'.$indexMonth;
		}
		$months = [
				'01' => self::get('JANUARY'),
				'02' => self::get('FEBRUARY'),
				'03' => self::get('MARCH'),
				'04' => self::get('APRIL'),
				'05' => self::get('MAY'),
				'06' => self::get('JUNE'),
				'07' => self::get('JULY'),
				'08' => self::get('AUGUST'),
				'09' => self::get('SEPTEMBER'),
				'10' => self::get('OCTOBER'),
				'11' => self::get('NOVEMBER'),
				'12' => self::get('DECEMBER')
		][$indexMonth];
		if ($short) {
			return substr($months, 0, 3);
		} else {
			return $months;
		}
	}
	/**
	 * Returns a date value used inside a form as a human readable text.
	 * Example: 19810427 will be returned as 27 April 1981
	 * @param string $date the date using the format YYYYMMDD
	 * @param boolean $short (optional) (default false) if true then only the
	 * first 3 letters of the month will be returned
	 * @return string the date, as a human readable text
	 */
	public static function formatDate(string $date, bool $short = false):string {
		if ($date === Globals::getUndefinedDate()) {
			return self::get('UNDEFINED');
		}
		return substr($date, 6, 2 )
			.' '.self::getMonth(substr($date, 4, 2), $short)
			.' '.substr ($date, 0, 4);
	}
	/**
	 * Returns a time value used inside a form as a human readable text
	 * The text is identical if the time is defined. If the time is undefined
	 * then the text "undefined" will be returned
	 * @param string $time the time, using the HH:MM format
	 * @return string human readable time
	 */
	public static function formatTime(string $time):string {
		if ($time == Globals::getUndefinedTime()) {
			return self::get('UNDEFINED');
		} else {
			return substr($time, 0, 2).':'.substr($time, 3);
		}
	}
}
?>
