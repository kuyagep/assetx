<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class AccountController extends Controller
{

    
    // ================Super Admin================
    // SuperAdmin Account Management
    public function SuperAdminDashboard()
    {
        return view('super_admin.index');
    }

    // Display Profile
    public function SuperAdminProfile(Request $request)
    {
        $account = User::find(Auth::user()->id);
        return view('super_admin.super_admin_profile', compact('account'));
    }

    public function SuperAdminProfileUpdate(Request $request)
    {        
        // Validation rules for the form fields
       $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['numeric','digits:11'],
            'address' => ['string', 'max:255'],
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = User::find(Auth::user()->id);
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('avatar')) {
            $file = $request->file('avatar');           
            @unlink(public_path('assets/dist/img/avatar/'.Auth::user()->avatar));

            //new filename
            $filename = $file->hashName();

            // dd($filename);
            $file->move(public_path('assets/dist/img/avatar'), $filename);
            $data['avatar'] = $filename;
        }

        $data->save();

        // alert()->success('Title','Lorem Lorem Lorem');

        Alert::success('Success', 'Profile updated successfully!');


        $notification = array(
            'message' => 'Profile updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    // Change password
    public function SuperAdminChangePassword()
    {
        $account = User::find(Auth::user()->id);
        return view('super_admin.super_admin_change_password', compact('account'));
    }

    // Update Password
    public function SuperAdminUpdatePassword( Request $request)
    {
        //validation
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);
        
         // Verify the current password
        if (!Hash::check($request->current_password, Auth::user()->password)) {
           $notification = array(
                'message' => 'Current Password does not matched!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        // Update the password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
       
        
        Alert::success('Success', 'Password updated successfully!');

        $notification = array(
                'message' => 'Password updated successfully!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
    }
    
    // ================Admin================
    
    // Admin Account Management
    public function AdminDashboard()
    {
         return view('admin.index');
    }

    // Display Profile
    public function AdminProfile(Request $request)
    {
        $account = User::find(Auth::user()->id);
        return view('admin.admin_profile', compact('account'));
    }

    public function AdminProfileUpdate(Request $request)
    {        
        // Validation rules for the form fields
       $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['numeric','digits:11'],
            'address' => ['string', 'max:255'],
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = User::find(Auth::user()->id);
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');           
            @unlink(public_path('assets/dist/img/avatar/'.Auth::user()->avatar));

            //new filename
            $filename = $file->hashName();

            // dd($filename);
            $file->move(public_path('assets/dist/img/avatar'), $filename);
            $data['avatar'] = $filename;
        }

        $data->save();


        Alert::success('Success', 'Profile updated successfully!');

        $notification = array(
            'message' => 'Profile updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    // Change password
    public function AdminChangePassword()
    {
        $account = User::find(Auth::user()->id);
        return view('admin.admin_change_password', compact('account'));
    }

    // Update Password
    public function AdminUpdatePassword( Request $request)
    {
        //validation
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);
        
         // Verify the current password
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            Alert::error('Success', 'Current Password not matched!');
           $notification = array(
                'message' => 'Current Password does not matched!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        // Update the password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        
        Alert::success('Success', 'Password updated successfully!');

        $notification = array(
                'message' => 'Password updated successfully!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
    }



    // ================Client================
    
    // Client Account Management
    public function ClientDashboard()
    {
         return view('client.index');
    }

    // Display Profile
    public function ClientProfile(Request $request)
    {
        $account = User::find(Auth::user()->id);
        return view('client.client_profile', compact('account'));
    }

    public function ClientProfileUpdate(Request $request)
    {        
        // Validation rules for the form fields
       $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['numeric','digits:11'],
            'address' => ['string', 'max:255'],
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = User::find(Auth::user()->id);
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('avatar')) {
            $file = $request->file('avatar');           
            @unlink(public_path('assets/dist/img/avatar/'.Auth::user()->avatar));

            //new filename
            $filename = $file->hashName();

            // dd($filename);
            $file->move(public_path('assets/dist/img/avatar'), $filename);
            $data['avatar'] = $filename;
        }

        $data->save();
        Alert::success('Success', 'Profile updated successfully!');
        $notification = array(
            'message' => 'Profile updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    // Change password
    public function ClientChangePassword()
    {
        $account = User::find(Auth::user()->id);
        return view('client.client_change_password', compact('account'));
    }

    // Update Password
    public function ClientUpdatePassword( Request $request)
    {
        //validation
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);
        
         // Verify the current password
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            Alert::error('Failed', 'Current Password does not matched!');
           $notification = array(
                'message' => 'Current Password does not matched!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        // Update the password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        Alert::success('Failed', 'Password updated successfully!');
        $notification = array(
                'message' => 'Password updated successfully!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
    }
}