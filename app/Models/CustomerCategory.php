<?php

namespace App\Models;

use Core\Database;

class CustomerCategory extends Database
{
    static protected $table_name = "customercategory";

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
