<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
         $users = User::select('avatar', 'first_name','last_name', 'email_verified_at','status' ,'id', 'role' )->get();

        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' =>  'required|email|unique:users,email|max:255',
        ]);
        
        User::updateOrCreate([
            'id' => Str::uuid(),
            'first_name' => $request->first_name,
            'last_name' =>  $request->last_name,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'email_verified_at' => null,
            'role' => 'client',
            'status' => 'active',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        

         $notification = array(
                'message' => 'User created Successfully!',
                'alert-type' => 'success'
        );
        return redirect()->route('super_admin.user.index')->with($notification);
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
        $users = User::findOrFail($id);
        return view('pages.users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
       $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
        ]);

        User::findOrFail($request->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);
        

        $notification = array(
                'message' => 'User Updated Successfully!',
                'alert-type' => 'success'
        );
       
        return redirect()->route('super_admin.user.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // Perform additional checks (authorization) if needed before deletion
        $user->delete();
        // Otherwise, redirect back with a success flash message
        return redirect()->route('super_admin.user.index')->with('success', 'User deleted successfully.');
    }
}