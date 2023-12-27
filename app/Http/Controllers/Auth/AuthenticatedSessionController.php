<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();



        if ($request->user()->status !== 'active') {
            Auth::logout(); // Log out the user
            return redirect('/login')->with(['status' => 'Your account is not activated.']); // Redirect with an error message
        }

        if ($request->user()->status !== 'active') {
            Auth::logout(); // Log out the user
            return redirect('/login')->with(['status' => 'Your account is not activated.']); // Redirect with an error message
        }


        $url = '';
        if ($request->user()->role === 'super_admin') {
            $url = 'my/dashboard';
        } elseif ($request->user()->role === 'admin') {
            $url = 'my/account/dashboard';
        } elseif ($request->user()->role === 'client') {
            $url = 'client/dashboard';
        } else {
            $url = 'index';
        }
        return redirect()->intended($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // return Redirect::to('http://202.137.126.58/');
        return Redirect::to('http://localhost/assetx');
    }
}
