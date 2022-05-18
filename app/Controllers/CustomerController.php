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
}
