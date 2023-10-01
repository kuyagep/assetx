<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        $data = [];
        if($request->ajax()){
            // $data = User::orderBy('created_at', 'asc')->get();
            $data = Purchase::all();
            return DataTables::of($data)
                ->editColumn('isApproved', function ($request) {

                    if($request->isApproved === "approved"){
                        $result = '<span class="badge badge-success">Approved</span>';
                    }else{
                         $result = '<span class="badge badge-danger">Rejected</span>';
                    }
                    return $result;
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
                ->rawColumns(['action','isApproved'])
                ->make(true);
        }
        
        return view('admin.purchase.index');
       
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
                'budget' => 'required|numeric|min:0.01|max:999999999999.99',
                'isApproved' => 'required',
            ]);


            // checked if new data or exists
            if (empty($request->id)) {

                $data = new Purchase();
                $data->name = $request->name;
                $data->budget = $request->budget;
                $data->isApproved = $request->isApproved;

                $data->save();

                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Purchase saved successfully!']);
            }else{
                $data = Purchase::find($request->id);
                $data->name = $request->name;
                $data->budget = $request->budget;
                $data->isApproved = $request->isApproved;

                $data->save();
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Purchase updated successfully!']);
            }
            
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = ['id' => $request->id];
        $data = Purchase::where($id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = ['id' => $request->id];
        $data = Purchase::where($id)->first();

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
             $school = Purchase::where('id',$request->id)->delete();
             return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Purchase deleted successfully!']);
        }

        return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'Something went wrong! Try again!']);
    }
}