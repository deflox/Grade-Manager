<?php

/**
 * Validates values submitted from login form.
 *
 * @param $data: $_POST array.
 * @return bool: True if everything was successful, false if not ok. 
 */
function validate_login_input($data) {

    if ( empty($data['user_email']) || empty($data['user_password']) ) {
        set_err_msg('error_required_fields');
        return false;
    } else if ( !filter_var($data['user_email'], FILTER_VALIDATE_EMAIL) ) {
        set_err_msg('error_validate_email');
        return false;
    } else {
        return true;
    }

}

/**
 * Validates the reset password form.
 *
 * @param $data
 * @return bool
 */
function validate_reset_password($data) {

    if ( empty($data['user_email']) ) {
        set_err_msg('error_required_fields');
        return false;
    } else if ( !filter_var($data['user_email'], FILTER_VALIDATE_EMAIL) ) {
        set_err_msg('error_validate_email');
        return false;
    } else {
        return true;
    }

}

function validate_semester_input ($data) {

    global $lang;

    if ( empty($data['semester_name']) ) {
        set_err_msg('error_required_fields');
        return false;
    } else if ( get_length($data['semester_name']) >= 45 ) {
        set_message( sprintf($lang->translate('error_lenght'), 'semester name', '45') );
        return false;
    } else {
        return true;
    }

}

function validate_subject_input ($data) {

    global $lang;

    if ( empty($data['subject_name']) || empty($data['subject_counting']) ) {
        set_message($lang->translate('error_required_fields'));
        return false;
    } else if ( get_length($data['subject_name']) >= 45 ) {
        set_message( sprintf($lang->translate('error_lenght'), strtolower($lang->translate('input_description_subject_name')), '45') );
        return false;
    } else if ( !is_numeric($data['subject_counting']) ) {
        set_message( sprintf( $lang->translate('error_numeric'), strtolower($lang->translate('input_description_subject_counting')) ) );
        return false;
    }  else if ( strpos($data['subject_counting'], '.') === false && get_length($data['subject_counting']) > 2 ) {
        set_message( sprintf( $lang->translate('error_numbers'), strtolower($lang->translate('input_description_subject_counting')) ) );
        return false;
    } else if ( strpos($data['subject_counting'], '.') !== false && get_length( substr( $data['subject_counting'], strpos($data['subject_counting'], '.') ) ) > 3 ) {
        set_message( sprintf( $lang->translate('error_numbers'), strtolower($lang->translate('input_description_subject_counting')) ) );
        return false;
    } else if ( strpos($data['subject_counting'], '.') !== false && get_length( substr( $data['subject_counting'], - ( strpos($data['subject_counting'], '.') ) ) ) > 2 ) {
        set_message( sprintf( $lang->translate('error_numbers'), strtolower($lang->translate('input_description_subject_counting')) ) );
        return false;
    } else if ( strpos($data['subject_counting'], '.') !== false && get_length( substr( $data['subject_counting'], strpos($data['subject_counting'], '.') ) ) == 1 ) {
        set_message( sprintf( $lang->translate('error_no_numbers_after_comma'), strtolower($lang->translate('input_description_subject_counting')) ) );
        return false;
    } else {
        return true;
    }

}

