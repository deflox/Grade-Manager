<?php

class User {

    /**
     * Selects a user from database with email.
     *
     * @param $email: E mail, you want to search.
     * @return array: Selected user.
     */
    public function select_user_by_email($email) {

        global $db;

        $db->where ("user_email", $email);
        return $db->getOne ("users");

    }


    /**
     * Checks password from existing user.
     *
     * @param $email:    Email from user.
     * @param $password: Entered password.
     * @return bool:     True if correct if incorrect.
     */
    public function check_user_password($email, $password) {

        $user = $this->select_user_by_email($email);
        return password_verify($password, $user['user_password']);

    }
	
	public function update_user_info ($data) {

        global $db;

		$updatedata = array (
			'user_firstname' => $data['user_firstname'],
			'user_lastname' => $data['user_lastname'],
			'user_email' => $data['user_email'],
			'user_date_format' => $data['user_date_format'],
			'user_date_format_nice' => $data['user_date_format_nice'],
			'user_language' => $data['user_language']
		);
		
		$db->where ('user_id', $_SESSION['user_id']);
		return $db->update ('users', $updatedata);
	
	}
	
	public function update_user_password ($data) {

		global $db;

		$updatedata = array (
			'user_password' => $data['user_new_passwor']
		);
		
		$db->where ('user_id', $_SESSION['user_id']);
		return $db->update ('users', $updatedata);
	
	}

}