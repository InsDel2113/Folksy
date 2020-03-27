<?php
class auth {
    public static $maximum_username_length = 15;
    public static $minimum_username_length = 3;
    public static $maximum_password_length = 64;
    public static $minimum_password_length = 3;
    public static $force_alphanumeric_username = true;
    
    public function register($username, $password) {
        global $db;
        if (strlen($username) < self::$minimum_username_length) {
            return 'username_tooshort';
        } elseif (strlen($password) < self::$minimum_password_length) {
            return 'password_tooshort';
        } elseif ( strlen($password) > self::$maximum_password_length ) {
            return 'password_toolong';
        } elseif (strlen($username) > self::$maximum_username_length) {
            return 'username_toolong';
        } elseif ( self::$force_alphanumeric_username && !preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $username)) {
            return 'username_notalphanumeric';
        }
        $uuid = (int)substr(preg_replace('/[^0-9]/', '', md5(uniqid())), 5, 16);
        $register_query = $db->query('INSERT INTO users (userid,username,password,ip,user_agent) VALUES (?,?,?,?,?)', $uuid, $username, password_hash($password, PASSWORD_DEFAULT), $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
		return 'register_success';
    }
    public function login($username, $password) {
        global $db;
		global $logging;
        $account_exists = $db->query('SELECT username, password FROM users WHERE username = ?', $username);
        if ($account_exists->num_rows() == 0) {
            return 'account_doesnotexist';
        }
        $user_info = $db->query('SELECT * FROM users WHERE username = ?', $username)->fetch_array();
        if (!password_verify($password, $user_info['password'])) {
			$u_ip = $_SERVER['REMOTE_ADDR'];
			$logging->add_log("user failed to login to $username, incorrect password, user ip $u_ip");
            return 'account_passwordincorrect';
        }
        $_SESSION['userid'] = $user_info['userid'];
        $_SESSION['username'] = $user_info['username'];
        $_SESSION['password'] = $user_info['password'];
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['loggedin'] = true;
		return 'login_success';
    }
}