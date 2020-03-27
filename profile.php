<?php
include 'internal/includes.php';

$user_in = $_GET['username'];

$user_info = $db->query('SELECT * FROM users WHERE username = ?', $user_in)->fetch_array();
if ( count($user_info) === 0 ) {
	die("user not found");
}

// Render a template
echo $templater->render('templating_test', ['name' => $user_info['username']]);

?>