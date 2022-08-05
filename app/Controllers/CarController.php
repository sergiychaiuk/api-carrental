<?php

namespace App\Controllers;

use App\Models\Car;
use Core\Uploader;

class CarController
{
    static public function index()
    {
        $cars = Car::all();

        array_map(function ($car) {
            $car->carType = $car->carType();
            $car->carCategory = $car->carCategory();
            $car->reservation = $car->reservation();
        }, $cars);

        echo json_encode($cars);
    }

    static public function show($request)
    {
        $car = Car::find(json_decode($request['params'])->id);

        $car->carType = $car->carType();
        $car->carCategory = $car->carCategory();
        $car->reservation = $car->reservation();

        echo json_encode($car);
    }

    static public function store($request)
    {
        $upload = new Uploader($request['file']['photo']);

        if ($upload->upload('images')) {
            $request['data']['photo'] = $upload->name;

            $car = new Car($request['data']);

            $res = $car->create();
        } else {
            $res = false;
        }

        echo json_encode([
            'status' => $res
        ]);
    }

    static public function update($request)
    {
        $id = json_decode($request['params'])->id;

        $car = Car::find($id);

        $request['data']['photo'] = $car->photo ;

        if (!empty($request['file']['photo'])) {
            $upload = new Uploader($request['file']['photo']);

            if (!$upload->upload('images')) {
                exit();
            }

            $request['data']['photo'] =  $upload->name;

            $delete = new Uploader($car->photo);

            $delete->delete('images');
        }

        $car->mergeAttributes($request['data']);

        $res = $car->update();

        echo json_encode([
            'status' => $res
        ]);
    }

    static public function delete($request)
    {
        $id = json_decode($request['params'])->id;

        $car = Car::find($id);

        $delete = new Uploader($car->photo);

        $delete->delete('images');

        $res = $car->delete();

        echo json_encode([
            'status' => $res
        ]);
    }
}
