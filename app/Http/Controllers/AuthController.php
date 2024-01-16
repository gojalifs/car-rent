<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Session;

class AuthController extends Controller
{
    function index()
    {
        if (Auth::check()) {
            if (Auth::user()->isOwner == 0) {
                return redirect()->route('user.dashboard');
            } else {
                return redirect()->route('owner.dashboard');
            }
        }
        return view('auth.login');
    }

    function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string'
        ];

        $messages = [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth

            //Login Success
            if (Auth::user()->isOwner == 1) {
                return redirect()->route('owner.dashboard');
            } else {
                return redirect()->route('dashboard');
            }
        } else { // false

            //Login Fail
            Session::flash('error', 'Email atau password salah');
            return redirect()->route('login');
        }

    }

    function showRegisterPage(){
        return view('auth.register');
    }

    function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users|max:255',
            'phone' => 'required|string|unique:users|max:18',
            'sim' => 'nullable|string',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8|same:password',
        ]);

        // validate the input

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'sim' => $request->sim,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with(['success' => 'Your profile created. You can login now']);

    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('login');
    }
}