function validate_grade_input ($data) {

    global $lang;

    if ( empty($data['grade_name']) || empty($data['grade_value']) || empty($data['grade_counting']) ) {
        set_message($lang->translate('error_required_fields'));
        return false;
    } else if ( get_length($data['grade_name']) >= 45 ) {
        set_message( sprintf($lang->translate('error_lenght'), strtolower($lang->translate('input_description_grade_name')), '45') );
        return false;
    } else if ( !is_numeric($data['grade_value']) ) {
        set_message( sprintf( $lang->translate('error_numeric'), strtolower($lang->translate('input_description_grade_value')) ) );
        return false;
    } else if ( !is_numeric($data['grade_counting']) ) {
        set_message( sprintf( $lang->translate('error_numeric'), strtolower($lang->translate('input_description_grade_counting')) ) );
        return false;
    } else if ( strpos($data['grade_counting'], '.') === false && get_length($data['grade_counting']) > 2 ) {
        set_message( sprintf( $lang->translate('error_numbers'), strtolower($lang->translate('input_description_grade_counting')) ) );
        return false;
    } else if ( strpos($data['grade_counting'], '.') !== false && get_length( substr( $data['grade_counting'], strpos($data['grade_counting'], '.') ) ) > 3 ) {
        set_message( sprintf( $lang->translate('error_numbers'), strtolower($lang->translate('input_description_grade_counting')) ) );
        return false;
    } else if ( strpos($data['grade_counting'], '.') !== false && get_length( substr( $data['grade_counting'], - ( strpos($data['grade_counting'], '.') ) ) ) > 2 ) {
        set_message( sprintf( $lang->translate('error_numbers'), strtolower($lang->translate('input_description_grade_counting')) ) );
        return false;
    } else if ( strpos($data['grade_counting'], '.') !== false && get_length( substr( $data['grade_counting'], strpos($data['grade_counting'], '.') ) ) == 1 ) {
        set_message( sprintf( $lang->translate('error_no_numbers_after_comma'), strtolower($lang->translate('input_description_grade_counting')) ) );
        return false;
    } else if ( strpos($data['grade_value'], '.') === false && get_length($data['grade_value']) > 2 ) {
        set_message( sprintf( $lang->translate('error_numbers'), strtolower($lang->translate('input_description_grade_value')) ) );
        return false;
    } else if ( strpos($data['grade_value'], '.') !== false && get_length( substr( $data['grade_value'], strpos($data['grade_value'], '.') ) ) > 3 ) {
        set_message( sprintf( $lang->translate('error_numbers'), strtolower($lang->translate('input_description_grade_value')) ) );
        return false;
    } else if ( strpos($data['grade_value'], '.') !== false && get_length( substr( $data['grade_value'], - ( strpos($data['grade_value'], '.') ) ) ) > 2 ) {
        set_message( sprintf( $lang->translate('error_numbers'), strtolower($lang->translate('input_description_grade_value')) ) );
        return false;
    } else if ( strpos($data['grade_value'], '.') !== false && get_length( substr( $data['grade_value'], strpos($data['grade_value'], '.') ) ) == 1 ) {
        set_message( sprintf( $lang->translate('error_no_numbers_after_comma'), strtolower($lang->translate('input_description_grade_value')) ) );
        return false;
    } else if ( !empty($data['grade_description']) && get_length($data['grade_description']) >= 250 ) {
        set_message( sprintf($lang->translate('error_lenght'), strtolower($lang->translate('input_description_grade_description')), '250') );
        return false;
    } else if ( !empty($data['grade_date']) && !validate_date($data['grade_date'], $_SESSION['user_date_format'] ) ) {
        set_message( sprintf($lang->translate('error_date_format'), strtolower($lang->translate('input_description_grade_date')), $_SESSION['user_date_format_nice'] ) );
        return false;
    } else {
        return true;
    }

}

function validate_user_settings_change ($data) {

    global $lang;

	if ( empty($data['user_firstname']) || empty($data['user_lastname']) || empty($data['user_email'] ) ) {
		set_message($lang->translate('error_required_fields'));
        return false;
	} else if ( !filter_var($data['user_email'], FILTER_VALIDATE_EMAIL) ) {
		set_message($lang->translate('error_validate_email'));
        return false;
	} else if ( get_length($data['user_firstname']) >= 45 ) {
		set_message( sprintf($lang->translate('error_lenght'), strtolower($lang->translate('input_description_firstname')), '45') );
        return false;
	} else if ( get_length($data['user_lastname']) >= 45 ) {
		set_message( sprintf($lang->translate('error_lenght'), strtolower($lang->translate('input_description_lastname')), '45') );
        return false;
	} else if ( get_length($data['user_email']) >= 45 ) {
		set_message( sprintf($lang->translate('error_lenght'), strtolower($lang->translate('input_description_email')), '45') );
        return false;
	} else {
		return true;
	}	
	
}

function validate_user_password_change ($data) {

    global $lang;

	if ( empty($data['user_current_password']) || empty($data['user_new_password']) || empty($data['user_new_password_repeat']) ) {
		set_message($lang->translate('error_required_fields'));
        return false;
	} else if ( !verify_user_password($data['user_current_password']) ) {
		set_message($lang->translate('error_validate_current_password'));
		return false;
	} else if ( $data['user_new_password'] != $data['user_new_password_repeat'] ) {
		set_message($lang->translate('error_validate_same_password'));
        return false;
	} else {
		return true;
	}

}

function validate_date($date, $format) {

    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function get_length ($s) {

    return strlen(utf8_decode($s));

}