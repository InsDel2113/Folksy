<?php
ini_set("log_errors", 1);
ini_set("error_log", ''.$_SERVER["DOCUMENT_ROOT"].'/internal/logs/php_errors.txt');
// log errors to this file
// todo: fix hardcoded

// general configuration variables
$auto_sanitize_input = false; // Auto sanitize all GET/POST input, not recommended
$use_whoops = true; // use Whoops! Error handler
$use_csrfmagic = true; // use CSRFMagic for automatic CSRF handling
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'folksy_framework';
// for class based stuff, make it a public var in the class itself


if (session_status() == PHP_SESSION_NONE) { // start the session
    session_start();
}

// require all required files here
require_once 'libraries/vendor/autoload.php'; // include libraries
require_once 'classes/db.php'; // database/mysqli handler
require_once 'classes/logging.php'; // logger
require_once 'classes/auth.php';
require_once 'classes/user.php';
require_once 'classes/misc.php';

if ( $auto_sanitize_input ) {
    function sanitize_ins(&$item)
    {
        $item = strip_tags($item);
    }
    array_walk($_POST, sanitize_ins);
    array_walk($_GET, sanitize_ins);
}

if ( $use_whoops ) {
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
}

if ( $use_csrfmagic ) {
    require_once 'libraries/CSRFMagic/Csrf.php';
}

// class initialization
$db     = new db($dbhost, $dbuser, $dbpass, $dbname); // init db class
$logging = new logging(); // init logging class
$templater = new League\Plates\Engine(''.$_SERVER["DOCUMENT_ROOT"].'/internal/templates');
$auth = new auth();
$user = new user();
$misc = new misc();

$user->init_user(); // initilalize all user related variables

?> 
