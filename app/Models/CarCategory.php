<?php

namespace App\Models;

use Core\Database;

class CarCategory extends Database
{
    static protected $table_name = "carcategory";

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
