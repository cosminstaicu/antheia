<?php
namespace Antheia\Framework\Input;
/**
 * A shortcut class for generating any input without adding the namespace
 * to the document use section (as a form uses many types of inputs, the
 * namespace declaration section can become crowded)
 * @author Cosmin Staicu
 */
abstract class NewInput {
	private function __constructor() {}
	/**
	 * Creates a button and returns it
	 * @see \Antheia\Framework\Input\InputButton
	 * @return InputButton the new input that has been created
	 */
	public static function button():InputButton {
		return new InputButton();
	}
	/**
	 * Creates a checkbox and returns it
	 * @see \Antheia\Framework\Input\InputCheckbox
	 * @return InputCheckbox the new input that has been created
	 */
	public static function checkbox():InputCheckbox {
		return new InputCheckbox();
	}
	/**
	 * Creates a color input and returns it
	 * @see \Antheia\Framework\Input\InputColor
	 * @return InputColor the new input that has been created
	 */
	public static function color():InputColor {
		return new InputColor();
	}
	/**
	 * Creates a custom button and returns it
	 * @see \Antheia\Framework\Input\InputCustomButton
	 * @return InputCustomButton the new input that has been created
	 */
	public static function customButton():InputCustomButton {
		return new InputCustomButton();
	}
	/**
	 * Creates a date input and returns it
	 * @see \Antheia\Framework\Input\InputDate
	 * @return InputDate the new input that has been created
	 */
	public static function date():InputDate {
		return new InputDate();
	}
	/**
	 * Creates an email input and returns it
	 * @see \Antheia\Framework\Input\InputEmail
	 * @return InputEmail the new input that has been created
	 */
	public static function email():InputEmail {
		return new InputEmail();
	}
	/**
	 * Creates a file input and returns it
	 * @see \Antheia\Framework\Input\InputFile
	 * @return InputFile the new input that has been created
	 */
	public static function file():InputFile {
		return new InputFile();
	}
	/**
	 * Creates a file drop input and returns it
	 * @see \Antheia\Framework\Input\InputFileDrop
	 * @return InputFileDrop the new input that has been created
	 */
	public static function fileDrop():InputFileDrop {
		return new InputFileDrop();
	}
	/**
	 * Creates a info input and returns it
	 * @see \Antheia\Framework\Input\InputInfo
	 * @return InputInfo the new input that has been created
	 */
	public static function info():InputInfo {
		return new InputInfo();
	}
	/**
	 * Creates a new password input and returns it
	 * @see \Antheia\Framework\Input\InputNewPassword
	 * @return InputNewPassword the new input that has been created
	 */
	public static function newPassword():InputNewPassword {
		return new InputNewPassword();
	}
	/**
	 * Creates a number input and returns it
	 * @see \Antheia\Framework\Input\InputNumber
	 * @return InputNumber the new input that has been created
	 */
	public static function number():InputNumber {
		return new InputNumber();
	}
	/**
	 * Creates a password input and returns it
	 * @see \Antheia\Framework\Input\InputPassword
	 * @return InputPassword the new input that has been created
	 */
	public static function password():InputPassword {
		return new InputPassword();
	}
	/**
	 * Creates a phone input and returns it
	 * @see \Antheia\Framework\Input\InputPhone
	 * @return InputPhone the new input that has been created
	 */
	public static function phone():InputPhone {
		return new InputPhone();
	}
	/**
	 * Creates a reset button and returns it
	 * @see \Antheia\Framework\Input\InputReset
	 * @return InputReset the new input that has been created
	 */
	public static function reset():InputReset {
		return new InputReset();
	}
	/**
	 * Creates a search input and returns it
	 * @see \Antheia\Framework\Input\InputSearch
	 * @return InputSearch the new input that has been created
	 */
	public static function search():InputSearch {
		return new InputSearch();
	}
	/**
	 * Creates a select input and returns it
	 * @see \Antheia\Framework\Input\InputSelect
	 * @return InputSelect the new input that has been created
	 */
	public static function select():InputSelect {
		return new InputSelect();
	}
	/**
	 * Creates a submit button and returns it
	 * @see \Antheia\Framework\Input\InputSubmit
	 * @return InputSelect the new input that has been created
	 */
	public static function submit():InputSubmit {
		return new InputSubmit();
	}
	/**
	 * Creates a text input and returns it
	 * @see \Antheia\Framework\Input\InputText
	 * @return InputText the new input that has been created
	 */
	public static function text():InputText {
		return new InputText();
	}
	/**
	 * Creates a textarea input and returns it
	 * @see \Antheia\Framework\Input\InputTextarea
	 * @return InputTextarea the new input that has been created
	 */
	public static function textarea():InputTextarea {
		return new InputTextarea();
	}
	/**
	 * Creates a time input and returns it
	 * @see \Antheia\Framework\Input\InputTime
	 * @return InputTime the new input that has been created
	 */
	public static function time():InputTime {
		return new InputTime();
	}
}
?>
