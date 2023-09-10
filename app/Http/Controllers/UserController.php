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
        $users = [];
        if($request->ajax()){
            $users = User::orderBy('created_at', 'asc')->get();
            return DataTables::of($users)
                ->editColumn('full_name', function ($request) {
                    $result = $request->first_name . " " . $request->last_name;
                    return $result;
                })
                ->editColumn('avatar', function ($request) {

                    if (empty($request->avatar)) {
                        $temp = asset("assets/dist/img/avatar.png");
                    } else {
                        $temp = asset("assets/dist/img/avatar/" . $request->avatar);
                    }

                    $result = '<ul class="list-inline">
                            <li class="list-inline-item">
                                <img alt="Avatar" class="table-avatar" src="' . $temp . '" style="width: 2.5rem; border-radius: 50%;">
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
                    return $request->created_at->format('d-m-Y H:i'); // format date time
            })
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a title="View" href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-primary btn-sm mr-1" id="viewButton">
                         View</a>';
                $btn .= '<a title="Edit" href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-info btn-sm mr-1" id="editButton">
                        Edit</a>';
                $btn .= '<a title="Delete" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-danger btn-sm" id="deleteButton">
                        Delete</a>';
                return $btn;
            })
            ->rawColumns(['avatar','action','full_name','status'])
            ->make(true);
        }
       return view('pages.users.index', compact('users'));
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

        if ($request->ajax()) {

            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => ['required', 'string', 'email','regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'max:255'],
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        }
               
        
         User::updateOrCreate(
            [    
                'id' => $request->id,
            ],
            [
                'first_name' => ucwords(trim($request->first_name)),
                'last_name' => ucwords(trim($request->last_name)),
                'password' => Hash::make('password'),
                'email' => trim($request->email),
                'email_verified_at' => null,
                'role' => 'client',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        // youtube link: https://www.youtube.com/watch?v=47er3YeFbZo
       
        return response()->json(['message' => 'User saved successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = ['id' => $request->id];
        $user = User::where($id)->first();

        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = ['id' => $request->id];
        $user = User::where($id)->first();

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if($request->ajax()){
             $user = User::where('id',$request->id)->delete();
             return response()->json(['message'=>'User deleted successfully']);
        }
       

        return response()->json(['message' => 'User deleted successfully!']);
    }
}