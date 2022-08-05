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

    static public function store($request)
    {
        $carType = new CarType($request['data']);

        $res = $carType->create();

        echo json_encode([
            'status' => $res
        ]);
    }

    static public function update($request)
    {
        $id = json_decode($request['params'])->id;

        $carType = CarType::find($id);

        $carType->mergeAttributes($request['data']);

        $res = $carType->update();

        echo json_encode([
            'status' => $res
        ]);
    }

    static public function delete($request)
    {
        $id = json_decode($request['params'])->id;

        $carType = CarType::find($id);

        $res = $carType->delete();

        echo json_encode([
            'status' => $res
        ]);
    }
}
