<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    private function shiftPassword($plainPassword, $shift = 3)
    {
        $shifted = '';
        for ($i = 0; $i < strlen($plainPassword); $i++) {
            $char = $plainPassword[$i];
            $ascii = ord($char);
            if ($ascii >= 32 && $ascii <= 126) {
                $ascii = 32 + (($ascii - 32 + $shift) % 95);
            }
            $shifted .= chr($ascii);
        }
        return $shifted;
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $shiftedPassword = $this->shiftPassword($validated['password'], 5);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($shiftedPassword),
        ]);

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $credentials['password'] = $this->shiftPassword($credentials['password'], 5);
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'error_message' => 'Email atau Password Salah',
        ])->onlyInput('error_message');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}