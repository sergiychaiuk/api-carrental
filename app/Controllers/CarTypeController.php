<?php

namespace App\Controllers;

use App\Models\CarType;

class CarTypeController
{
    static public function index()
    {
        echo json_encode(CarType::all());
    }

    static public function show($request)
    {
        $carType = CarType::find(json_decode($request['params'])->id);

        echo json_encode($carType);
    }
}
