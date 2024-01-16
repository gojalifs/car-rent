<?php

namespace App\Http\Controllers\owner;

use App\Models\Car;
use Illuminate\Routing\Controller;

class CarsController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('owner.pages.cars', ['cars' => $cars]);
    }
}

