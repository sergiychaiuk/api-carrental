<?php

namespace App\Controllers;

use App\Models\CustomerCategory;

class CustomerCategoryController
{
    static public function index()
    {
        echo json_encode(CustomerCategory::all());
    }

    static public function show($request)
    {
        $carType = CustomerCategory::find(json_decode($request['params'])->id);

        echo json_encode($carType);
    }
}
