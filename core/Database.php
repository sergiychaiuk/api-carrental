<?php

namespace Core;

use mysqli;

class Database
{
    static protected $database;

    static public function connect()
    {
        $config = require_once 'config/database.php';

        $connection =  new mysqli(
            $config['hostname'],
            $config['username'],
            $config['password'],
            $config['database']
        );

        self::confirmConnect($connection);
        self::$database = $connection;
    }

    static protected function confirmConnect($connection)
    {
        if ($connection->connect_errno) {
            $msg = 'Database connection failed: ';
            $msg .= $connection->connect_error;
            $msg .= ' (' . $connection->connect_errno . ')';
            exit($msg);
        }
    }

    static public function disconnect()
    {
        if (isset(self::$database)) {
            self::$database->close();
        }
    }
}
