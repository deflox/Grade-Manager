<?php

class Hash {

    private $hashFunctionsAvailable = false;

    function __construct() {
        if (function_exists('password_hash')) {
            $this->hashFunctionsAvailable = true;
        } else {
            $this->hashFunctionsAvailable = false;
        }
    }

    /**
     * Produces a hash from the clear text password.
     *
     * @param $password    Password in clear text.
     * @return string      Hashed password.
     */
    public function getHash($password) {
        if($this->hashFunctionsAvailable) {
            return password_hash($password, PASSWORD_DEFAULT);
        } else {
            return crypt($password, '$2y$10$' . $this->create_salt() .'$');
        }
    }

    /**
     * Checks a password against a hashes password.
     *
     * @param $password Password in clear text.
     * @param $hash     Hashed password.
     * @return bool     If true, verifying was sucessful.
     */
    public function checkPassword($password, $hash) {
        if($this->hashFunctionsAvailable) {
            return password_verify($password, $hash);
        } else {
            return ($hash==crypt($password, $hash));
        }
    }

    /**
     * Checks if hash needs to be rehashed.
     *
     * @param $hash The hash, which you want to check.
     * @return bool If true, password needs rehash.
     */
    public function checkRehash($hash) {
        if($this->hashFunctionsAvailable) {
            return password_needs_rehash($hash, PASSWORD_DEFAULT);
        } else {
            return ('$2y$10$' != substr($hash, 0, 7) );
        }
    }

    public function create_salt($l=22, $allowed='1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ./') {
        $salt = '';
        for ($i = 0; $i < $l; $i++) {
            $salt .= $allowed{rand(0, strlen($allowed) - 1)};
        }
    }

}