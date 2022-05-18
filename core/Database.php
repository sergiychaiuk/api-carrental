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

    static public function sql($sql)
    {
        $result = self::$database->query($sql);

        if (!$result) {
            exit("Database query failed.");
        }

        $object_array = [];

        while ($record = $result->fetch_assoc()) {
            $object_array[] = static::instantiate($record);
        }

        $result->free();

        return $object_array;
    }

    static public function all() {
        $sql = "select * from " . static::$table_name;
        return static::sql($sql);
    }

    static public function find($id) {
        $sql = "select * from " . static::$table_name . " ";
        $sql .= "where id = '" . self::$database->escape_string($id) . "'";

        $obj_array = static::sql($sql);

        if (!empty($obj_array)) {
            return array_shift($obj_array)  ;
        } else {
            return false;
        }
    }

    static protected function instantiate($record): Database
    {
        $object = new static;

        foreach ($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }

        return $object;
    }
}
