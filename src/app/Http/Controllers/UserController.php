<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //

    public function index()
    {
        return view('user.profile');
    }

    function register()
    {
        return view('user.register');
    }

    function create(Request $request)
    {
        $formFields = $request->validate(
            [
                'username' => ['required', 'string', Rule::unique('users', 'username')],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => 'required|confirmed|min:8'
            ]
        );

        $formFields['password'] = bcrypt($formFields['password']);

        if ($request->hasFile('profile-pic')) {
            $formFields['profile_pic'] = $request->file('profile-pic')->store('profile_pics', 'public');
        }

        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/')->status(201);
    }

    function login()
    {
        return view('user.login');
    }

    function authenticate(Request $request)
    {

        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->status(200);
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    function account($username)
    {
        $user = User::get()->where('username', $username)->first();
        return view('user.account', [
            'user' => $user,
            'quotes' => User::find($user->id)->quotes
        ]);
    }
}
