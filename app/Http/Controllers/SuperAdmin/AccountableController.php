<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Accountable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AccountableController extends Controller
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
            $data = Accountable::all();
            return DataTables::of($data)
                ->editColumn('asset_status', function ($request) {

                    if($request->isApproved === "approved"){
                        $result = '<span class="badge badge-success">Approved</span>';
                    }elseif($request->isApproved === "pending"){
                         $result = '<span class="badge badge-warning">Pending</span>';
                    }else{
                         $result = '<span class="badge badge-danger">Reject</span>';
                    }
                    return $result;
                })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                   
                    $btn = '<a title="Edit" href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-info btn-sm mr-1" id="editButton">
                            Update</a>';
                    return $btn;
                })
                ->rawColumns(['action','asset_status'])
                ->make(true);
        }
        
        return view('super_admin.accountability.index');
       
    }

    public function transferred_items(){
        return view('super_admin.transferred-items');
    }

    public function returned_items(){
        return view('super_admin.transferred-items');
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
                'total_cost' => 'required|numeric|min:0.01|max:9999999999999.99',
                'asset_status' => 'required',
            ]);


            // checked if new data or exists
            if (empty($request->id)) {

                $data = new Accountable();
                $data->name = $request->name;
                $data->budget = $request->total_cost;
                $data->budget = $request->asset_status;

                $data->save();

                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Accountability saved successfully!']);
            }else{
                $data = Accountable::find($request->id);
                $data->name = $request->name;
                $data->budget = $request->total_cost;
                $data->budget = $request->asset_status;

                $data->save();
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Accountability updated successfully!']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = ['id' => $request->id];
        $data = Accountable::where($id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        
        $id = ['id' => $request->id];
        $accountable = Accountable::where($id)->first();
        return response()->json($accountable);
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
             $school = Accountable::where('id',$request->id)->delete();
             return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Accountability deleted successfully!']);
        }

        return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'Something went wrong! Try again!']);
    }
}