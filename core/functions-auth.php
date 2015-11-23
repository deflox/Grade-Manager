<?php

/**
 * Checks if user is logged in.
 *
 * @return bool: True if logged in, false if not.
 */
function is_user_logged_in() {

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
        return true;
    }

    return false;

}

/**
 * Redirects user to dashboard, in case he is logged in.
 *
 */
function redirect_if_logged_in() {

    if ( is_user_logged_in() )
        header("Location: dashboard.php");

}

/**
 * Checks permission for a specific site.
 *
 * @param $who_has_access: Array with user groups, who can access this site.
 * @param $logged_in:      If user is even logged in.
 */
function check_permissions($who_has_access, $logged_in) {

    if (!$logged_in) {
        header ('Location: index.php');
    }

    if ( !in_array($_SESSION['user_rights'], $who_has_access) ) {

        // User has no permissions to view this site. Show error.
        die ('You do not have permissions to view this site.');

    }

}

function check_item_permissions ($semester_id, $subject_id = null, $grade_id = null) {

	global $m_semester, $m_subject, $m_grade, $lang;
	
	if ( $m_semester->select_semester_with_user_and_semester_id($_SESSION['user_id'], $semester_id) == null )
		die ($lang->translate('error_no_permissions'));
		
	if ( isset($subject_id) && $m_subject->select_subject_with_user_and_subject_id($_SESSION['user_id'], $subject_id) == null ) 
		die ($lang->translate('error_no_permissions'));
	
	if ( isset($grade_id) && $m_grade->select_grade_with_user_and_grade_id($_SESSION['user_id'], $grade_id) == null ) 
		die ($lang->translate('error_no_permissions'));

}

/**
 * Verifies user credentials.
 *
 * @param $data: POST data.
 * @return bool
 */
function verify_user_credentials ($data) {

    global $m_user;

    if ( $m_user->select_user_by_email($data['user_email']) === null ) {
        set_err_msg('error_validate_credentials');
        return false;
    } else if ( !$m_user->check_user_password($data['user_email'], $data['user_password']) ) {
        set_err_msg('error_validate_credentials');
        return false;
    } else {
        return true;
    }

}

function verify_user_password ($password) {
	
	global $m_user;
	
	$user = $m_user->select_user_by_email($_SESSION['user_email']);
	
	return password_verify($password, $user['user_password']);
	
}

/**
 * Verifies password reset.
 *
 * @param $data
 * @return bool
 */
function verify_password_reset ($data) {

    global $m_user;

    if ( $m_user->select_user_by_email($data['user_email']) === null ) {
        set_err_msg('error_validate_password_reset');
        return false;
    } else {
        return true;
    }

}

function update_user_info ($data) {

	global $m_user, $lang;
	
	$data['user_date_format_nice'] = get_date_formats()[$data['user_date_format']];
	
	if ( $m_user->update_user_info($data) ) {
        reload_user_session($data);
        set_message($lang->translate('success_saving'), 'success');
        header ('Location: settings.php');
    } else {
        set_message($lang->translate('error_updating'));
    }

}

function update_user_password ($data) {
	
	global $m_user, $lang;
	
	if ( $m_user->update_user_password($data) ) {
        set_message($lang->translate('success_saving'), 'success');
        header ('Location: settings.php');
    } else {
        set_message($lang->translate('error_updating'));
    }
	
}

function reload_user_session($data) {

    $_SESSION['user_firstname'] = $data['user_firstname'];
    $_SESSION['user_lastname'] = $data['user_lastname'];
    $_SESSION['user_email'] = $data['user_email'];
	$_SESSION['user_date_format'] = $data['user_date_format'];
    $_SESSION['user_date_format_nice'] = $data['user_date_format_nice'];
    $_SESSION['user_language'] = $data['user_language'];

}

/**
 * Logs a user into the application.
 *
 */
function do_login($data) {

    global $m_user;

    $user = $m_user->select_user_by_email($data['user_email']);

    // Set the session
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['user_firstname'] = $user['user_firstname'];
    $_SESSION['user_lastname'] = $user['user_lastname'];
    $_SESSION['user_email'] = $user['user_email'];
    $_SESSION['user_rights'] = $user['user_rights'];
    $_SESSION['user_date_format'] = $user['user_date_format'];
    $_SESSION['user_date_format_nice'] = $user['user_date_format_nice'];
    $_SESSION['user_language'] = $user['user_language'];
    $_SESSION['logged_in'] = 1;

    header ('Location: dashboard.php');

}

/**
 * Logs a user out of the application.
 *
 */
function do_logout() {

	$_SESSION = array();
	session_destroy();

    header ('Location: index.php');

}

function do_reset($data) {

    // TODO: Add code

}