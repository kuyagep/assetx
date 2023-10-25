<?php

namespace App\Http\Controllers\BackEnd;

use App\Exports\PermissionExport;
use App\Http\Controllers\Controller;
use App\Imports\PermissionImport;
use App\Models\Division;
use App\Models\PermissionGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function allPermission(Request $request)
    {
        
        $data = [];
        if($request->ajax()){
            // $data = User::orderBy('created_at', 'asc')->get();
            $data = Permission::all();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a title="Edit" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-purple btn-sm mr-1" id="editButton">
                        <i class="fa-regular fa-pen-to-square"></i> Edit</a>';
                $btn .= '<a title="Delete" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-danger btn-sm" id="deleteButton">
                        <i class="fa-regular fa-trash-can"></i> Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        
         $groups = PermissionGroup::all();
      
        return view('pages.permission.permission', compact('groups'));
    }//end method

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
    public function storePermission(Request $request)
    {
         if ($request->ajax()) {
            $request->validate([
                'name' => 'required|string|max:255',
                'group_name' => 'required|string|max:255',
            ]);
            // checked if new data or exists
            if (empty($request->id)) {
               $request->validate([
                    'name' => 'required|string|max:255|unique:permissions',
                    'group_name' => 'required|string|max:255',
                ]);
                $data = new Permission;
                $data->name = ucfirst($request->name);
                $data->group_name = ucwords($request->group_name);

                $data->save();
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Permission saved successfully!']);
            }else{
                $data = Permission::find($request->id);
                $data->name = ucfirst($request->name);
                $data->group_name = ucwords($request->group_name);

                $data->save();
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Permission updated successfully!']);
            }
            
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
    public function editPermission(Request $request, $id)
    {
        $permission = Permission::findOrFail($request->id);
        $groups = PermissionGroup::all();   
        return response()->json(['permission'=> $permission, 'groups'=> $groups, ]);
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
    public function destroyPermission(Request $request)
    {
         if($request->ajax()){
             Permission::where('id',$request->id)->delete();
             return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Permission deleted successfully!']);
        }
       

        return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'Something went wrong try again later!']);
    }

    public function importPermission()
    {
        //
        return view('pages.permission.import');
    }
    public function exportPermission()
    {
        //
        return Excel::download(new PermissionExport, 'permissions.xlsx');
    }
    public function importPermissions(Request $request)
    {
        //
        $validatedData = $request->validate([
                'import_file' => 'required|mimes:xlsx,xls|max:2048',
            ]);
            
        Excel::import(new PermissionImport, $request->file('import_file'));

        Alert::success('Success', 'Permission imported successfully!');
        
        return redirect()->back();
    }

    //* Roles //
     public function allRoles(Request $request)
    {
        $data = [];
        if($request->ajax()){
            // $data = User::orderBy('created_at', 'asc')->get();
            $data = Role::all();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a title="Edit" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-purple btn-sm mr-1" id="editButton">
                        <i class="fa-regular fa-pen-to-square"></i> Edit</a>';
                $btn .= '<a title="Delete" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-danger btn-sm" id="deleteButton">
                        <i class="fa-regular fa-trash-can"></i> Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
              
        return view('pages.roles.roles');
    }//end method

    public function storeRoles(Request $request)
    {
         if ($request->ajax()) {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            // checked if new data or exists
            if (empty($request->id)) {
               $request->validate([
                    'name' => 'required|string|max:255|unique:roles',
                ]);
                $data = new Role;
                $data->name = strtolower($request->name);

                $data->save();
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Role saved successfully!']);
            }else{
                $data = Role::find($request->id);
                $data->name = strtolower($request->name);

                $data->save();
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Role updated successfully!']);
            }
            
        }
    }

    public function editRoles(Request $request, $id)
    {
        $id = ['id' => $request->id];
        $data = Role::where($id)->first();

        return response()->json($data);
    }

    public function destroyRoles(Request $request)
    {
         if($request->ajax()){
            Role::where('id',$request->id)->delete();
            return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Role deleted successfully!']);
        }       

        return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'Something went wrong try again later!']);
    }

    //* Add Role Permission all Method //
    public function addRolePermission(){

        $roles = Role::all();
        $permissions = Permission::all();

        $permission_groups = User::getPermissionGroups();
        return view('pages.rolesPermission.add_roles_permission', compact('roles', 'permissions', 'permission_groups'));
    }
    public function storeRolesPermission(Request $request){
        $request->validate([
                'role_name' => 'required',
        ]);
        $data = array();
        $permissions = $request->permission;
        
        foreach($permissions as $key => $item){
            $data['role_id'] = $request->role_name;
            $data['permission_id'] = $item;
            DB::table('role_has_permissions')->insert($data);
        }

        Alert::success('Success', 'Role Permission added successfully!');

        return redirect()->route('super_admin.all.roles.permission');

    }//end

    public function allRolesPermission(Request $request)
    {
        $data = [];
        if($request->ajax()){
            // $data = User::orderBy('created_at', 'asc')->get();
            $data = Role::all();
            return DataTables::of($data)
            ->editColumn('permission', function ($request) {
                $result = '';
                foreach ($request->permissions as $key => $prem) {
                    $result .= '<span class="badge badge-success mr-1">'.$prem->name.'</span>';
                }
                
                return $result;
            })
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a title="Edit" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-purple btn-sm mr-1" id="editButton">
                        <i class="fa-regular fa-pen-to-square"></i> Edit</a>';
                $btn .= '<a title="Delete" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-danger btn-sm" id="deleteButton">
                        <i class="fa-regular fa-trash-can"></i> Delete</a>';
                return $btn;
            })
            ->rawColumns(['action','permission'])
            ->make(true);
        }
        return view('pages.rolesPermission.all_roles_permission');
    }

    public function editRolesPermission(Request $request){
        $role = Role::findOrFail($request->id);
        $permissions = Permission::all();

        $permission_groups = User::getPermissionGroups();
        return view('pages.rolesPermission.edit_roles_permission', compact('role', 'permissions', 'permission_groups'));
    }
    public function updateRolesPermission(Request $request, $id){
        $role = Role::findOrFail($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        Alert::success('Success', 'Role updated successfully!');

        return redirect()->route('super_admin.all.roles.permission');
    }

    public function destroyRolesPermission(Request $request, $id){
    
         if($request->ajax()){
            $role = Role::findOrFail( $id );

            if(!is_null($role)){
                $role->delete();
            }
            return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Role deleted successfully!']);
        }       

        return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'Something went wrong try again later!']);
    }
}