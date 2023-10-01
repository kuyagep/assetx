<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        if(!empty($request->get('user'))){
           
            $user = DB::connection('mysql_external')->table('tblusers','tblroles')->where('username', $request->get('user'))->first();

            if ($user === null) {
                return Redirect::to('http://202.137.126.58/');
            } elseif($user->username === 'lorenzo.mendoza@deped.gov.ph') {
                $result = User::where('email', 'lorenzo.mendoza@deped.gov.ph')->first();
                Auth::login($result);
            }else{
                 return Redirect::to('http://202.137.126.59/assetx');
            }
            // dd($user);

            // Auth::login($user);
                        
            // return view('dashboard', compact('user'));
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