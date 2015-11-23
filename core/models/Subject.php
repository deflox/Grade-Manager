<?php

class Subject {

    /**
     * Selects all subject, which belongs to one user.
     *
     * @param $user_id: User id from current logged in user.
     * @return array:   Selected subjects.
     */
    public function select_subjects_for_semester($semester_id) {

        global $db;

        $db->where ("semester_id", $semester_id);
        return $db->get ("subjects");

    }

    public function select_counting_subjects_for_semester ($semester_id) {

        global $db;

        $db->where ("semester_id", $semester_id);
        $db->where ("subject_counts_to_average", 1);
        return $db->get ("subjects");

    }

    public function get_subject_name_by_id ($subject_id) {

        global $db;

        $db->where ("subject_id", $subject_id);
        return $db->getONe("subjects", "subject_name");

    }

    public function insert_subject ($data) {

        global $db;

        $insert_data = array (
            'user_id' => $_SESSION['user_id'],
            'semester_id' => $data['semester_id'],
            'subject_name' => $data['subject_name'],
            'subject_counting' => $data['subject_counting'],
            'subject_counts_to_average' => $data['subject_counts_to_average']
        );

        return ( $db->insert('subjects', $insert_data) );

    }

    public function delete_subject ($subject_id) {

        global $db;

        $db->where('subject_id', $subject_id);
        return $db->delete('subjects');

    }
	
	public function select_subject_with_user_and_subject_id ($user_id, $subject_id) {
	
		global $db;
		
		$db->where('user_id', $user_id);
		$db->where('subject_id', $subject_id);
		return $db->getOne ('subjects');
	
	}

}