<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW ADMIN LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin(): View
    {
        return view('admin.auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'string',
            ],
        ]);

        $authenticated = Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'is_admin' => true,
        ]);

        if (!$authenticated) {
            return back()
                ->withErrors([
                    'email' => 'Invalid admin credentials.',
                ])
                ->onlyInput('email');
        }

        // Prevent session fixation.
        $request->session()->regenerate();

        return redirect()->intended(
            route('admin.dashboard')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        // Invalidate the authenticated session.
        $request->session()->invalidate();

        // Generate a fresh CSRF token.
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with(
                'success',
                'You have been logged out successfully.'
            );
    }
}
