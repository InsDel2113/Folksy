<?php
class auth {
    public function register($username, $password) {
        global $db;
        global $config;
        if (strlen($username) < $config['minimum_username_length'] ) {
            return 'username_tooshort';
        } elseif (strlen($password) < $config['minimum_password_length'] ) {
            return 'password_tooshort';
        } elseif ( strlen($password) > $config['maximum_password_length'] ) {
            return 'password_toolong';
        } elseif (strlen($username) > $config['maximum_username_length']) {
            return 'username_toolong';
        } elseif ( $config['force_alphanumeric_username'] && !preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $username)) {
            return 'username_notalphanumeric';
        } // i wont do check_ style thing here, would overcomplicate it all

        $uuid = (int)substr(preg_replace('/[^0-9]/', '', md5(uniqid())), 5, 16);
        $register_query = $db->query('INSERT INTO users (userid,username,password,ip,user_agent) VALUES (?,?,?,?,?)', $uuid, $username, password_hash($password, PASSWORD_DEFAULT), $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
		return 'register_success';
    }

    public function login($username, $password) {
        global $db;
        global $logging;
        // fuck globals
        $check_userexists_passed = false;
        $check_username_passed = false;
        $check_password_passed = false;
        $check_useragent_passed = false;
        $check_ip_passed = false;
        // could make into a array
        $user_info = $db->query("SELECT userid, username, password, ip, user_agent FROM users WHERE username=?", $username)->fetch_array();
        if ( sizeof($user_info) >= 1 ) { // 1 is a broad statement, but i'm saving a query by not doing them seperately
         $check_userexists_passed = true;
        }
        if ( !$check_userexists_passed ) { return 'login_fail'; }
        if ( $username = $user_info['username'] ) {
            $check_username_passed = true;
        }
        if ( password_verify($password, $user_info['password'])) {
            $check_password_passed = true;    
        }
        if ( $_SERVER['HTTP_USER_AGENT'] == $user_info['user_agent'] ) {
            $check_useragent_passed = true;
        }
        if ( $_SERVER['REMOTE_ADDR'] == $user_info['ip'] ) {
            $check_ip_passed = true;
        }
        
        if ( !$check_ip_passed ) {
            $logging->add_log("user ip did not match, username: $username");
        }
        if ( !$check_useragent_passed ) {
            $logging->add_log("user agent did not match, username: $username");
        }
        if ( !$check_password_passed ) {
            $logging->add_log("invalid password entered, logged");
        }

        if ( $check_username_passed && $check_password_passed ) {
            $_SESSION['userid'] = $user_info['userid'];
            $_SESSION['username'] = $user_info['username'];
            $_SESSION['password'] = $user_info['password'];
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['loggedin'] = true;
            return 'login_success';
        }
        return 'login_fail';
    }
}