<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeoLocationController extends Controller
{
    public function index(Request $request)
    {
        // $ip = $request->ip();
        // dd($ip);
        $ip = "196.151.143.54";
        $data = \Location::get($ip);
        dd($data);
    }
}
