<?php
// how to use this class:
/*
$account = $db->query('SELECT * FROM accounts WHERE username = ? AND password = ?', 'test', 'test')->fetch_array();
echo $account['name'];
gets specific record. everything after the query are just the params

$accounts = $db->query('SELECT * FROM accounts')->fetch_all();
foreach ($accounts as $account) {
echo $account['name'] . '<br>';
}
echos everything from a table

$accounts = $db->query('SELECT * FROM accounts');
echo $accounts->num_rows();
gets num of rows

$insert = $db->query('INSERT INTO accounts (username,password,email,name) VALUES (?,?,?,?)', 'test', 'test', 'test@gmail.com', 'Test');
echo $insert->affected_rows();
gets affected rows

 */
class db
{
    protected $connection;
    protected $query;
    public $query_count = 0;

    public function __construct($dbhost, $dbuser, $dbpass, $dbname, $charset = 'utf8')
    {
        $this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        if ($this->connection->connect_error) {
            die('Failed to connect to MySQL - ' . $this->connection->connect_error);
        }
        $this->connection->set_charset($charset);
    }

    public function query($query)
    {
        if ($this->query = $this->connection->prepare($query)) {
            if (func_num_args() > 1) {
                $x        = func_get_args();
                $args     = array_slice($x, 1);
                $types    = '';
                $args_ref = array();
                foreach ($args as $k => &$arg) {
                    if (is_array($args[$k])) {
                        foreach ($args[$k] as $j => &$a) {
                            $types .= $this->_gettype($args[$k][$j]);
                            $args_ref[] = &$a;
                        }
                    } else {
                        $types .= $this->_gettype($args[$k]);
                        $args_ref[] = &$arg;
                    }
                }
                array_unshift($args_ref, $types);
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
            }
            $this->query->execute();
            if ($this->query->errno) {
                die('Unable to process MySQL query (check your params) - ' . $this->query->error);
            }
            $this->query_count++;
        } else {
            die('Unable to prepare statement (check your syntax) - ' . $this->connection->error);
        }
        return $this;
    }

    public function fetch_all()
    {
        $params = array();
        $meta   = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            $result[] = $r;
        }
        $this->query->close();
        return $result;
    }

    public function fetch_array()
    {
        $params = array();
        $meta   = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            foreach ($row as $key => $val) {
                $result[$key] = $val;
            }
        }
        $this->query->close();
        return $result;
    }

    public function num_rows()
    {
        $this->query->store_result();
        return $this->query->num_rows;
    }

    public function close()
    {
        return $this->connection->close();
    }

    public function affected_rows()
    {
        return $this->query->affected_rows;
    }

    private function _gettype($var)
    {
        if (is_string($var)) {
            return 's';
        }

        if (is_float($var)) {
            return 'd';
        }

        if (is_int($var)) {
            return 'i';
        }

        return 'b';
    }
}
