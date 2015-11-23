<?php

// Check if request is an AJAX Request.
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    die();
}

require_once (dirname(dirname( __FILE__ )) . '/load.php');

$subjects = get_subjects_for_semester($_POST['semester_id']);

if ($subjects != null) {

    foreach ($subjects as $subject) {

        $grades = get_grades_for_subject($subject['subject_id']);

        if ($grades != null) {

            foreach ($grades as $grade) {

                if ( !delete_grade($grade['grade_id']) )
                    die ('error');

            }

        }

        if ( !delete_subject($subject['subject_id']) )
            die ('error');

    }

}

if ( delete_semester($_POST['semester_id']) )
    die ('1');
else
    die ('error');