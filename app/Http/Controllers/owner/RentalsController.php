<?php

namespace App\Http\Controllers\owner;

use Illuminate\Routing\Controller;


class rentalsController extends Controller
{
    public function index()
    {
        return view('owner.pages.rentals');
    }
}
