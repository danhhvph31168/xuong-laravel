<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    public function showFormRegister()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['string', 'required', 'max:255'],
            'email' => ['string', 'required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data['password'] = bcrypt($data['password']); // mã hóa pass

        $user = User::query()->create($data);

        Auth::login($user);

        return redirect()->intended('/');
    }
}
