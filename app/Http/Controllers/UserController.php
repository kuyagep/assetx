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
            ->editColumn('avatar', function ($request) {
                  //  return '<img src="' .asset('assets/dist/img/avatar/' . $request->avatar). '" alt="User Image" width="50">';
            })
            ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d-m-Y H:i'); // format date time
            })
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a title="View" data-toggle="tooltip" data-placement="top" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-primary btn-sm mr-1" id="viewButton">
                         View</a>';
                $btn .= '<a title="Edit" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-olive btn-sm mr-1" id="editButton">
                        Edit</a>';
                $btn .= '<a title="Delete" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-danger btn-sm" id="deleteButton">
                        Delete</a>';
                return $btn;
            })
            ->rawColumns(['avatar','action'])
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
                'email' =>  'required|email|max:255',
            ]);
        }
               
        
         User::updateOrCreate(
            [    
                'id' => $request->id,
                'email' => $request->email,
            ],
            [
                'first_name' => ucwords(trim($request->first_name)),
                'last_name' => ucwords(trim($request->last_name)),
                'password' => Hash::make('password'),
                'email_verified_at' => null,
                'role' => 'client',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        // youtube link: https://www.youtube.com/watch?v=47er3YeFbZo
       
        return response()->json(['message' => 'User saved successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
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

        if ($request->ajax()) {
              $id = ['id' => $request->id];
            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255'],
            ]);

            User::findOrFail($id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ]);
        }

        return response()->json(['message' => 'User updated successfully!']);
        
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