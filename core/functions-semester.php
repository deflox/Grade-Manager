<?php

function get_semesters_for_user () {

    global $m_semester, $m_subject, $m_grade;

    // Get all semesters for the current logged in user
    $semesters = $m_semester->get_semester_for_user();

    // Check if there are semesters available
    if ( $semesters != null ) {

        // If yes, go through every semester
        foreach ($semesters as &$semester) {

            // Get all subject for the current semester
            $subjects = $m_subject->select_counting_subjects_for_semester( $semester['semester_id'] );

            // Check if there are subjects available
            if ( $subjects != null ) {

                // Array should contain all averages of all semesters
                $all_subjects_grades = array();

                // If yes, go through every subjects
                foreach ($subjects as $subject) {

                    // Get all grades for the current subject
                    $grades = $m_grade->select_grades_for_subject($subject['subject_id']);

                    // Check if there are grades available
                    if ($grades != null) {

                        // Array should contain average grade for current subject
                        $all_grades = array();

                        // Get all grades values and put them into the array
                        foreach ($grades as $grade) {

                            array_push($all_grades, array($grade['grade_value'], $grade['grade_counting']));

                        }

                        // Calculate average for all grades in this subject and add it to array with all averages of all subjects
                        array_push( $all_subjects_grades, array( calculate_average($all_grades), $subject['subject_counting'] ) );

                    } else {

                        // If there were no subjects found, add 0.00 to the array with all averages of all subjects
                        array_push( $all_subjects_grades, array( 0.00, $subject['subject_counting'] ) );

                    }

                }

                // Finally get the average of all subjects for one semester and put it in the array with semesters
                $semester['semester_average'] = calculate_average($all_subjects_grades);

            } else {

                // If there are no subject, average is 0.00
                $semester['semester_average'] = '0.00';

            }

        }

        return $semesters;

    } else {

        // If there aren't even any semesters available, return null
        return null;

    }

}

function get_semester_by_id ($semester_id) {

    global $m_semester;
    
    return $m_semester->select_semester_by_id($semester_id);

}

function get_current_semester_name ($semester_id) {

    global $m_semester;

    return $m_semester->get_semester_name_by_id($semester_id)['semester_name'];

}

function insert_semester ($data) {

    global $m_semester, $lang;

    if ( $m_semester->insert_semester($data) ) {
        set_message( sprintf( $lang->translate('success_add_item'), 'semester', $data['semester_name'] ) , 'success' );
        header ('Location: dashboard.php');
    } else {
        set_message( sprintf( $lang->translate('error_insert'), 'semester' ) );
    }

}

function update_semester ($data) {

    global $m_semester, $lang;

    if ( $m_semester->update_semester($data) ) {
        set_message( $lang->translate('success_saving') , 'success' );
        header ('Location: dashboard.php');
    } else {
        set_message( $lang->translate('error_updating') );
    }

}

function delete_semester ($semester_id) {

    global $m_semester;

    return $m_semester->delete_semester($semester_id);

}