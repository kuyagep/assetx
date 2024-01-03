<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;


use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\IpUtils;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
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
            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                // *version 1
                //'email' => ['required', 'string', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@deped\.gov\.ph/i', 'max:255', 'unique:' . User::class], 
                
                'email' => ['required', 'string', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at' => null, // Set email_verified_at to null initially
                'role' => 'client',
                'status' => 1
            ]);

            $user->assignRole(3);

            event(new Registered($user));

            $user->sendEmailVerificationNotification();
            
            Auth::login($user);
            // Redirect to a page indicating that a verification email has been sent
            return redirect()->route('verification.notice')->with('email', $user->email);

            // Auth::login($user);

            // return redirect(RouteServiceProvider::HOME);
        }else{
            return redirect()->back()->with('recaptcha_status', 'Please Complete the Recaptcha Again to proceed');
        }

        
    }
}