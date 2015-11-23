<?php

/**
 * Helper class for translation into different languages.
 * 
 * @author: Leo
 */
class Language {

	private $lang;
	
	/**
	 * Initiates the language class and sets the file.
	 * 
	 * @param $user_language: Language, you want to use, e.g. en_US
     */	 
	function __construct ($user_language) {

		$file = 'languages/' . $user_language . '.ini';
		$this->lang = parse_ini_file($file);
		
	}

	/**
	 * Translates an given text into specified language. String must
	 * exist in translation file.
	 * 
	 * @param $text: The text, you want to translate.
	 */
	public function translate ($text) {

		if ( isset($this->lang[$text]) ) 
			return $this->lang[$text];
		else 
			die ('Could not find specified language for string "'.$text.'" in language file. Please provide an existing language translation');
	
	}

}