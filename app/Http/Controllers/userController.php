<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class userController extends Controller
{
    public function register() {
        return view("users.register");
    }

    public function login() {
        return view("users.login");
    }

    public function store(Request $request) {
        $formField = $request->validate([
            'name' => ["required", "min:6"],
            'email' => ["required", "email", Rule::unique('users', 'email')],
            'password' => ["required", "confirmed", "min:8"],
        ]);

        //hash password
        $formField['password'] = bcrypt($formField['password']);

        // create user
        $user = User::create($formField);

        // login
        auth()->login($user);

        return redirect("/")->with("success_message", "the user created && login");
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/")->with('success_message', 'you have Logged Out!');
    }


    public function authenticate(Request $request) {
        $formField = $request->validate([
            "email" => ["required", "email"],
            "password" => "required"
        ]);

        if(auth()->attempt($formField)) {
            $request->session()->regenerate();

            return redirect("/")->with("success_message", "you are now logged in");
        }

        return back()->withErrors(['email' => 'Invalide Credentials'])->onlyInput('email');
    }
}

