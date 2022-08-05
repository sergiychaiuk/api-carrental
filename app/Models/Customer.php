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
        'patronymic',
        'idCustomerCategory',
        'phone'
    ];

    public $id;
    public $name;
    public $surname;
    public $patronymic;
    public $idCustomerCategory;
    public $phone;

    public function __construct($args = []) {
        $this->name =  $args['name'] ?? '';
        $this->surname =  $args['surname'] ?? '';
        $this->patronymic =  $args['patronymic'] ?? '';
        $this->idCustomerCategory =  $args['idCustomerCategory'] ?? '';
        $this->phone =  $args['phone'] ?? '';
    }

    public function customerCategory()
    {
        return CustomerCategory::find($this->idCustomerCategory);
    }
}
