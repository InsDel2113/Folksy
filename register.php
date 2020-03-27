<?php
// front page
include 'internal/includes.php';

$message = NULL;
if ( $misc->has_posted_nonvar() && $misc->has_posted($_POST['username']) && $misc->has_posted($_POST['password']) ) {
    $message = $auth->register($_POST['username'], $_POST['password']);
}
echo $templater->render('register', ['msg' => $message]);
?>