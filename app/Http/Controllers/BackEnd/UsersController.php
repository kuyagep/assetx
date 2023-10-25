<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index(Request $request){
        $users = [];
        if($request->ajax()){
            $users = User::where('role', 'client')
            ->get();
            return DataTables::of($users)
            ->editColumn('position', function ($request) {
                $result = $request->position->name;
                if($result == null){
                    return "N/A";
                }else{
                    $result = $request->position->name;
                }
                return $result; 
            })
            ->editColumn('office', function ($request) {
                $result = $request->office->name;
                
                if($result == null){
                    return "N/A";
                }else{
                        $result;
                }
                return $result; 
            })
            ->editColumn('phone', function ($request) {
                $result = $request->phone;
                if($result == null){
                    return "N/A";
                }else{
                    $result = $request->phone;
                }
                return $result; 
            })
            ->editColumn('role', function ($request) {
                $result = '';
                foreach ($request->roles as $role) {
                    $result .= '<span class="badge badge-primary mr-1">'.$role->name.'</span>';
                }
                
                return $result;
            })
            ->editColumn('full_name', function ($request) {
                $result = $request->first_name . " " . $request->last_name;
                return $result;
            })
            ->editColumn('avatar', function ($request) {

                if (empty($request->avatar)) {
                    $temp = asset("assets/dist/img/avatar/default.jpg");
                } else {
                    $temp = asset("assets/dist/img/avatar/" . $request->avatar);
                }

                $result = '<ul class="list-inline">
                        <li class="list-inline-item">
                            <img alt="Avatar" class="table-avatar" src="' . $temp . '" style="width: 2.5rem; height: 2.5rem; border-radius: 50%; object-fit: cover;">
                        </li>
                    </ul>';
                return $result;
                //  return '<img src="' .asset('assets/dist/img/avatar/' . $request->avatar). '" alt="User Image" width="50">';
            })
            
            ->editColumn('status', function ($request) {

                if($request->status === "active"){
                    $result = '<span class="badge badge-success">Active</span>';
                }else{
                        $result = '<span class="badge badge-danger">Inactive</span>';
                }
                return $result;
            })
            ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d-m-Y H:i:s'); // format date time
            })
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a title="Edit" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-navy btn-sm mr-1 px-2" id="editButton">
                        <i class="fa-regular fa-pen-to-square"></i> </a>';
                $btn .= '<a title="Delete" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-navy btn-sm px-2" id="deleteButton">
                        <i class="fa-regular fa-trash-can"></i> </a>';
                return $btn;
            })
            ->rawColumns(['phone','role','position','office','avatar','action','full_name','status'])
            ->make(true);
        }

        $positions = Position::all();
        $offices = Office::all();
        $roles = Role::all();
        return view('pages.users.all_user', compact('positions','roles','offices'));
    }
    
     public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => ['required', 'string', 'email','regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'max:255'],
                'phone' => ['numeric','digits:11'],
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'position_name' => 'required',
                'office_name' => 'required',
                'roles' => 'required|string|max:255',
                'status' => 'required|string|max:255',
            ]);
            //check office if exists
            $office = Office::findOrFail($request->office_name);
            $position = Office::findOrFail($request->position_name);
            // checked if new data or exists
            if (empty($request->id)) {
                $request->validate([
                    'email' => ['required', 'string', 'email','regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'max:255', 'unique:'.User::class],
                    'phone' => ['numeric','digits:11', 'unique:'.User::class],
                ]);
                $user = new User;
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->password = Hash::make('password');
                $user->role = 'client';
                $user->status = $request->status;

                if ($request->hasFile('avatar')) {
                    $file = $request->file('avatar');           

                    //new filename
                    $filename = $file->hashName();

                    // dd($filename);
                    $file->move(public_path('assets/dist/img/avatar'), $filename);
                    $user['avatar'] = $filename;
                }
                $office->user()->save($user);
                $position->user()->save($user);

                if($request->roles){
                    $user->assignRole($request->roles);
                }
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Admin user saved successfully!']);
            }else{
                $user = User::find($request->id);

                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->role = $request->role;
                $user->status = $request->status;

                if ($request->hasFile('avatar')) {
                    $file = $request->file('avatar');           
                    @unlink(public_path('assets/dist/img/avatar/'. $user->avatar));

                    //new filename
                    $filename = $file->hashName();

                    // dd($filename);
                    $file->move(public_path('assets/dist/img/avatar'), $filename);
                    $user['avatar'] = $filename;
                }

                $user->save();
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Admin user updated successfully!']);
            }
            
        }

    }

    public function edit(Request $request, $id){
        $user = User::findOrFail($id);
        $roles = Role::all();   
        $offices = Office::all();
        return view('pages.users.edit_user', compact('user','roles','offices'));
        // return response()->json(['user'=> $user, 'roles'=> $roles, ]);
    }
    
     public function update(Request $request, $id)
    {
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email','regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'max:255'],
            'phone' => ['numeric','digits:11'],
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'office_name' => 'required|string|max:255',
            'roles' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);
            
        $user = User::findOrFail($id);

        if($user->email !== $request->email){
            $email_exist = User::where('email', $request->email)->first();

            if ($email_exist) {
                Alert::error('Oops!', 'The email has already been taken.');
                return redirect()->back();              
            } 
        }

        if($user->phone !== $request->phone){
            $phone_exist = User::where('phone', $request->phone)->first();

            if ($phone_exist) {
                Alert::success('Oops!', 'The phone has already been taken.');
                return redirect()->back();
            }
        }


        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->office_id = $request->office_name;
        $user->role = 'client';
        $user->status = $request->status;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');           
            @unlink(public_path('assets/dist/img/avatar/'. $user->avatar));

            //new filename
            $filename = $file->hashName();

            // dd($filename);
            $file->move(public_path('assets/dist/img/avatar'), $filename);
            $user['avatar'] = $filename;
        }

        $user->save();

        $user->roles()->detach();
        if($request->roles){
                    $user->assignRole($request->roles);
                }

        Alert::success('Success','Admin user updated successfully!');

        return redirect()->route('super_admin.user.index');
        // return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Admin user updated successfully!']);
        

    }

     public function destroy(Request $request, $id)
    {
         if($request->ajax()){
            $user = User::findOrFail( $id );

            if(!is_null($user)){
                $user->delete();
            }
            return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Admin user deleted successfully!']);
        }       

        return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'Something went wrong try again later!']);
       
    }
    


}