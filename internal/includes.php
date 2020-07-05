<?php
ini_set("log_errors", 1);
ini_set("error_log", ''.$_SERVER["DOCUMENT_ROOT"].'/internal/logs/php_errors.txt');
// log errors to this file
// todo: fix hardcoded

// initialize config file
$config = parse_ini_file("config.ini.php");
// for class based stuff, make a special section for it


if (session_status() == PHP_SESSION_NONE) { // start the session
    session_start();
}

// require all required files here
require_once 'classes/db.php'; // database/mysqli handler
require_once 'classes/logging.php'; // logger
require_once 'classes/auth.php';
require_once 'classes/user.php';
require_once 'classes/misc.php';
require_once 'libraries/vendor/autoload.php'; // include libraries


if ( $config['auto_sanitize_input'] ) {
    function sanitize_ins(&$item)
    {
        $item = strip_tags($item);
    }
    array_walk($_POST, sanitize_ins);
    array_walk($_GET, sanitize_ins);
}

if ( $config['whoops'] ) {
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
}

if ( $config['csrfmagic'] ) {
    require_once 'libraries/CSRFMagic/Csrf.php';
}

// class initialization
$db     = new db($config['dbhost'], $config['dbuser'], $config['dbpass'], $config['dbname']); // init db class
$logging = new logging(); // init logging class
$templater = new League\Plates\Engine(''.$_SERVER["DOCUMENT_ROOT"].'/internal/templates');
$auth = new auth();
$user = new user();
$misc = new misc();

$user->init_user(); // initilalize all user related variables

$templater->addData(['user_loggedin' => $user->loggedin, 'user_username' => $user->username, 'user_userid' => $user->userid]);
// pass in any global vars you want the templates to access
// sanitize them here, and the templater also has the ability to escape things

?> 
