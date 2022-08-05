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

    static public function store($request)
    {
        $carCategory = new CarCategory($request['data']);

        $res = $carCategory->create();

        echo json_encode([
            'status' => $res
        ]);
    }

    static public function update($request)
    {
        $id = json_decode($request['params'])->id;

        $carCategory = CarCategory::find($id);

        $carCategory->mergeAttributes($request['data']);

        $res = $carCategory->update();

        echo json_encode([
            'status' => $res
        ]);
    }

    static public function delete($request)
    {
        $id = json_decode($request['params'])->id;

        $carCategory = CarCategory::find($id);

        $res = $carCategory->delete();

        echo json_encode([
            'status' => $res
        ]);
    }
}
