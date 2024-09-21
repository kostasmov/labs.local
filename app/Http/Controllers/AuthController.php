<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\View\View;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function login_view(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();

            return redirect()->route('index')->with('success', 'Авторизация пройдена');
        }

        return redirect()->back()->withErrors("Неверный логин или пароль");
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function check_login(request $request): Response
    {
        $login = $request->input('login');
        $user = User::where('login', $login)->first();

        if ($user) {
            return response('<p class="error-message">Логин уже используется</p>');
        } else {
            return response('<p class="success-message">Логин свободен</p>');
        }
    }

    public function register_view(): View
    {
        return view('auth.registration');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('mail'),
            'login' => $request->input('login'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::login($user);

        return redirect()->route('index')->with('success', 'Регистрация прошла успешно');
    }
}
