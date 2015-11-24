<?php

function get_subjects_for_semester($semester_id) {

    global $m_subject, $m_grade;

    $subjects = $m_subject->select_subjects_for_semester($semester_id);

    if ($subjects != null) {

        foreach ($subjects as &$subject) {

            $grades = $m_grade->select_grades_for_subject($subject['subject_id']);

            if ($grades != null) {

                $all_grades = array();

                foreach ($grades as $grade) {

                    array_push($all_grades, array($grade['grade_value'], $grade['grade_counting']));

                }

                $subject['subject_average'] = calculate_average($all_grades);

            } else {

                $subject['subject_average'] = '0.00';

            }

        }

        return $subjects;

    } else {

        return null;

    }

}

function get_subject_by_id ($subject_id) {

    global $m_subject;
    
    return $m_subject->select_subject_by_id ( $subject_id );

}

function insert_subject ($data) {

    global $m_subject, $lang;

    if ( $m_subject->insert_subject($data) ) {
        set_message( sprintf( $lang->translate('success_add_item'), 'subject', $data['subject_name'] ) , 'success' );
        header ('Location: dashboard.php?semester=' . $data['semester_id'] );
    } else {
        set_message( sprintf( $lang->translate('error_insert'), 'subject' ) );
    }

}

function get_subject_name ($subject_id) {

    global $m_subject;

    return $m_subject->get_subject_name_by_id($subject_id)['subject_name'];

}

function update_subject ($data) {

    global $m_subject, $lang;

    if ( $m_subject->update_subject($data) ) {
        set_message( $lang->translate('success_saving'), 'success' );
        header ('Location: dashboard.php?semester=' . $data['semester_id'] );
    } else {
        set_message( $lang->translate('error_updating') );
    }

}

function delete_subject ($subject_id) {

    global $m_subject;

    return $m_subject->delete_subject($subject_id);

}
