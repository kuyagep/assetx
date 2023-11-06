<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [];
        if($request->ajax()){
            // $data = User::orderBy('created_at', 'asc')->get();
            $data = Division::all();
            return DataTables::of($data)
                ->editColumn('logo', function ($request) {

                    if (empty($request->logo)) {
                        $temp = asset("assets/dist/img/logo/no_image.png");
                    } else {
                        $temp = asset("assets/dist/img/logo/" . $request->logo);
                    }

                    $result = '<ul class="list-inline">
                            <li class="list-inline-item">
                                <img alt="Avatar" class="table-avatar" src="' . $temp . '" style="width: 2.5rem; height: 2.5rem; border-radius: 50%; object-fit: cover;">
                            </li>
                        </ul>';
                    return $result;
                    //  return '<img src="' .asset('assets/dist/img/avatar/' . $request->avatar). '" alt="User Image" width="50">';
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
            ->rawColumns(['logo','action','status'])
            ->make(true);
        }

    
        return view('pages.divisions.index');
       
    }

    /**
     * Show the form for creating a new resource.
     * 
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
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'required|string|max:255',
            ]);
            // checked if new data or exists
            if (empty($request->id)) {
               
                $data = new Division;
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
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Division saved successfully!']);
            }else{
                $data = Division::find($request->id);

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
                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Division updated successfully!']);
            }
            
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = ['id' => $request->id];
        $data = Division::where($id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = ['id' => $request->id];
        $data = Division::where($id)->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

       if ($request->ajax()) {

            $request->validate([
                'name' => 'required|string|max:255',
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            
            $data = Division::find($id);

            if($data){
                $data->name = $request->name;
                $data->slug = $request->slug;

                if ($request->hasFile('logo')) {
                     // @unlink(public_path('assets/dist/img/avatar/'.Auth::user()->avatar));
                    $path = 'assets/dist/img/avatar/' . $data->avatar;
                    if(File::exists($path)){
                        File::delete($path);
                    }

                    $file = $request->file('avatar');           
                   

                    //new filename
                    $filename = $file->hashName();

                    // dd($filename);
                    $file->move(public_path('assets/dist/img/avatar'), $filename);
                    $data['logo'] = $filename;
                }
                $data->save();
            }else{
               
                 return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'Division not Found!']);
            }

        }

        return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Division updated successfully!']);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if($request->ajax()){
             $user = Division::where('id',$request->id)->delete();
             return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Division deleted successfully!']);
        }
       

        return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'Something went wrong try again later!']);
    }
}