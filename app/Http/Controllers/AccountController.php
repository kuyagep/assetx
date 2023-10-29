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
    public function super_adminDashboard()
    {
        return view('super_admin.index');
    }

    // Display Profile
    public function super_adminProfile(Request $request)
    {
        $account = User::find(Auth::user()->id);
        return view('super_admin.super_admin_profile', compact('account'));
    }

    public function super_adminProfileUpdate(Request $request)
    {        
        // Validation rules for the form fields
       $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email','regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'max:255'],
            'phone' => ['numeric','digits:11'],
            'address' => ['string', 'max:255'],
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        


        $data = User::find(Auth::user()->id);

        if($data->email !== $request->email){
            $email_exist = User::where('email', $request->email)->first();

            if ($email_exist) {
                Alert::error('Oops!', 'The email has already been taken.');
                return redirect()->back();              
            } 
        }

        if($data->phone !== $request->phone){
            $phone_exist = User::where('phone', $request->phone)->first();

            if ($phone_exist) {
                Alert::success('Oops!', 'The phone has already been taken.');
                return redirect()->back();
            }
        }
        
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

        // $data->save();

        // alert()->success('Title','Lorem Lorem Lorem');
        if( $data->save()){
            Alert::success('Success', 'Your Profile updated successfully!');
        }      


        $notification = array(
            'message' => 'Profile updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    // Change password
    
    // Update Password
    public function super_adminUpdatePassword( Request $request)
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
    // Update Password
    public function super_adminCheckPassword( Request $request)
    {
       
         // Verify the current password
        if (Hash::check($request->current_password, Auth::user()->password)) {
             return response()->json(['message' => 'true']);
        } else {
            return response()->json(['message' => 'false']);
        }
        
        

        // return response()->json(['message' => 'true']);
    }
    
    // ================Admin================
    
    // Admin Account Management
    

    // Display Profile
    public function adminDashboard()
    {
        return view('admin.index');
    }

    // Display Profile
    public function adminProfile(Request $request)
    {
        $account = User::find(Auth::user()->id);
        return view('admin.admin_profile', compact('account'));
    }

    public function adminProfileUpdate(Request $request)
    {        
        // Validation rules for the form fields
       $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email','regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'max:255'],
            'phone' => ['numeric','digits:11'],
            'address' => ['string', 'max:255'],
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        


        $data = User::find(Auth::user()->id);

        if($data->email !== $request->email){
            $email_exist = User::where('email', $request->email)->first();

            if ($email_exist) {
                Alert::error('Oops!', 'The email has already been taken.');
                return redirect()->back();              
            } 
        }

        if($data->phone !== $request->phone){
            $phone_exist = User::where('phone', $request->phone)->first();

            if ($phone_exist) {
                Alert::success('Oops!', 'The phone has already been taken.');
                return redirect()->back();
            }
        }
        
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

        // $data->save();

        // alert()->success('Title','Lorem Lorem Lorem');
        if( $data->save()){
            Alert::success('Success', 'Your Profile updated successfully!');
        }      


        $notification = array(
            'message' => 'Profile updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    // Change password
    
    // Update Password
    public function adminUpdatePassword( Request $request)
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



    // ================client================
    
    // client Account Management
    public function clientDashboard()
    {
         return view('client.index');
    }

    // Display Profile
    public function clientProfile(Request $request)
    {
        $account = User::find(Auth::user()->id);
        return view('client.client_profile', compact('account'));
    }

    public function clientProfileUpdate(Request $request)
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
    public function clientChangePassword()
    {
        $account = User::find(Auth::user()->id);
        return view('client.client_change_password', compact('account'));
    }

    // Update Password
    public function clientUpdatePassword( Request $request)
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
        Alert::success('Success', 'Password updated successfully!');
        $notification = array(
                'message' => 'Password updated successfully!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
    }
}