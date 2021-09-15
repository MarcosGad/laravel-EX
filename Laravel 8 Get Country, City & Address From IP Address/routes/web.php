<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GeoLocationController;
Route::get('get-address-from-ip', [GeoLocationController::class, 'index']);
