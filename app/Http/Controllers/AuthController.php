<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!empty($request->get('user'))) {
            
            
            if(!empty($request->get('user'))){
                return redirect()->route('maintenance');
                // exit();
            }                
            

            $user = DB::connection('mysql_external')->table('tblusers', 'tblroles')->where('username', $request->get('user'))->first();

            if ($user === null) {
                return Redirect::to('http://202.137.126.58/');
            }elseif ($user->username !== null) {
                $result = User::where('email', $user->username)->first();

                if (empty($result)) {
                    $newuser = User::create([
                        'first_name' => 'First Name',
                        'last_name' => 'Last Name',
                        'email' =>  $request->get('user'),
                        'password' => Hash::make('password'),
                        'email_verified_at' => Carbon::now()->timezone('Asia/Manila'),
                        'role' => 'client', // Set email_verified_at to null initially
                    ]);

                    Auth::login($newuser);
                    
                    $url = '';
                    if (Auth::user()->role === 'super_admin') {
                        $url = 'my/dashboard';
                    } elseif (Auth::user()->role === 'admin') {
                        $url = 'my/account/dashboard';
                    } elseif (Auth::user()->role === 'client') {
                        $url = 'client/dashboard';
                    } else {
                        $url = 'index';
                    }
                    return redirect()->to($url);
                } else {
                    Auth::login($result);
                    $url = '';
                    if (Auth::user()->role === 'super_admin') {
                        $url = 's/dashboard';
                    } elseif (Auth::user()->role === 'admin') {
                        $url = 'admin/dashboard';
                    } elseif (Auth::user()->role === 'client') {
                        $url = 'client/dashboard';
                    } else {
                        $url = 'index';
                    }
                    return redirect()->to($url);
                }
            } else {
                return Redirect::to('https://202.137.126.59/assetx');
            }
            // dd($user);

            // Auth::login($user);

            // return view('dashboard', compact('user'));
        }else{
            return Redirect::to('http://202.137.126.58/');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}