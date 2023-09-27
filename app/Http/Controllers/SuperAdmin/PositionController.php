<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [];
        if($request->ajax()){
            // $data = User::orderBy('created_at', 'asc')->get();
            $data = Position::all();
            return DataTables::of($data)
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
                $btn = '<a title="View" href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-primary btn-sm mr-1" id="viewButton">
                         View</a>';
                $btn .= '<a title="Edit" href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-info btn-sm mr-1" id="editButton">
                        Edit</a>';
                $btn .= '<a title="Delete" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-danger btn-sm" id="deleteButton">
                        Delete</a>';
                return $btn;
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }

    
        return view('super_admin.position.index');
       
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
                'status' => 'required|string|max:255',
            ]);
            // checked if new data or exists
            if (empty($request->id)) {
               
                $data = new Position;
                $data->name = $request->name;
                $data->slug = Str::slug($request->name);
                $data->status = $request->status;

                if ($request->hasFile('logo')) {
                    $file = $request->file('logo');           

                    //new filename
                    $filename = $file->hashName();

                    // dd($filename);
                    $file->move(public_path('assets/dist/img/logo/'), $filename);
                    $data['logo'] = $filename;
                }

                $data->save();
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Position saved successfully!']);
            }else{
                $data = Position::find($request->id);

                $data->name = $request->name;
                $data->slug = Str::slug($request->name);
                $data->status = $request->status;

                if ($request->hasFile('logo')) {
                    $file = $request->file('logo');           
                    @unlink(public_path('assets/dist/img/logo/'. $data->logo));

                    //new filename
                    $filename = $file->hashName();

                    // dd($filename);
                    $file->move(public_path('assets/dist/img/logo/'), $filename);
                    $data['logo'] = $filename;
                }

                $data->save();
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Position updated successfully!']);
            }
            
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = ['id' => $request->id];
        $data = Position::where($id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = ['id' => $request->id];
        $data = Position::where($id)->first();

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
             $user = Position::where('id',$request->id)->delete();
             return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Position deleted successfully!']);
        }
       

        return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'Something went wrong try again later!']);
    }
}