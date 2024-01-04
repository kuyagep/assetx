<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class SuppliersController extends Controller
{
    public function index(Request $request)
    {
        $supplier = [];
        if ($request->ajax()) {
            $supplier = Supplier::all();
            return DataTables::of($supplier)
                
                ->editColumn('status', function ($request) {

                    if ($request->status === 1) {
                        $result = '<span class="badge badge-success">Active</span>';
                    } else {
                        $result = '<span class="badge badge-danger">Inactive</span>';
                    }
                    return $result;
                })
                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d-m-Y H:i:s'); // format date time
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a title="Edit" href="javascript:void(0);" data-id="' . $row->id . '" class="btn bg-navy btn-sm mr-1 px-2" id="editButton">
                        <i class="fa-regular fa-pen-to-square"></i> </a>';
                    $btn .= '<a title="Delete" href="javascript:void(0);" data-id="' . $row->id . '" class="btn bg-navy btn-sm px-2" id="deleteButton">
                        <i class="fa-regular fa-trash-can"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['status','created_at'])
                ->make(true);
        }
        
        
        return view('pages.suppliers.all_supplier');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([

                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => ['required', 'string', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'max:255'],
                'phone' => ['numeric', 'digits:11'],
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'position_name' => 'required',
                'roles' => 'required',
                'status' => 'required',
            ]);
            //check office if exists

            // checked if new data or exists
            if (empty($request->id)) {
    
                $user = new User;
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->password = Hash::make('password');
                $user->role = 'client';
                $user->status = $request->status;
                $user->office_id = $request->office_name;
                $user->school_id = $request->school_name;
                $user->position_id = $request->position_name;

                $user->save();

                return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'Supplier saved successfully!']);
            } else {
                $user = Supplier::find($request->id);

                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->role = $request->role;
                $user->status = $request->status;

                $user->save();
                return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'Supplier updated successfully!']);
            }
        }
    }

    public function edit(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('pages.suppliers.edit_supplier', compact('supplier',));
        // return response()->json(['user'=> $user, 'roles'=> $roles, ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'max:255'],
            'phone' => ['numeric', 'digits:11'],
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'office_name' => 'required|string|max:255',
            'roles' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $user = Supplier::findOrFail($id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->office_id = $request->office_name;
        $user->role = 'client';
        $user->status = $request->status;

        $user->save();

        Alert::success('Success', 'Supplier updated successfully!');

        return redirect()->route('supplier.index');
        // return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Admin user updated successfully!']);


    }

    
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $user = Supplier::findOrFail($id);

            if (!is_null($user)) {
                $user->delete();
            }
            return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'Admin user deleted successfully!']);
        }

        return response()->json(['icon' => 'error', 'title' => 'Ooops!', 'message' => 'Something went wrong try again later!']);
    }
}