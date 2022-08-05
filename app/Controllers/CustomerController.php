<?php

namespace App\Controllers;

use App\Models\Customer;

class CustomerController
{
    static public function index()
    {
        $customers = Customer::all();

        array_map(function ($customer) {
            $customer->customerCategory = $customer->customerCategory();
        }, $customers);

        echo json_encode($customers);
    }

    static public function show($request)
    {
        $customer = Customer::find(json_decode($request['params'])->id);

        $customer->customerCategory = $customer->customerCategory();

        echo json_encode($customer);
    }

    static public function store($request)
    {
        $customer = new Customer($request['data']);

        $res = $customer->create();

        echo json_encode([
            'status' => $res
        ]);
    }

    static public function update($request)
    {
        $id = json_decode($request['params'])->id;

        $customer = Customer::find($id);

        $customer->mergeAttributes($request['data']);

        $res = $customer->update();

        echo json_encode([
            'status' => $res
        ]);
    }

    static public function delete($request)
    {
        $id = json_decode($request['params'])->id;

        $customer = Customer::find($id);

        $res = $customer->delete();

        echo json_encode([
            'status' => $res
        ]);
    }
}
