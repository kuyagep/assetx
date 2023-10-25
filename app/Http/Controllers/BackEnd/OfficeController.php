<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!Auth::check()){
            return redirect('/index');
        }
        $data = [];
        if($request->ajax()){
            // $data = User::orderBy('created_at', 'asc')->get();
            $data = Office::all();
            return DataTables::of($data)
                ->editColumn('division', function ($request) {
                    return $request->division->name; // format date time
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
                $btn = '<a title="View" href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-primary btn-sm mr-1" id="viewButton">
                         View</a>';
                $btn .= '<a title="Edit" href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-info btn-sm mr-1" id="editButton">
                        Edit</a>';
                $btn .= '<a title="Delete" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-danger btn-sm" id="deleteButton">
                        Delete</a>';
                return $btn;
            })
            ->rawColumns(['division','action','status'])
            ->make(true);
        }

        $divisions = Division::all();
        return view('pages.offices.index', compact('divisions'));
       
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
                'division_name' => 'required',
                'name' => 'required|string|max:255',
                'status' => 'required|string|max:255',
            ]);


            $division = Division::findOrFail($request->division_name);
            // checked if new data or exists
            if (empty($request->id)) {

                $data = new Office;
                $data->division_id = $request->division_name;
                $data->name = $request->name;
                $data->slug = Str::slug($request->name);
                $data->status = $request->status;

                $division->offices()->save($data);
                // $division->districts()->create([
                //     'name' =>  $request->name,
                //     'slug' =>  Str::slug($request->name),
                //     'status' =>  $request->status,
                // ]);

                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Office saved successfully!']);
            }else{
                $data = Office::find($request->id);
                $data->division_id = $request->division_name;
                $data->name = $request->name;
                $data->slug = Str::slug($request->name);
                $data->status = $request->status;

                $data->save();
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Office updated successfully!']);
            }
            
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = ['id' => $request->id];
        $data = Office::where($id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $office = Office::findOrFail($request->id);
        $division = Division::all();   
        return response()->json(['office'=> $office, 'division'=> $division ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

       if ($request->ajax()) {

            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            
            $data = Office::find($id);

            if($data){

                $data->name = $request->name;
                $data->slug = $request->slug;

                $data->save();
                 return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Office updated successfully!']);
            }else{
               
                 return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'Office not Found!']);
            }
        }
        return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'Something went wrong! Try again.']);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if($request->ajax()){
             $office = Office::where('id',$request->id)->delete();
             return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Office deleted successfully!']);
        }

        return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'Something went wrong! Try again!']);
    }
}