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
Router::post('/cars', [CarController::class, 'store']);
Router::post('/cars/:id', [CarController::class, 'update']);
Router::delete('/cars/:id', [CarController::class, 'delete']);

Router::get('/customers', [CustomerController::class, 'index']);
Router::get('/customers/:id', [CustomerController::class, 'show']);
Router::post('/customers', [CustomerController::class, 'store']);
Router::post('/customers/:id', [CustomerController::class, 'update']);
Router::delete('/customers/:id', [CustomerController::class, 'delete']);

Router::get('/reservations', [ReservationController::class, 'index']);
Router::get('/reservations/:id', [ReservationController::class, 'show']);
Router::post('/reservations', [ReservationController::class, 'store']);
Router::post('/reservations/:id', [ReservationController::class, 'update']);
Router::delete('/reservations/:id', [ReservationController::class, 'delete']);

Router::get('/carCategories', [CarCategoryController::class, 'index']);
Router::get('/carCategories/:id', [CarCategoryController::class, 'show']);
Router::post('/carCategories', [CarCategoryController::class, 'store']);
Router::post('/carCategories/:id', [CarCategoryController::class, 'update']);
Router::delete('/carCategories/:id', [CarCategoryController::class, 'delete']);

Router::get('/carTypes', [CarTypeController::class, 'index']);
Router::get('/carTypes/:id', [CarTypeController::class, 'show']);
Router::post('/carTypes', [CarTypeController::class, 'store']);
Router::post('/carTypes/:id', [CarTypeController::class, 'update']);
Router::delete('/carTypes/:id', [CarTypeController::class, 'delete']);

Router::get('/customerCategories', [CustomerCategoryController::class, 'index']);
Router::get('/customerCategories/:id', [CustomerCategoryController::class, 'show']);
Router::post('/customerCategories', [CustomerCategoryController::class, 'store']);
Router::post('/customerCategories/:id', [CustomerCategoryController::class, 'update']);
Router::delete('/customerCategories/:id', [CustomerCategoryController::class, 'delete']);
