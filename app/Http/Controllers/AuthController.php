<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private string $adminLogin = 'admin';
    private string $adminPasswordHash = '$2y$12$7PV5sjFwNYRMCptoO/it4eo1SXsO.0L7Uqban8h69n0hVNp09Xpiy⏎';

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

    public function logout()
    {
        return "А-Б-О-Б-А";
    }

    public function register_view(): View
    {
        return view('auth.registration');
    }

    public function register(): RedirectResponse
    {
//        return view('regis');
    }

}
