<?php

namespace App\Http\Controllers\user;

use App\Models\Car;
use Illuminate\Routing\Controller;


class DashboardUserController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('user.pages.dashboard', ['cars' => $cars]);
    }
}
