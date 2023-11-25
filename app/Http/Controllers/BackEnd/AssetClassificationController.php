<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Models\AssetClassification;

class AssetClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [];
        if ($request->ajax()) {
            // $data = User::orderBy('created_at', 'asc')->get();
            $data = AssetClassification::all();
            return DataTables::of($data)

                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d-m-Y H:i:s'); // format date time
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a title="View" href="javascript:void(0);" data-id="' . $row->id . '" class="btn bg-navy btn-sm mr-1" id="viewButton">
                         <i class="fas fa-inbox"></i></a>';
                    $btn .= '<a title="Edit" href="javascript:void(0);" data-id="' . $row->id . '" class="btn bg-navy btn-sm mr-1 px-2" id="editButton">
                        <i class="fa-regular fa-pen-to-square"></i> </a>';
                    $btn .= '<a title="Delete" href="javascript:void(0);" data-id="' . $row->id . '" class="btn bg-navy btn-sm px-2" id="deleteButton">
                        <i class="fa-regular fa-trash-can"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('pages.classifications.index');
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
                'uac_code' => 'required|numeric',
            ]);
            // checked if new data or exists
            if (empty($request->id)) {

                $data = new AssetClassification;
                $data->name =  Str::upper($request->name);
                $data->uac_code = $request->uac_code;
                $data->slug = Str::slug($request->name);


                $data->save();
                return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'Asset classification saved successfully!']);
            } else {
                $data = AssetClassification::find($request->id);

                $data->name =  Str::upper($request->name);
                $data->uac_code = $request->uac_code;
                $data->slug = Str::slug($request->name);


                $data->save();
                return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'Asset classification updated successfully!']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = ['id' => $request->id];
        $data = AssetClassification::where($id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = ['id' => $request->id];
        $data = AssetClassification::where($id)->first();

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
        if ($request->ajax()) {
            $user = AssetClassification::where('id', $request->id)->delete();
            return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'Asset classification deleted successfully!']);
        }


        return response()->json(['icon' => 'error', 'title' => 'Ooops!', 'message' => 'Something went wrong try again later!']);
    }
}
