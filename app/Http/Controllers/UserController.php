<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        // add the data in the mysql data through User Model( !!!model is used for CURD operation in the database!!! )
        User::create($incomingFields);
        return 'Hello from register Method';
    }
}
