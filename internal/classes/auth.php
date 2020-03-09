<?php

class auth {
    public $maximum_username_length = 11;
    public $minimum_username_length = 3;
    public $min_password_length = 5;
    public $max_password_length = 1024; // completely fair max length
public function register($username, $password, $pin_code = NULL) {
 global $db;

 if ( $username < $minimum_username_length ) {
     return 'username_too_short';
 }
 if ( $username > $maximum_username_length ) {
    return 'username_too_long';
 }
 if ( $password < $min_password_length ) {
 return 'password_too_short';
 }
 if ( $password > $maximum_username_length ) {
     return 'password_too_long';
 }

 $password = password_hash($password, PASSWORD_DEFAULT);
 $user_ip = $_SERVER['REMOTE_ADDR'];
 $user_agent = $_SERVER['HTTP_USER_AGENT'];
 $db->query("INSERT INTO users (username, password, ip, pin_code, user_agent, user_id) VALUES (?, ?, ?, ?, ?, ?)", $username, $password, $user_ip, $pin_code, $user_agent, 1);
 return 'success'; 
}

}

?>