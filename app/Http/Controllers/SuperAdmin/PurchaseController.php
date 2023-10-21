<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class PurchaseController extends Controller
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
        
        return view('super_admin.purchase.index');
       
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
                'get_started' => 'required|string|max:255',
                'alt_mode_procurement' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'src_fund' => 'required|string|max:255',
                'attachment' => 'required|mimes:xlsx,xls|max:2048',
                'amount_abc' => 'required|numeric|min:0.01|max:999999999999.99',
                'isApproved' => 'required',
            ]);


            // checked if new data or exists
            if (empty($request->id)) {

                $data = new Purchase();
                $data->get_started = $request->get_started;
                $data->alt_mode_procurement = $request->alt_mode_procurement;
                $data->title = $request->title;
                $data->src_fund = $request->src_fund;
                $data->amount_abc = $request->amount_abc;
                $data->isApproved = $request->isApproved;

                if ($request->hasFile('attachment')) {
                    $file = $request->file('attachment');           

                    //new filename
                    $filename = $file->hashName();

                    // dd($filename);
                    $file->move(public_path('assets/dist/attachment/purchases'), $filename);
                    $data['attachment'] = $filename;
                }
                $data->user_id = Auth::user()->id;
                $data->office_id = Auth::user()->office->name;
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