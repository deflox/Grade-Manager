<?php

class Option {

    public function get_option ($option_name) {

        global $db;

        $db->where ("option_name", $option_name);
        return $db->get ("options");

    }

}