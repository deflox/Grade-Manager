<?php

class Semester {

    private $table_name = 'semesters';

	// TODO: Change get -> select for better understanding
	
    public function get_semester_for_user() {

        global $db;

        $db->where ("user_id", $_SESSION['user_id']);
        return $db->get ("semesters");

    }

    public function get_semester_name_by_id ($semester_id) {

        global $db;

        $db->where ("semester_id", $semester_id);
        return $db->getOne ("semesters", "semester_name");

    }

    public function insert_semester ($data) {

        global $db;

        $insert_data = array (
            'user_id' => $_SESSION['user_id'],
            'semester_name' => $data['semester_name']
        );

        return ( $db->insert('semesters', $insert_data) );

    }

    public function delete_semester ($semester_id) {

        global $db;

        $db->where('semester_id', $semester_id);
        return $db->delete('semesters');

    }
	
	public function select_semester_with_user_and_semester_id ($user_id, $semester_id) {
		
		global $db;
		
		$db->where('user_id', $user_id);
		$db->where('semester_id', $semester_id);
		return $db->getOne ('semesters');
		
	}

}