<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = [];
        if($request->ajax()){
            $users = User::all();
            return DataTables::of($users)
                ->editColumn('image', function ($request) {
                    return '<img src="' .url('assets/dist/img/user/' . $request->image). '" alt="User Image" width="50">';
            })
            ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d-m-Y H:i'); // format date time
            })
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-olive btn-sm mr-1" id="editProduct">Edit</a>';
                $btn .= '<a href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-danger btn-sm" id="deleteProduct">Delete</a>';
                return $btn;
            })
            ->rawColumns(['image','action'])
            ->make(true);
        }
       return view('pages.users.index', compact('users'));
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
        

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|between:0.01,999999.99',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        
        $data = new Product;
        $data->name = $request->name; 
        $data->price = $request->price; 

        if ($request->file('image')) {
            $file = $request->file('image');
            //new filename
            $filename = $file->hashName();
            //upload file to the directory            
            $file->move(public_path('assets/dist/img/product'), $filename);
            $data->image =$filename; 
        } 

        // save the data
        $data->save();
        // youtube link: https://www.youtube.com/watch?v=47er3YeFbZo
       
        return response()->json(['message' => 'Product saved successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = ['id' => $request->id];
        $product = Product::where($id)->first();

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if($request->ajax()){
             $product = Product::where('id',$request->id)->delete();
             return response()->json(['success'=>'Post deleted successfully']);
        }
       

        return response()->json(['success' => 'Product deleted successfully!']);
    }
}