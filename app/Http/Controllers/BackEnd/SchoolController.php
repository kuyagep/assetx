<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/index');
        }
        $data = [];
        if ($request->ajax()) {
            // $data = User::orderBy('created_at', 'asc')->get();
            $data = School::all();
            return DataTables::of($data)
                ->editColumn('logo', function ($request) {
                    if (empty($request->logo)) {
                        $temp = asset("assets/dist/img/logo/no_image.png");
                    } else {
                        $temp = asset("assets/dist/img/logo/" . $request->logo);
                    }

                    $result = '<ul class="list-inline">
                                    <li class="list-inline-item">
                                        <img alt="Logo" class="table-avatar" src="' . $temp . '" style="width: 2.5rem; height: 2.5rem; border-radius: 50%; object-fit: cover;">
                                    </li>
                                </ul>';
                    return $result;
                    //  return '<img src="' .asset('assets/dist/img/avatar/' . $request->avatar). '" alt="User Image" width="50">';
                })
                ->editColumn('district', function ($request) {
                    return $request->district->name;
                })
                ->editColumn('status', function ($request) {

                    if ($request->status === "active") {
                        $result = '<span class="badge badge-success">Active</span>';
                    } else {
                        $result = '<span class="badge badge-danger">Inactive</span>';
                    }
                    return $result;
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
                ->rawColumns(['logo', 'district', 'action', 'status'])
                ->make(true);
        }

        $districts = District::all();
        return view('pages.schools.index', compact('districts'));
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
                'district_name' => 'required',
                'school_id' => 'required|numeric',
                'name' => 'required|string|max:255',
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'code' => 'required|string|max:255',
                'status' => 'required|string|max:255',
            ]);


            $district = District::findOrFail($request->district_name);
            // checked if new data or exists
            if (empty($request->id)) {

                $data = new School;
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

                $district->schools()->save($data);
                // $division->districts()->create([
                //     'name' =>  $request->name,
                //     'slug' =>  Str::slug($request->name),
                //     'status' =>  $request->status,
                // ]);

                return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'Schools saved successfully!']);
            } else {
                $data = School::find($request->id);
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
                return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'School updated successfully!']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = ['id' => $request->id];
        $data = School::where($id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $school = School::findOrFail($request->id);
        $district = District::all();
        return response()->json(['school' => $school, 'district' => $district]);
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

            if ($data) {

                $data->name = $request->name;
                $data->slug = $request->slug;

                $data->save();
                return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'School updated successfully!']);
            } else {

                return response()->json(['icon' => 'error', 'title' => 'Ooops!', 'message' => 'School not Found!']);
            }
        }
        return response()->json(['icon' => 'error', 'title' => 'Ooops!', 'message' => 'Something went wrong! Try again.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $school = School::where('id', $request->id)->delete();
            return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'School deleted successfully!']);
        }

        return response()->json(['icon' => 'error', 'title' => 'Ooops!', 'message' => 'Something went wrong! Try again!']);
    }
}
