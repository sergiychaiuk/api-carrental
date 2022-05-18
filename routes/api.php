<?php

use App\Controllers\CarCategoryController;
use App\Controllers\CarController;
use App\Controllers\CarTypeController;
use App\Controllers\CustomerCategoryController;
use App\Controllers\CustomerController;
use App\Controllers\ReservationController;
use Core\Router;

Router::get('/cars', [CarController::class, 'index']);
Router::get('/cars/:id', [CarController::class, 'show']);

Router::get('/customers', [CustomerController::class, 'index']);
Router::get('/customers/:id', [CustomerController::class, 'show']);

Router::get('/reservations', [ReservationController::class, 'index']);
Router::get('/reservations/:id', [ReservationController::class, 'show']);

Router::get('/carCategories', [CarCategoryController::class, 'index']);
Router::get('/carCategories/:id', [CarCategoryController::class, 'show']);

Router::get('/carTypes', [CarTypeController::class, 'index']);
Router::get('/carTypes/:id', [CarTypeController::class, 'show']);

Router::get('/customerCategories', [CustomerCategoryController::class, 'index']);
Router::get('/customerCategories/:id', [CustomerCategoryController::class, 'show']);
