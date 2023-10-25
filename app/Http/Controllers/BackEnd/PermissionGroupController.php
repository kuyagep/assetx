<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PermissionGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [];
        if($request->ajax()){
            // $data = User::orderBy('created_at', 'asc')->get();
            $data = PermissionGroup::all();
            return DataTables::of($data)
            ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d-m-Y H:i:s'); // format date time
            })
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

    
        return view('super_admin.permissionGroup.index');
       
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
                'name' => 'required|string|max:255',
            ]);
            // checked if new data or exists
            if (empty($request->id)) {
               $request->validate([
                    'name' => 'required|string|max:255|unique:permission_groups',
                ]);
                $data = new PermissionGroup;
                $data->name = ucfirst($request->name);


                $data->save();
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Permission Group saved successfully!']);
            }else{
                $data = PermissionGroup::find($request->id);

                $data->name = ucfirst($request->name);


                $data->save();
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Permission Group updated successfully!']);
            }
            
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = ['id' => $request->id];
        $data = PermissionGroup::where($id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = ['id' => $request->id];
        $data = PermissionGroup::where($id)->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if($request->ajax()){
             PermissionGroup::where('id',$request->id)->delete();
             return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Permission Group deleted successfully!']);
        }
       

        return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'Something went wrong try again later!']);
    }
}