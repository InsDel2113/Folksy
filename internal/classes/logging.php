<?php

class logging 
{
// expand with ids, delete_log, etc, later
public function add_log($input) {
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $input = " ['" . $input . "'] - " . "user ip: $user_ip - " . "time: " . date('m/d/Y h:i:s a', time());
    $log_file = file_put_contents(getcwd() . '/internal/logs/logs.txt', $input.PHP_EOL , FILE_APPEND | LOCK_EX);
}

}