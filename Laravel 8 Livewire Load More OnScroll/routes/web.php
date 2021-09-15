<?php

use Illuminate\Support\Facades\Route;

Route::get('/load-more-scroll', function () {
    return view('lists');
});