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

use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\IpUtils;

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
        $recaptcha_response = $request->input('g-recaptcha-response');

        if (is_null($recaptcha_response)) {
            return redirect()->back()->with('recaptcha_status', 'Please complete the recaptcha to proceed');
        }
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $body = [
            'secret' => config('services.recaptcha.secret'),
            'response' => $recaptcha_response,
            'remoteip' => IpUtils::anonymize($request->ip()) //anonymize the ip to be GDPR compliant. Otherwise just pass the default ip address
        ];
        
        $response = Http::asForm()->post($url, $body);

        $result = json_decode($response);



        if ($response->successful() && $result->success == true) {
            $request->authenticate();

            $request->session()->regenerate();

            if ($request->user()->status !== '1') {
                Auth::logout(); // Log out the user
                return redirect('/login')->with(['status' => 'Account Pending! Contact Administrator.']); // Redirect with an error message
            }

             $url = '';
            if ($request->user()->hasRole('super-admin')) {
                $url = 'my/dashboard';
            } elseif ($request->user()->hasRole('admin')) {
                $url = 'my/account/dashboard';
            } elseif ($request->user()->hasRole('client')) {
                $url = 'client/dashboard';
            } else {
                $url = 'index';
            }
            return redirect()->intended($url);
        }else{
            return redirect()->back()->with('recaptcha_status', 'Please Complete the Recaptcha Again to proceed');
        }



       
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