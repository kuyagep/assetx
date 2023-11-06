<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Issuance;
use App\Models\IssuanceType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class IssuanceController extends Controller
{
    // use Illuminate\Support\Str;
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
            $data = Issuance::all();
            return DataTables::of($data)
                ->editColumn('issuance_type', function ($request) {
                    return $request->issuance_type->name; 
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
                ->rawColumns(['issuance_type','action'])
                ->make(true);
        }

        $issuance_type = IssuanceType::all();
        return view('super_admin.issuances.index', compact('issuance_type'));
       
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
                'issuance_type' => 'required',
                'total_value' => 'required|numeric|min:0.01|max:9999.99',
            ]);

            $total_value = '';
            $issuance_type = IssuanceType::findOrFail($request->issuance_type);
            // checked if new data or exists
            if (empty($request->id)) {

                $data = new Issuance;
                $data->total_value = $total_value;
                $data->received_form_user_id = Auth::user()->id;
                $data->received_by_user_id = Auth::user()->id;
                $data->status = $request->status;
                 
                $issuance_type->issuance()->save($data);
                
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Issued successfully!']);
            }else{
                $data = Issuance::find($request->id);
                $data->district_id = $request->district_name;
                $data->school_id = $request->school_id;
                $data->name = $request->name;
                $data->code = $request->code;
                $data->slug = Str::slug($request->name);
                $data->status = $request->status;

                if ($request->hasFile('logo')) {
                    $file = $request->file('logo');      
                    //new filename
                    $filename = $file->hashName();

                    // dd($filename);
                    $file->move(public_path('assets/dist/img/logo'), $filename);
                    $data['logo'] = $filename;
                }

                $data->save();
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'School updated successfully!']);
            }
            
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = ['id' => $request->id];
        $data = Issuance::where($id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $school = Issuance::findOrFail($request->id);
        $issuance_type = IssuanceType::all();   
        return response()->json(['school'=> $school, 'district'=> $issuance_type ]);
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

            
            $data = IssuanceType::find($id);

            if($data){

                $data->name = $request->name;
                $data->slug = $request->slug;

                $data->save();
                 return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'School updated successfully!']);
            }else{
               
                 return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'School not Found!']);
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
             $school = Issuance::where('id',$request->id)->delete();
             return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'School deleted successfully!']);
        }

        return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'Something went wrong! Try again!']);
    }
}