<?php
namespace Antheia\Antheia\Classes\Input;
/**
 * A shortcut class for generating any input without adding the namespace
 * to the document use section (as a form uses many types of inputs, the
 * namespace declaration section can become crowded)
 * @author Cosmin Staicu
 */
abstract class NewInput {
	private function __constructor() {
		// singleton class
	}
	/**
	 * Creates a button and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputButton
	 * @return InputButton the new input that has been created
	 */
	public static function button():InputButton {
		return new InputButton();
	}
	/**
	 * Creates a checkbox and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputCheckbox
	 * @return InputCheckbox the new input that has been created
	 */
	public static function checkbox():InputCheckbox {
		return new InputCheckbox();
	}
	/**
	 * Creates a color input and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputColor
	 * @return InputColor the new input that has been created
	 */
	public static function color():InputColor {
		return new InputColor();
	}
	/**
	 * Creates a custom button and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputCustomButton
	 * @return InputCustomButton the new input that has been created
	 */
	public static function customButton():InputCustomButton {
		return new InputCustomButton();
	}
	/**
	 * Creates a date input and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputDate
	 * @return InputDate the new input that has been created
	 */
	public static function date():InputDate {
		return new InputDate();
	}
	/**
	 * Creates an email input and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputEmail
	 * @return InputEmail the new input that has been created
	 */
	public static function email():InputEmail {
		return new InputEmail();
	}
	/**
	 * Creates a file input and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputFile
	 * @return InputFile the new input that has been created
	 */
	public static function file():InputFile {
		return new InputFile();
	}
	/**
	 * Creates a file drop input and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputFileDrop
	 * @return InputFileDrop the new input that has been created
	 */
	public static function fileDrop():InputFileDrop {
		return new InputFileDrop();
	}
	/**
	 * Creates a info input and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputInfo
	 * @return InputInfo the new input that has been created
	 */
	public static function info():InputInfo {
		return new InputInfo();
	}
	/**
	 * Creates a new password input and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputNewPassword
	 * @return InputNewPassword the new input that has been created
	 */
	public static function newPassword():InputNewPassword {
		return new InputNewPassword();
	}
	/**
	 * Creates a number input and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputNumber
	 * @return InputNumber the new input that has been created
	 */
	public static function number():InputNumber {
		return new InputNumber();
	}
	/**
	 * Creates a password input and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputPassword
	 * @return InputPassword the new input that has been created
	 */
	public static function password():InputPassword {
		return new InputPassword();
	}
	/**
	 * Creates a phone input and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputPhone
	 * @return InputPhone the new input that has been created
	 */
	public static function phone():InputPhone {
		return new InputPhone();
	}
	/**
	 * Creates a reset button and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputReset
	 * @return InputReset the new input that has been created
	 */
	public static function reset():InputReset {
		return new InputReset();
	}
	/**
	 * Creates a search input and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputSearch
	 * @return InputSearch the new input that has been created
	 */
	public static function search():InputSearch {
		return new InputSearch();
	}
	/**
	 * Creates a select input and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputSelect
	 * @return InputSelect the new input that has been created
	 */
	public static function select():InputSelect {
		return new InputSelect();
	}
	/**
	 * Creates a submit button and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputSubmit
	 * @return InputSelect the new input that has been created
	 */
	public static function submit():InputSubmit {
		return new InputSubmit();
	}
	/**
	 * Creates a text input and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputText
	 * @return InputText the new input that has been created
	 */
	public static function text():InputText {
		return new InputText();
	}
	/**
	 * Creates a textarea input and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputTextarea
	 * @return InputTextarea the new input that has been created
	 */
	public static function textarea():InputTextarea {
		return new InputTextarea();
	}
	/**
	 * Creates a time input and returns it
	 * @see \Antheia\Antheia\Classes\Input\InputTime
	 * @return InputTime the new input that has been created
	 */
	public static function time():InputTime {
		return new InputTime();
	}
}
?>