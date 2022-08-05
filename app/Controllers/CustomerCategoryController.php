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
        $customerCategory = CustomerCategory::find(json_decode($request['params'])->id);

        echo json_encode($customerCategory);
    }

    static public function store($request)
    {
        $customerCategory = new CustomerCategory($request['data']);

        $res = $customerCategory->create();

        echo json_encode([
            'status' => $res
        ]);
    }

    static public function update($request)
    {
        $id = json_decode($request['params'])->id;

        $customerCategory = CustomerCategory::find($id);

        $customerCategory->mergeAttributes($request['data']);

        $res = $customerCategory->update();

        echo json_encode([
            'status' => $res
        ]);
    }

    static public function delete($request)
    {
        $id = json_decode($request['params'])->id;

        $customerCategory = CustomerCategory::find($id);

        $res = $customerCategory->delete();

        echo json_encode([
            'status' => $res
        ]);
    }
}
