<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //Show Register Form
    public function create(){
        return view('users.register');
    }

    //Store User To Database
    public function store(Request $request){
        $userData = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6']
        ]);

        //Hash Password
        // $userData['password'] = bcrypt($userData['password']);
        $userData['password'] = Hash::make($userData['password']);

        $user = User::create($userData);

        //Login
        auth()->login($user);

        return redirect('/')->with('message', 'User Created Successfully');  
    }

    //Logout
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out');
    }

    //Show Login Form
    public function login(){
        return view('users.login');
    }

    //Login User
    public function loginUser(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($credentials)){
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You have been logged in');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
    }
}
