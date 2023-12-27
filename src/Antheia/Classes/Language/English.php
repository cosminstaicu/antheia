<?php
namespace Antheia\Antheia\Classes\Language;
/**
 * The texts used by the framework when it is displayed in English
 * @author Cosmin Staicu
 */
abstract class English extends AbstractLanguage {
	const LANGUAGE_ID = 'en';
	// ******************************************************** days of the week
	const MONDAY = 'Monday';
	const TUESDAY = 'Tuesday';
	const WEDNESDAY = 'Wednesday';
	const THURSDAY = 'Thursday';
	const FRIDAY = 'Friday';
	const SATURDAY = 'Saturday';
	const SUNDAY = 'Sunday';
	// ****************************************************************** months
	const JANUARY = 'January';
	const FEBRUARY = 'February';
	const MARCH = 'March';
	const APRIL = 'April';
	const MAY = 'May';
	const JUNE = 'June';
	const JULY = 'July';
	const AUGUST = 'August';
	const SEPTEMBER = 'September';
	const OCTOBER = 'October';
	const NOVEMBER = 'November';
	const DECEMBER = 'December';
	// ***************************************************************** various
	const ADD = 'Add';
	const ADD_INFO = 'Add info';
	const ADD_PRODUCT = 'Add product';
	const ANIMATIONS = 'Animations';
	const BACK = 'Back';
	const BACKGROUND = 'Background';
	const BACKGROUND_EFFECT = 'Background effect';
	const BLUR = 'Blur';
	const BLUR_WARNING = 'The BLUR effect has an important impact '
			.'on performance and can cause stagging of the main animation.';
	const BORDER = 'Border';
	const BUG = 'Bug';
	const BUTTON = 'Button';
	const BUTTON_BACKGROUND = 'Button background';
	const BUTTON_HOVER_BACKGROUND = 'Button background (hover)';
	const BUTTON_TEXT = 'Button text';
	const CANCEL = 'Cancel';
	const CHARACTERS = 'characters';
	const CLOSE = 'Close';
	const COLOR_INPUT_EXAMPLE = 'Example inputs for colors preview';
	const COPY = 'Copy';
	const DEFAULT = 'Default';
	const DELETE = 'Delete';
	const DELETE_CONFIRMATION_INVALID = 'You did not type DELETE in the indicated field';
	const DESCRIPTION = 'Description';
	const DOES_NOT_MATTER = 'Does not matter';
	const DOWNLOAD = 'Download';
	const DROP_FILE_HERE = 'Drop file here to upload.';
	const EDIT = 'Edit';
	const EMPTY_SEARCH = 'No items have been found!';
	const EXAMPLE = 'Example';
	const EXTENSION_NOT_ALLOWED = 'Extension not allowed';
	const FILE = 'File';
	const FILE_SIZE_ERROR = 'File size error';
	const FOLDER = 'Folder';
	const FORM_EXAMPLE = 'Form example';
	const FORMS = 'Forms';
	const FORWARD = 'Forward';
	const HEADER_BACKGROUND = 'Header background';
	const HELP = 'Help';
	const HOUR = 'Hour';
	const IDENTICAL_PASSWORDS = 'Passwords must be identical';
	const INFO_PAGE = 'Info page';
	const INFORMATION = 'Information';
	const INPUT_BACKGROUND = 'Input background';
	const INPUT_BORDER = 'Input border';
	const INPUT_LABEL = 'Input label';
	const INPUT_ICON = 'Input icon';
	const INPUT_TEXT = 'Input text';
	const INTERFACE = 'Interface';
	const INVALID_INPUT = 'Invalid input';
	const INVALID_INPUT_INFO = 'This input is always invalid';
	const LANGUAGE = 'Language';
	const LARGE_MESSAGE = 'Large message';
	const LINK = 'Link';
	const LINK_HOVER = 'Link hover';
	const LOAD_THEME = 'Load theme';
	const LOADING = 'Loading';
	const LOADING_3_SEC = 'Loading (3 sec)';
	const LOADING_STEPS = 'Loading (steps)';
	const LOGIN = 'Login';
	const LOGIN_FAILED = 'Login process failed';
	const LOGOUT = 'Logout';
	const LOW_CONTRAST = 'Low contrast';
	const MAXIMUM = 'Maximum';
	const MAXIMUM_UPLOAD_SIZE_ERROR = 'Maximum upload size exceeded';
	const MENU = 'Menu';
	const MENU_BACKGROUND = 'Menu background';
	const MENU_TEXT = 'Menu text';
	const MINIMUM = 'Minimum';
	const MINUTE = 'Minute';
	const NAME = 'Name';
	const NEW_PASSWORD = 'New password';
	const NO_RESULTS = 'No results found';
	const NO_ITEMS_FOUND = 'No items have been found!';
	const OF = 'of';
	const OK = 'OK';
	const ON = 'On';
	const OR_JUST_BROWSE = 'or just browse for one';
	const OTHER_COLORS = 'Other colors';
	const PAGE = 'Page';
	const PAGE_TITLE = 'Page title';
	const PANEL = 'Panel';
	const PASSWORD = 'Password';
	const PASSWORD_3_CHARACTERS = 'Password must have at least 3 characters!';
	const PASSWORD_DIGITS = 'Must have at least one digit';
	const PASSWORD_LOWERCASE = 'Must have at least one lowercase letter';
	const PASSWORD_MUST_CONTAIN = 'Password must satisfy the following criteria:';
	const PASSWORD_ONLY_DIGITS = 'Can only contain digits';
	const PASSWORD_SPECIAL = 'Must have at least one special character';
	const PASSWORD_UPPERCASE = 'Must have at least one uppercase letter';
	const PLAYBACK = 'Playback';
	const PREVIEW = 'Preview';
	const PRODUCTS = 'Products';
	const REFRESH = 'Refresh';
	const REMEMBER_LOGIN = 'remember login';
	const RESET = 'Reset';
	const RESULTS = 'results';
	const RETRY = 'Retry';
	const RETYPE_NEW_PASSWORD = 'Retype new password';
	const SEARCH = 'Search';
	const SECONDARY_BACKGROUND = 'Seconday background';
	const SELECT = 'Select';
	const SELECT_A_FILE = 'select a file';
	const SELECT_ALL = 'select all';
	const SELECTED_VALUE_INVALID = 'Selected value is not valid!';
	const SETTINGS = 'Settings';
	const SHADOWS = 'Shadows';
	const SHOPPING_CART = 'Shopping cart';
	const SMALL_MESSAGE = 'Small message';
	const SORT_BY = 'Sort by';
	const START_ANIMATION = 'Display it!';
	const STEP = 'Step';
	const STEPS = 'Steps';
	const STEPS_PROGRESS_LEFT = 'Steps left progress';
	const STEPS_PROGRESS_RIGHT = 'Steps right progress';
	const SUBMIT = 'Submit';
	const TAB_BACKGROUND = 'Tab background';
	const TAB_TEXT = 'Tab text';
	const TEXT = 'Text';
	const THEME = 'Theme';
	const THEME_INFORMATION = 'Theme information';
	const TIME = 'Time';
	const TITLE = 'Title';
	const TODAY = 'Today';
	const TOO_MANY_FILES = 'Too many files';
	const TOP_BOTTOM_BAR_BACKGROUND = 'Top-bottom bar background';
	const TOP_BOTTOM_BAR_TEXT = 'Top-bottom bar text';
	const TYPE_DELETE = 'To confirm the operation, type DELETE in the field below';
	const UNDEFINED = 'Undefined';
	const UPDATE = 'Update';
	const USERNAME = 'Username';
	const UPLOAD = 'Upload';
	const USERNAME_3_CHARACTERS = 'Username must have at least 3 characters!';
	const VALID = 'Valid';
	const VALID_INPUT = 'Valid input';
	const VALID_INPUT_INFO = 'This input is always valid';
	const VALUE = 'Value';
	const VALUE_FOR_DELETE_CONFIRMATION = 'DELETE';
	const VIEW = 'View';
	const WARNING = 'Warning';
}
?>