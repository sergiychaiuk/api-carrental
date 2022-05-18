<?php

namespace App\Controllers;

use App\Models\CarCategory;

class CarCategoryController
{
    static public function index()
    {
        echo json_encode(CarCategory::all());
    }

    static public function show($request)
    {
        $carType = CarCategory::find(json_decode($request['params'])->id);

        echo json_encode($carType);
    }
}
