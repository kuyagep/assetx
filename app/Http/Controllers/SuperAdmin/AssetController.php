<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetStatus;
use App\Models\Classification;
use App\Models\District;
use App\Models\Issuance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class AssetController extends Controller
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
            $data = Asset::all();
            return DataTables::of($data)
                ->editColumn('classification', function ($request) {
                    return $request->classifications->name; 
                })
                ->editColumn('issuances', function ($request) {
                    return $request->issuances->name; 
                })
                ->editColumn('asset_status', function ($request) {
                    return $request->asset_status->name; 
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
                ->rawColumns(['classification','asset_status','issuances','action'])
                ->make(true);
        }

        $classifications = Classification::all();
        $asset_status = AssetStatus::all();
        return view('super_admin.assets.index', compact('asset_status', 'classifications' ));
       
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
                'classification_name' => 'required',
                'article' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'reference' => 'required|string|max:255',
                'unit_of_measure' => 'required|string|max:255',
                // 'property_no' => 'required|string|max:255',
                'unit_value' => 'required|numeric|min:0.01|max:9999.99',
                'balance_per_card_qty' => 'required|integer|min:0|max:120',
                'balance_per_card_value' => 'required|numeric|min:0.01|max:9999.99',
                'onhand_per_count_qty' => 'required|integer|min:0|max:120',
                'onhand_per_count_value' => 'required|numeric|min:0.01|max:9999.99',
                'shortage_overage_qty' => 'integer|min:0|max:120',
                'shortage_overage_value' => 'numeric|min:0.01|max:9999.99',
                'date_acquired' => 'required|date',
                'remarks' => 'string|max:255',

            ]);


            $classification = Classification::findOrFail($request->classification->name);
            // checked if new data or exists
            if (empty($request->id)) {

                $data = new Asset;
                $data->classification_id = $request->classification_name;
                $data->article = $request->article;
                $data->description = $request->description;
                $data->reference = $request->reference;
                // $data->property_no = $request->property_no;
                $data->unit_of_measure = $request->unit_of_measure;
                $data->unit_value = $request->unit_value;
                $data->balance_per_card_qty = $request->balance_per_card_qty;
                $data->balance_per_card_value = $request->balance_per_card_value;
                $data->onhand_per_count_qty = $request->onhand_per_count_qty;
                $data->onhand_per_count_value = $request->onhand_per_count_value;
                $data->shortage_overage_qty = $request->shortage_overage_qty;
                $data->shortage_overage_value = $request->shortage_overage_value;
                $data->date_acquire = $request->date_acquire;
                $data->remarks = $request->remarks;
                $data->classification_id = $request->classification_id;
                $data->asset_status_id = $request->asset_status_id;
                $data->issuance_id = $request->issuance_id;

                $classification->assets()->save($data);
                // $division->districts()->create([
                //     'name' =>  $request->name,
                //     'slug' =>  Str::slug($request->name),
                //     'status' =>  $request->status,
                // ]);

                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Asset saved successfully!']);
            }else{
                $data = Asset::find($request->id);
                $data->classification_id = $request->classification_name;
                $data->article = $request->article;
                $data->description = $request->description;
                $data->reference = $request->reference;
                // $data->property_no = $request->property_no;
                $data->unit_of_measure = $request->unit_of_measure;
                $data->unit_value = $request->unit_value;
                $data->balance_per_card_qty = $request->balance_per_card_qty;
                $data->balance_per_card_value = $request->balance_per_card_value;
                $data->onhand_per_count_qty = $request->onhand_per_count_qty;
                $data->onhand_per_count_value = $request->onhand_per_count_value;
                $data->shortage_overage_qty = $request->shortage_overage_qty;
                $data->shortage_overage_value = $request->shortage_overage_value;
                $data->date_acquire = $request->date_acquire;
                $data->remarks = $request->remarks;
                $data->classification_id = $request->classification_id;
                $data->asset_status_id = $request->asset_status_id;
                $data->issuance_id = $request->issuance_id;

                return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Asset updated successfully!']);
            }
            
        }

        $assets = Asset::all();
        return view('super_admin.assets.index', compact('assets'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = ['id' => $request->id];
        $data = Asset::where($id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $classification = Classification::findOrFail($request->id);
        $asset_status = AssetStatus::all(); 
        return response()->json(['classification'=> $classification,'asset_status'=>$asset_status ]);
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
             $assets = Asset::where('id',$request->id)->delete();
             return response()->json(['icon'=>'success','title'=>'Success!', 'message' => 'Asset deleted successfully!']);
        }

        return response()->json(['icon'=>'error','title'=>'Ooops!', 'message' => 'Something went wrong! Try again!']);
    }
}