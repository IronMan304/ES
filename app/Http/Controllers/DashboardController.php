<?php

namespace App\Http\Controllers;


use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        $time = Carbon::now()->format('H');
        $operations = 0;
   

        return view('dashboard', [
            'time' => $time,
            'operations' => $operations
        ]);
    }
}
