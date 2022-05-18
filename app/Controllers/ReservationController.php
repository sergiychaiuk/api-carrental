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
}
