<?php

namespace App\Models;

use Core\Database;

class CarType extends Database
{
    static protected $table_name = "cartype";

    static protected $db_columns = [
        'id',
        'name'
    ];

    public $id;
    public $name;

    public function __construct($args = []) {
        $this->name =  $args['name'] ?? '';
    }
}
