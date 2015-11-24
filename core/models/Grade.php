<?php

class Grade {

    /**
     * Selects all grades, which are belonging to the given subject.
     *
     * @param $subject_id: Subject, you want to use.
     * @return array:      Selected grades.
     */
    public function select_grades_for_subject($subject_id) {

        global $db;

        $db->where ("subject_id", $subject_id);
        return $db->get ("grades");

    }

    public function insert_grade ($data) {

        global $db;

        $insert_data = array (
            'user_id' => $_SESSION['user_id'],
            'subject_id' => $data['subject_id'],
            'grade_value' => $data['grade_value'],
            'grade_counting' => $data['grade_counting'],
            'grade_date' => $data['grade_date'],
            'grade_name' => $data['grade_name'],
            'grade_description' => $data['grade_description']
        );

        return ( $db->insert('grades', $insert_data) );

    }

    public function update_grade ($data) {

        global $db;

        $update_data = array (
            'grade_value' => $data['grade_value'],
            'grade_counting' => $data['grade_counting'],
            'grade_date' => $data['grade_date'],
            'grade_name' => $data['grade_name'],
            'grade_description' => $data['grade_description']
        );

        return $db->update('grades', $update_data);

    }

    public function delete_grade ($grade_id) {

        global $db;

        $db->where('grade_id', $grade_id);
        return $db->delete('grades');

    }

    public function select_grade_by_id ($grade_id) {

        global $db;

        $db->where('grade_id', $grade_id);
        return $db->getOne('grades');

    }

	public function select_grade_with_user_and_grade_id ($user_id, $grade_id) {
	
		global $db;
		
		$db->where('user_id', $user_id);
		$db->where('grade_id', $grade_id);
		return $db->getOne ('grades');
	
	}

}