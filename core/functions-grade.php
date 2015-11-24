<?php

function get_grades_for_subject($subject_id) {

    global $m_grade;

    return $m_grade->select_grades_for_subject($subject_id);

}

function get_average_grade ($grades) {

    $all_grades = array();

    foreach ($grades as $grade) {

        array_push($all_grades, array( $grade['grade_value'], $grade['grade_counting']) );

    }

    return calculate_average($all_grades);

}

function insert_grade ($data) {

    global $m_grade, $lang;

    if ( !empty($data['grade_date']) )
        $data['grade_date'] = get_timestamp($data['grade_date']);

    if ( $m_grade->insert_grade($data) ) {
        set_message( sprintf( $lang->translate('success_add_item'), 'grade', $data['grade_name'] ) , 'success' );
        header ('Location: dashboard.php?semester=' . $data['semester_id'] . '&subject=' . $data['subject_id']);
    } else {
        set_message( sprintf( $lang->translate('error_insert'), 'semester' ) );
    }

}

function update_grade ($data) {

    global $m_grade, $lang;

    if ( !empty($data['grade_date']) )
        $data['grade_date'] = get_timestamp($data['grade_date']);

    if ( $m_grade->update_grade($data) ) {
        set_message( $lang->translate('success_saving'), 'success' );

        header ('Location: dashboard.php?semester=' . $data['semester_id'] . '&subject=' . $data['subject_id'] );
    } else {
        set_message( $lang->translate('error_updating') );
    }

}

function delete_grade($grade_id) {

    global $m_grade;

    return $m_grade->delete_grade($grade_id);

}

function get_grade_by_id ($grade_id) {

    global $m_grade;

    return $m_grade->select_grade_by_id($grade_id);

}