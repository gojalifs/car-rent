<?php

namespace App\Http\Controllers\owner;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Validator;

class CarsController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('owner.pages.cars', ['cars' => $cars]);
    }

    public function store(Request $request)
    {
        $validatedCar = $request->validate([
            'merk' => 'required',
            'type' => 'required',
            'plat' => 'required',
            'fee' => 'required'
        ]);

        try {
            Car::create([
                'merk' => $request->merk,
                'type' => $request->type,
                'plat' => $request->plat,
                'fee' => $request->fee,
            ]);

            return redirect()->route('owner.cars')->with('success', 'Car added succesfully');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Error when adding car')->withInput($request->all);
        }
    }

    public function update(Request $request)
    {
        DB::table('Cars')
            ->where('id', $request->id)
            ->update([
                'merk' => $request->merk,
                'type' => $request->type,
                'plat' => $request->plat,
                'fee' => $request->fee,
            ]);

        return redirect()->route('owner.cars')->with('success', 'Car updated succesfully');
    }

    public function destroy(Request $request)
    {
        DB::table('Cars')
            ->where('id', $request->id)
            ->delete();

        return redirect()->route('owner.cars')->with('success', 'Car deleted succesfully');

    }

}


