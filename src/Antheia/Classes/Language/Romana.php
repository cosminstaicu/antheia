<?php
namespace Antheia\Antheia\Classes\Language;
/**
 * The texts used by the framework when it is displayed in Romanian
 * @author Cosmin Staicu
 *
 */
abstract class Romana extends AbstractLanguage {
	const LANGUAGE_ID = 'ro';
	// ******************************************************** days of the week
	const MONDAY = 'Luni';
	const TUESDAY = 'Marți';
	const WEDNESDAY = 'Miercuri';
	const THURSDAY = 'Joi';
	const FRIDAY = 'Vineri';
	const SATURDAY = 'Sâmbătă';
	const SUNDAY = 'Duminică';
	// ****************************************************************** months
	const JANUARY = 'Ianuarie';
	const FEBRUARY = 'Februarie';
	const MARCH = 'Martie';
	const APRIL = 'Aprilie';
	const MAY = 'Mai';
	const JUNE = 'Iunie';
	const JULY = 'Iulie';
	const AUGUST = 'August';
	const SEPTEMBER = 'Septembrie';
	const OCTOBER = 'Octombrie';
	const NOVEMBER = 'Noiembrie';
	const DECEMBER = 'Decembrie';
	// ***************************************************************** various
	const ADD = 'Adăugare';
	const ADD_INFO = 'Adăugare informații';
	const ADD_PRODUCT = 'Adăugare produs';
	const ANIMATIONS = 'Animații';
	const BACK = 'Înapoi';
	const BACKGROUND = 'Fundal';
	const BACKGROUND_EFFECT = 'Efect fundal';
	const BLUR = 'Blur';
	const BLUR_WARNING = 'Efectul BLUR solicită puternic sistemul '
			.'și poate cauza sacadarea animației';
	const BORDER = 'Chenar';
	const BUG = 'Bug';
	const BUTTON = 'Buton';
	const BUTTON_BACKGROUND = 'Fundal buton';
	const BUTTON_HOVER_BACKGROUND = 'Fundal buton selectat';
	const BUTTON_TEXT = 'Text buton';
	const CANCEL = 'Anulare';
	const CHARACTERS = 'caractere';
	const CLOSE = 'Închide';
	const COLOR_INPUT_EXAMPLE = 'Câmpuri pentru exemplificarea culorilor';
	const COPY = 'Copiază';
	const DEFAULT = 'Implicit';
	const DELETE = 'Ștergere';
	const DELETE_CONFIRMATION_INVALID = 'Nu ai scris STERGERE în zona indicată';
	const DESCRIPTION = 'Descriere';
	const DOES_NOT_MATTER = 'Nespecificat';
	const DOWNLOAD = 'Descarcă';
	const DROP_FILE_HERE = 'Pune un fișier aici pentru încărcare.';
	const EDIT = 'Editare';
	const EMPTY_SEARCH = 'Căutarea nu a furnizat niciun rezultat!';
	const EXAMPLE = 'Exemplu';
	const EXTENSION_NOT_ALLOWED = 'Extensie nepermisă';
	const FILE = 'Fișier';
	const FILE_SIZE_ERROR = 'Fișierul este prea mare';
	const FOLDER = 'Folder';
	const FORM_EXAMPLE = 'Exemplu formular';
	const FORMS = 'Formulare';
	const FORWARD = 'Înainte';
	const HEADER_BACKGROUND = 'Fundal antet';
	const HELP = 'Ajutor';
	const HOUR = 'Ora';
	const IDENTICAL_PASSWORDS = 'Parolele trebuie să fie identice';
	const INFO_PAGE = 'Fișă';
	const INFORMATION = 'Informații';
	const INPUT_BACKGROUND = 'Fundal câmp';
	const INPUT_BORDER = 'Chenar câmp';
	const INPUT_ICON = 'Simbol câmp';
	const INPUT_LABEL = 'Etichetă câmp';
	const INPUT_TEXT = 'Text câmp';
	const INTERFACE = 'Interfață';
	const INVALID_INPUT = 'Câmp invalid';
	const INVALID_INPUT_VALUE = 'Valoare incorectă';
	const INVALID_INPUT_INFO = 'Acest câmp este întotdeauna invalid';
	const LANGUAGE = 'Limbă';
	const LARGE_MESSAGE = 'Mesaj confirmare mare';
	const LINK = 'Link';
	const LINK_HOVER = 'Link selectat';
	const LOAD_THEME = 'Încarcă temă';
	const LOADING = 'Se încarcă';
	const LOADING_3_SEC = 'Se încarcă (3 sec)';
	const LOADING_STEPS = 'Se încarcă (etape)';
	const LOGIN = 'Autentificare';
	const LOGIN_FAILED = 'Autentificare nereușită';
	const LOGOUT = 'Ieșire';
	const LOW_CONTRAST = 'Contrast scăzut';
	const MAXIMUM = 'Maximum';
	const MAXIMUM_UPLOAD_SIZE_ERROR = 'Dimensiunea totală a fost depășită';
	const MENU = 'Meniu';
	const MENU_BACKGROUND = 'Fundal meniu';
	const MENU_TEXT = 'Text meniu';
	const MINIMUM = 'Minimum';
	const MINUTE = 'Minut';
	const NAME = 'Denumire';
	const NEW_PASSWORD = 'Parola nouă';
	const NO_RESULTS = 'Nu a fost găsit niciun rezultat';
	const NO_ITEMS_FOUND = 'Nu au fost găsite elemente!';
	const OF = 'din';
	const OK = 'OK';
	const ON = 'Pornire';
	const OR_JUST_BROWSE = 'sau selectează unul';
	const OTHER_COLORS = 'Alte culori';
	const PAGE = 'Pagina';
	const PAGE_TITLE = 'Titlu pagină';
	const PANEL = 'Container';
	const PASSWORD = 'Parola';
	const PASSWORD_3_CHARACTERS = 'Parola trebuie sa fie de minimum 3 caractere!';
	const PASSWORD_DIGITS = 'Să conțină cel puțin o cifra';
	const PASSWORD_LOWERCASE = 'Să conțină cel puțin o literă mică';
	const PASSWORD_MUST_CONTAIN = 'Parola trebuie să îndeplinească următoarele condiții:';
	const PASSWORD_ONLY_DIGITS = 'Să conțină doar cifre';
	const PASSWORD_SPECIAL = 'Să conțină cel puțin un caracter special';
	const PASSWORD_UPPERCASE = 'Să conțină cel puțin o literă mare';
	const PLAYBACK = 'Redare';
	const PREVIEW = 'Vizualizare';
	const PRODUCTS = 'Produse';
	const REFRESH = 'Actualizare';
	const REMEMBER_LOGIN = 'memorează login';
	const RESET = 'Resetare';
	const RESULTS = 'rezultate';
	const RETRY = 'Reîncercare';
	const RETYPE_NEW_PASSWORD = 'Repetă parola nouă';
	const SEARCH = 'Căutare';
	const SECONDARY_BACKGROUND = 'Fundal secundar';
	const SELECT = 'Selecție';
	const SELECT_A_FILE = 'selectează un fișier';
	const SELECT_ALL = 'selectează tot';
	const SELECTED_VALUE_INVALID = 'Valoarea introdusă nu este validă!';
	const SETTINGS = 'Setări';
	const SHADOWS = 'Umbre';
	const SHOPPING_CART = 'Coș cumpărături';
	const SMALL_MESSAGE = 'Mesaj confirmare mic';
	const SORT_BY = 'Sortare după';
	const START_ANIMATION = 'Start animație';
	const STEP = 'Pasul';
	const STEPS = 'Etape';
	const STEPS_PROGRESS_LEFT = 'Etape progres stanga';
	const STEPS_PROGRESS_RIGHT = 'Etape progres dreapta';
	const SUBMIT = 'Validare';
	const TAB_BACKGROUND = 'Fundal tab';
	const TAB_TEXT = 'Text tab';
	const TEXT = 'Text';
	const THEME = 'Temă';
	const THREE_LINE_BUTTON = 'Buton cu 3 linii';
	const THREE_LINE_BUTTON_HOVER = 'Buton cu 3 linii (selectat)';
	const THEME_INFORMATION = 'Informații temă';
	const TIME = 'Timp';
	const TITLE = 'Titlu';
	const TODAY = 'Astăzi';
	const TOO_MANY_FILES = 'Prea multe fișiere';
	const TOP_BOTTOM_BAR_BACKGROUND = 'Fundal bară sus-jos';
	const TOP_BOTTOM_BAR_TEXT = 'Text bara sus-jos';
	const TYPE_DELETE = 'Pentru confirmare scrie STERGERE în câmpul de mai jos';
	const UNDEFINED = 'Nedefinit';
	const UPDATE = 'Actualizare';
	const UPLOAD = 'Încarcă';
	const USERNAME = 'Utilizator';
	const USERNAME_3_CHARACTERS = 'Numele utilizatorului trebuie sa fie de minimum 3 caractere!';
	const VALID = 'Valid';
	const VALID_INPUT = 'Câmp valid';
	const VALID_INPUT_INFO = 'Acest câmp este întotdeauna valid';
	const VALUE = 'Valoare';
	const VALUE_FOR_DELETE_CONFIRMATION = 'STERGERE';
	const VIEW = 'Vizualizare';
	const WARNING = 'Atenție';
}
?>