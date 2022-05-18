<?php

namespace App\Models;

use Core\Database;

class Customer extends Database
{
    static protected $table_name = "customer";

    static protected $db_columns = [
        'id',
        'name',
        'surname',
        'idCustomerCategory'
    ];

    public $id;
    public $name;
    public $surname;
    public $idCustomerCategory;

    public function __construct($args = []) {
        $this->name =  $args['name'] ?? '';
        $this->surname =  $args['surname'] ?? '';
        $this->idCustomerCategory =  $args['idCustomerCategory'] ?? '';
    }

    public function customerCategory()
    {
        return CustomerCategory::find($this->idCustomerCategory);
    }
}
