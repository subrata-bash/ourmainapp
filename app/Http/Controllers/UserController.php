<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function showCorrectHomePage()
    {
        // Check the user is login or not
        if (auth()->check()) {
            return view('homepage-feed');
        } else {
            return view('homepage');
        }
    }
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:9', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:3', 'confirmed'],
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        // add the data in the mysql data through User Model( !!!model is used for CURD operation in the database!!! )
        $user =  User::create($incomingFields);
        auth()->login($user);
        return redirect('/')->with('success', 'Thank you');
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required',
        ]);
        if (auth()->attempt([
            'username' => $incomingFields['loginusername'],
            'password' => $incomingFields['loginpassword']
        ])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Welcome');
        } else {
            return redirect('/')->with('failure', 'Invalid attempt');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Visit Again');
    }
}
