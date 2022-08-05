<?php

namespace App\Models;

use Core\Database;

class Car extends Database
{
    static protected $table_name = "car";

    static protected $db_columns = [
        'id',
        'brand',
        'idCarType',
        'graduationYear',
        'idCarCategory',
        'photo',
        'price'
    ];

    public $id;
    public $brand;
    public $idCarType;
    public $graduationYear;
    public $idCarCategory;
    public $photo;
    public $price;

    public function __construct($args = []) {
        $this->brand =  $args['brand'] ?? '';
        $this->idCarType =  $args['idCarType'] ?? '';
        $this->graduationYear =  $args['graduationYear'] ?? '';
        $this->idCarCategory =  $args['idCarCategory'] ?? '';
        $this->photo =  $args['photo'] ?? '';
        $this->price =  $args['price'] ?? '';
    }

    public function carType()
    {
        return CarType::find($this->idCarType);
    }

    public function carCategory()
    {
        return CarCategory::find($this->idCarCategory);
    }

    public function reservation()
    {
        $sql = "select * from reservation ";
        $sql .= "where idCar = '" . self::$database->escape_string($this->id) . "'";

        $result = self::$database->query($sql);

        if (!$result) {
            exit("Database query failed.");
        }

        $object_array = [];

        while ($record = $result->fetch_assoc()) {
            $object_array[] = Reservation::instantiate($record);
        }

        $result->free();

        return $object_array;
    }
}
