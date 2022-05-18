<?php

namespace App\Controllers;

use App\Models\Car;

class CarController
{
    static public function index()
    {
        $cars = Car::all();

        array_map(function ($car) {
            $car->carType = $car->carType();
            $car->carCategory = $car->carCategory();
        }, $cars);

        echo json_encode($cars);
    }

    static public function show($request)
    {
        $car = Car::find(json_decode($request['params'])->id);

        $car->carType = $car->carType();
        $car->carCategory = $car->carCategory();

        echo json_encode($car);
    }
}
