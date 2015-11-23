<?php

class Messages {

    private $message_error = '';

    public function get_error_message() {

        if ( !empty($this->message_error) )
            echo '<div class="alert alert-danger">' . $this->message_error . '</div>';
        else
            echo '';

    }

    public function get_success_message() {

        if ( !empty($_SESSION['success_message']) ) {
            echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
            unset ($_SESSION['success_message']);
        } else {
            echo '';
        }

    }

    public function set_error_message($msg) {

        $this->message_error .= $msg;

    }

    public function set_success_message($msg) {

        if ( empty($_SESSION['success_message']) ) {

            $_SESSION['success_message'] = $msg;

        } else {

            unset ($_SESSION['success_message']);
            $_SESSION['success_message'] = $msg;

        }

    }


}