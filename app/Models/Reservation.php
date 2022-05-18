<?php

namespace App\Models;

use Core\Database;

class Reservation extends Database
{
    static protected $table_name = "reservation";

    static protected $db_columns = [
        'id',
        'idCar',
        'idCustomer',
        'datetimeReceiving',
        'datetimeReturn',
        'cost'
    ];

    public $id;
    public $idCar;
    public $idCustomer;
    public $datetimeReceiving;
    public $datetimeReturn;
    public $cost;

    public function __construct($args = []) {
        $this->idCar =  $args['idCar'] ?? '';
        $this->idCustomer =  $args['idCustomer'] ?? '';
        $this->datetimeReceiving =  $args['datetimeReceiving'] ?? '';
        $this->datetimeReturn =  $args['datetimeReturn'] ?? '';
        $this->cost =  $args['cost'] ?? '';
    }

    public function car()
    {
        $car = Car::find($this->idCar);

        $car->carType = $car->carType();
        $car->carCategory = $car->carCategory();

        return $car;
    }

    public function customer()
    {
        $customer = Customer::find($this->idCustomer);

        $customer->customerCategory = $customer->customerCategory();

        return $customer;
    }
}
