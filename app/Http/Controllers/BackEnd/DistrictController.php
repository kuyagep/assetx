<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class DistrictController extends Controller
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
            $data = District::all();
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
               $btn = '<a title="View" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-navy btn-sm mr-1" id="viewButton">
                         <i class="fas fa-inbox"></i></a>';
                $btn .= '<a title="Edit" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-navy btn-sm mr-1 px-2" id="editButton">
                        <i class="fa-regular fa-pen-to-square"></i> </a>';
                $btn .= '<a title="Delete" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-navy btn-sm px-2" id="deleteButton">
                        <i class="fa-regular fa-trash-can"></i> </a>';
                return $btn;
            })
            ->rawColumns(['division','action','status'])
            ->make(true);
        }

        $divisions = Division::all();
        return view('pages.districts.index', compact('divisions'));
       
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

                $data = new District;
                $data->division_id = $request->division_name;
                $data->name = $request->name;
                $data->slug = Str::slug($request->name);
                $data->status = $request->status;

                $division->districts()->save($data);
                // $division->districts()->create([
                //     'name' =>  $request->name,
                //     'slug' =>  Str::slug($request->name),
                //     'status' =>  $request->status,
                // ]);

                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'District saved successfully!']);
            }else{
                $data = District::find($request->id);
                $data->division_id = $request->division_name;
                $data->name = $request->name;
                $data->slug = Str::slug($request->name);
                $data->status = $request->status;

                $data->save();
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'District updated successfully!']);
            }
            
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = ['id' => $request->id];
        $data = District::where($id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $district = District::findOrFail($request->id);
        $division = Division::all();   
        return response()->json(['district'=> $district, 'division'=> $division, ]);
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

            
            $data = District::find($id);

            if($data){

                $data->name = $request->name;
                $data->slug = $request->slug;

                $data->save();
                 return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'District updated successfully!']);
            }else{
               
                 return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'District not Found!']);
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
             $user = District::where('id',$request->id)->delete();
             return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'District deleted successfully!']);
        }

        return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'Something went wrong! Try again!']);
    }
}