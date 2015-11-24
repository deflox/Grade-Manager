<?php

/**
 * Contains all functions for processing.
 *
 * @author: Leo
 */

/**
 * Checks if post request has been submitted.
 *
 * @return bool
 */
function is_post_submitted() {
    return ($_SERVER['REQUEST_METHOD'] == 'POST');

}

/**
 * Returns values for current post request to keep values in input fields.
 *
 * @param $name:   Name of post value.
 * @return string: Value of post value.
 */
function get_post($name, $ext_item = null) {

	if ( $ext_item !== null && !isset($_POST[$name]) ) {
		return $ext_item;
	} else if ( isset($_POST[$name]) ) {
		return $_POST[$name];
	} else {
		return '';
	}	
	
}

/**
 * Sets a new error message.
 *
 * @param $name
 */
function set_err_msg($name) {

    global $msg, $lang;
    $msg->set_error_message($lang->translate($name));

}

function set_message ($message, $type = 'error') {

    global $msg;

    if ($type == 'success') {
        $msg->set_success_message($message);
    } else {
        $msg->set_error_message($message);
    }

}

/**
 *
 *
 * @param $grades
 * @return float
 */
function calculate_average ($grades) {

    if ( !all_grades_zero($grades) ) {

        $sum_counts = 0;
        $sum_grades = 0;

        for ($row = 0; $row < count($grades); $row++) {

            if ( $grades[$row][0] != 0 ) {
                $sum_grades = $sum_grades + ($grades[$row][0] * $grades[$row][1]);
                $sum_counts = $sum_counts + $grades[$row][1];
            }

        }

        return round($sum_grades / $sum_counts, 2);

    } else {

        return '0.00';

    }

}

function all_grades_zero ($grades) {

    $c = 0;

    for ($row = 0; $row < count($grades); $row++) {
        if ( $grades[$row][0] == 0 )
            $c++;
    }

    return (count($grades) == $c);

}

function get_drop_down ($elements, $post_name, $input_name, $class_name = 'form-control', $ext_item = null) {

    $html = '<label for="' . $post_name . '">' . $input_name . '</label>';
    $html .= '<select id="' . $post_name . '" class="' . $class_name . '" name="' . $post_name . '" >';



    if ( isset($_POST[$post_name]) ) {

        foreach ($elements as $key => $element) {

            if ( $key == $_POST[$post_name] )
                $html .= '<option value="' . $key . '" selected="selected">' . $element . '</option>';
            else
                $html .= '<option value="' . $key . '">' . $element . '</option>';

        }

    } else if ( $ext_item !== null && !isset($_POST[$post_name]) ) {

        foreach ($elements as $key => $element) {

            if ( $key == $ext_item )
                $html .= '<option value="' . $key . '" selected="selected">' . $element . '</option>';
            else
                $html .= '<option value="' . $key . '">' . $element . '</option>';

        }

    } else {

        foreach ($elements as $key => $element) {

            $html .= '<option value="' . $key . '">' . $element . '</option>';

        }

    }

    $html .= '</select>';

    return $html;

}

function get_dashboard_content ($params) {

    if ( isset($params['semester']) && count($params) == 1 ) {
        include_once (dirname(dirname( __FILE__ )) . '/includes/html/subjects/subject-list.php');
    } else if ( isset($params['semester']) && isset($params['subject']) && count($params) == 2 ) {
        include_once (dirname(dirname( __FILE__ )) . '/includes/html/grades/grade-list.php');
    } else if (empty($params)) {
        include_once (dirname(dirname( __FILE__ )) . '/includes/html/semesters/semester-list.php');
    } else {
        header ('Location: dashboard.php');
    }

}

function get_add_content ($params) {

    if ( isset($params['type'])  ) {

        if ( isset($params['type']) && $params['type'] == 'semester' && count($params) == 1 ) {
            include_once (dirname(dirname( __FILE__ )) . '/includes/html/semesters/add-semester.php');
        } else if ( isset($params['type']) && $params['type'] == 'subject' && isset($params['semester']) && count($params) == 2 ) {
            include_once (dirname(dirname( __FILE__ )) . '/includes/html/subjects/add-subject.php');
        } else if ( isset($params['type']) && $params['type'] == 'grade' && isset ($params['semester']) && isset($params['subject']) && count($params) == 3 ) {
            include_once (dirname(dirname( __FILE__ )) . '/includes/html/grades/add-grade.php');
        } else {
            header ('Location: dashboard.php');
        }

    } else {
        header ('Location: dashboard.php');
    }

}

function get_edit_content ($params) {

    if ( isset($params['type'])  ) {

        if ( isset($params['type']) && $params['type'] == 'semester' && isset($params['semester']) && count($params) == 2 ) {
            include_once (dirname(dirname( __FILE__ )) . '/includes/html/semesters/edit-semester.php');
        } else if ( isset($params['type']) && $params['type'] == 'subject' && isset($params['semester']) && isset($params['subject']) && count($params) == 3 ) {
            include_once (dirname(dirname( __FILE__ )) . '/includes/html/subjects/edit-subject.php');
        } else if ( isset($params['type']) && $params['type'] == 'grade' && isset ($params['semester']) && isset($params['subject']) && isset($params['grade']) && count($params) == 4 ) {
            include_once (dirname(dirname( __FILE__ )) . '/includes/html/grades/edit-grade.php');
        } else {
            header ('Location: dashboard.php');
        }

    } else {
        header ('Location: dashboard.php');
    }

}

function get_timestamp ( $date ) {

    return DateTime::createFromFormat($_SESSION['user_date_format'], $date)->getTimestamp();

}

function print_date ($timestamp) {

    if ( !empty($timestamp) )
        echo date ($_SESSION['user_date_format'], $timestamp);
    else
        echo '';

}

function get_date_formats () {

	return array (
	
		'Y-m-d' => 'yyyy-mm-dd', 
		'Y/m/d' => 'yyyy/mm/dd', 
		'Y.m.d' => 'yyyy.mm.dd', 
		'd-m-Y' => 'dd-mm-yyyy', 
		'd/m/Y' => 'dd/mm/yyyy', 
		'd.m.Y' => 'dd.mm.yyyy', 
		'm/d/Y' => 'mm/dd/yyyy'
		
	);

}

function get_param ($param_name) {

	return htmlspecialchars($_GET[$param_name], ENT_QUOTES, 'UTF-8');

}