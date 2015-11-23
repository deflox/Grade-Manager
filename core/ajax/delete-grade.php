<?php

// Check if request is an AJAX Request.
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    die();
}

require_once (dirname(dirname( __FILE__ )) . '/load.php');

if ( delete_grade( $_POST['grade_id'] ) )
    echo '1';
else
    echo 'error';