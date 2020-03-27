<?php
class user {
    public $userid;
    public $username;
    public $password;
    public $power;
    public $ip;
    public $banned;
    public $loggedin;
    public function init_user() {
        global $db;
        $this->userid = 0;
        $this->username = NULL;
        $this->password = NULL;
        $this->loggedin = false;
        $this->ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SESSION['loggedin'])) {
            $this->userid = $_SESSION['userid'];
            $this->username = $_SESSION['username'];
            $this->password = $_SESSION['password'];
            $this->loggedin = true;
            $this->ip = $_SESSION['ip'];
        }
    }

    public function id_to_username($id) { 
        // takes id as input, outputs username
		global $db;
        $query = $db->query('SELECT username FROM users WHERE userid = ?', $id)->fetch_array();
        if (count($query) === 0) {
            return 'not_found';
        }
        return $query['username'];
    }
	public function username_to_id($uname) { 
        // takes username as input, outputs id aka vice versa of the function above
		global $db;
        $query = $db->query('SELECT userid FROM users WHERE username = ?', $uname)->fetch_array();
        if (count($query) === 0) {
            return 'not_found';
        }
        return $query['userid'];
    }
}
?>