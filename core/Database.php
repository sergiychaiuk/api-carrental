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

    public function create(): bool
    {
        $attributes = $this->sanitizedAttributes();

        $sql = "insert into " . static::$table_name . " (";
        $sql .= join(', ', array_keys($attributes));
        $sql .= ") values ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";

        $result = self::$database->query($sql);

        if ($result) {
            $this->id = self::$database->insert_id;
        }

        return $result;
    }

    public function update()
    {
        $attributes = $this->sanitizedAttributes();
        $attribute_pairs = [];

        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $sql = "update " . static::$table_name . " set ";
        $sql .= join(', ', $attribute_pairs);
        $sql .= "where id = '" . self::$database->escape_string($this->id) . "' ";
        $sql .= "limit 1";

        return self::$database->query($sql);
    }

    public function delete()
    {
        $sql = "delete from " . static::$table_name . " ";
        $sql .= "where id = '" . self::$database->escape_string($this->id) . "' ";
        $sql .= "limit 1";

        return self::$database->query($sql);
    }

    public function attributes(): array
    {
        $attributes = [];

        foreach (static::$db_columns as $column) {
            if ($column == 'id') { continue; }
            $attributes[$column] = $this->$column;
        }

        return $attributes;
    }

    protected function sanitizedAttributes(): array
    {
        $sanitized = [];

        foreach ($this->attributes() as $key => $value) {
            $sanitized[$key] = self::$database->escape_string($value);
        }

        return $sanitized;
    }

    public function mergeAttributes($args = []) {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
