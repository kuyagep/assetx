<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

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
                    $btn = '<a title="Edit" href="javascript:void(0);" data-id="' . $row->id . '" class="text-white mr-1 px-2" id="editButton">
                        <i class="fa-regular fa-pen-to-square"></i> </a>';
                    $btn .= '<a title="Delete" href="javascript:void(0);" data-id="' . $row->id . '" class="text-white px-2" id="deleteButton">
                        <i class="fa-regular fa-trash-can"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['status','created_at','action'])
                ->make(true);
        }
        
        
        return view('pages.suppliers.all_supplier');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([

                'name' => 'required|string|max:255',
                'address' => 'string|max:255',
                'tin' => 'string|max:255',
                'contact' => ['numeric'],
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'email' => ['string', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'max:255'],
                'bank_name' => 'string|max:255',
                'bank_account_name' => 'string|max:255',
                'bank_account_number' => 'numeric',
                'attachment' => 'file|mimes:pdf|max:2048',
                'remarks' => 'string',
                'status' => '',
            ]);
            //check office if exists

            // checked if new data or exists
            if (empty($request->id)) {
    
                $data = new Supplier;
                $data->name = $request->name;
                $data->address = $request->address;
                $data->tin = $request->tin;
                $data->contact = $request->contact;
                $data->logo = $request->logo;
                $data->email = $request->email;
                $data->bank_name = $request->bank_name;
                $data->bank_account_name = $request->bank_account_name;
                $data->bank_account_number = $request->bank_account_number;

                if ($request->hasFile('attachment')) {
                    $attachment = $request->file('attachment');

                    // Upload the new file 
                    $attachment = Storage::disk('local')->putFileAs('/', $attachment, str()->uuid() . '.' . $attachment->extension());

                    $data['attachment'] = $attachment;
                }

                $data->attachment = $request->attachment;
                $data->remarks = $request->remarks;
                $data->status = $request->status;
                $data->save();

                return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'Supplier saved successfully!']);
            } else {
                $data = Supplier::find($request->id);

                $data->name = $request->name;
                $data->address = $request->address;
                $data->tin = $request->tin;
                $data->contact = $request->contact;
                $data->logo = $request->logo;
                $data->email = $request->email;
                $data->bank_name = $request->bank_name;
                $data->bank_account_name = $request->bank_account_name;
                $data->bank_account_number = $request->bank_account_number;

                if ($request->hasFile('attachment')) {
                    $attachment = $request->file('attachment');

                    // Upload the new file and update the record
                    $attachment = Storage::disk('local')->putFileAs('/', $attachment, str()->uuid() . '.' . $attachment->extension());
                    // Delete the old file if it exists
                    if ($data->attachment) {
                        Storage::delete($data->attachment);
                    }
                    // $file->move(public_path('assets/dist/attachment/purchases'), $filename);
                    $data['attachment'] = $attachment;
                }

                $data->attachment = $request->attachment;
                $data->remarks = $request->remarks;
                $data->status = $request->status;
                $data->save();

                $data->save();
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