<?php

// Check if request is an AJAX Request.
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    die();
}

require_once (dirname(dirname( __FILE__ )) . '/load.php');

$grades = get_grades_for_subject($_POST['subject_id']);

foreach ($grades as $grade) {

    if ( !delete_grade($grade['grade_id']) )
        die ('error');

}

if ( delete_subject($_POST['subject_id']) )
    die ('1');
else
    die ('error');
