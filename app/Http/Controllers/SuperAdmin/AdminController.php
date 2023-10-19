<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function allAdmin(Request $request){
        $users = [];
        if($request->ajax()){
            $users = User::where('role', 'admin')
            ->orWhere('role','super_admin')
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
                $btn = '<a title="Edit" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-purple btn-sm mr-1 px-2" id="editButton">
                        <i class="fa-regular fa-pen-to-square"></i> </a>';
                $btn .= '<a title="Delete" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-danger btn-sm px-2" id="deleteButton">
                        <i class="fa-regular fa-trash-can"></i> </a>';
                return $btn;
            })
            ->rawColumns(['phone','role','position','avatar','action','full_name','status'])
            ->make(true);
        }

        $positions = Position::all();
        $roles = Role::all();
        return view('pages.admins.all_admin', compact('positions','roles'));
    }
    
     public function storeAdmin(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => ['required', 'string', 'email','regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'max:255'],
                'phone' => ['numeric','digits:11'],
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'roles' => 'required|string|max:255',
                'status' => 'required|string|max:255',
            ]);
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
                $user->role = 'super_admin';
                $user->status = $request->status;

                if ($request->hasFile('avatar')) {
                    $file = $request->file('avatar');           

                    //new filename
                    $filename = $file->hashName();

                    // dd($filename);
                    $file->move(public_path('assets/dist/img/avatar'), $filename);
                    $user['avatar'] = $filename;
                }

                $user->save();

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

    public function editAdmin(Request $request, $id){
        $user = User::findOrFail($id);
        $roles = Role::all();   

        return view('pages.admins.edit_admin', compact('user','roles'));
        // return response()->json(['user'=> $user, 'roles'=> $roles, ]);
    }
    
     public function updateAdmin(Request $request, $id)
    {
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email','regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'max:255'],
            'phone' => ['numeric','digits:11'],
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'roles' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);
            
        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = 'admin';
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

        return redirect()->route('super_admin.all.admin');
        // return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Admin user updated successfully!']);
        

    }

     public function destroyAdmin(Request $request, $id)
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