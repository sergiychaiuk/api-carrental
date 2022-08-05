<?php

namespace App\Controllers;

use App\Models\Reservation;

class ReservationController
{
    static public function index()
    {
        $reservations = Reservation::all();

        array_map(function ($reservation) {
            $reservation->car = $reservation->car();
            $reservation->customer = $reservation->customer();
        }, $reservations);

        echo json_encode($reservations);
    }

    static public function show($request)
    {
        $reservation = Reservation::find(json_decode($request['params'])->id);

        $reservation->car = $reservation->car();
        $reservation->customer = $reservation->customer();

        echo json_encode($reservation);
    }

    static public function store($request)
    {
        $reservation = new Reservation($request['data']);

        $res = $reservation->create();

        echo json_encode([
            'status' => $res
        ]);
    }

    static public function update($request)
    {
        $id = json_decode($request['params'])->id;

        $reservation = Reservation::find($id);

        $reservation->mergeAttributes($request['data']);

        $res = $reservation->update();

        echo json_encode([
            'status' => $res
        ]);
    }

    static public function delete($request)
    {
        $id = json_decode($request['params'])->id;

        $reservation = Reservation::find($id);

        $res = $reservation->delete();

        echo json_encode([
            'status' => $res
        ]);
    }
}
