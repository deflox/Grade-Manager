<?php

/**
 * Loads all required resources and initiate all required classes.
 */

$root_dir = dirname(dirname(__FILE__));

// Load config
require_once ($root_dir . '/includes/config/config.php');

// Load external libraries
require_once ($root_dir . '/includes/lib/MySql_db.php');
require_once ($root_dir . '/includes/lib/Carbon.php');

$db = new MysqliDb (DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT, DB_COLL);

// Load Language Support
require_once ($root_dir . '/language/Language.php');

$lang = new Language(USER_LANG);

// Load helpers
require_once ($root_dir . '/core/helpers/Messages.php');

$msg = new Messages();

// Load models
require_once ($root_dir . '/core/models/User.php');
require_once ($root_dir . '/core/models/Grade.php');
require_once ($root_dir . '/core/models/Subject.php');
require_once ($root_dir . '/core/models/Semester.php');
require_once ($root_dir . '/core/models/Option.php');

$m_user     = new User();
$m_grade    = new Grade();
$m_subject  = new Subject();
$m_semester = new Semester();
$_option    = new OPtion();

// Load functions
require_once ($root_dir . '/core/functions.php');
require_once ($root_dir . '/core/functions-auth.php');
require_once ($root_dir . '/core/functions-validation.php');
require_once ($root_dir . '/core/functions-semester.php');
require_once ($root_dir . '/core/functions-subject.php');
require_once ($root_dir . '/core/functions-grade.php');
