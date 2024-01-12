<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetClassification;
use App\Models\District;
use App\Models\Division;
use App\Models\Issuance;
use App\Models\IssuanceType;
use App\Models\Office;
use App\Models\School;
use App\Models\User;
use Carbon\Carbon;
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
        $issuances = Issuance::all();
        return view('pages.issuances.index', compact('issuances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $users = User::select('id', 'first_name', 'last_name')->get();
        $divisions = Division::first();
        $types = IssuanceType::all();
        $districts = District::all();
        $schoolOrOffices = Office::all();
        return  view('pages.issuances.create', compact('types', 'districts', 'schoolOrOffices', 'divisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'issuance_type' => 'required',
            'issued_to' => 'required',
        ]);

        $issuance = new Issuance;

        $issuance->issuance_type_id = $request->issuance_type;
        $issuance->issued_to_user_id = $request->issued_to;
        $issuance->issued_by_user_id = Auth::user()->id;
        $issuance->issued_on = Carbon::now()->timezone('Asia/Manila');
        $issuance->save();

        return redirect()->route('asset_issuance.create', ['issuanceId' => $issuance->id, 'issuanceCode' => $issuance->issuance_code])
            ->with('success', 'Issuance created successfully.');
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
    public function edit(Request $request, $id)
    {
        $issuance = Issuance::findOrFail($id);
        $types = IssuanceType::all();
        $division = Division::first();
        $districts = District::all();
        if (empty($issuance->user->school_id)) {
            $schoolOrOffices = Office::get();
        } else {
            $schoolOrOffices =  School::where('district_id', $request->id)->get();
        }


        if (empty($issuance->issuedTo->school_id)) {
            $users = User::where('office_id', $issuance->issuedTo->office_id)->get();
        } else {
            $users = User::where('school_id', $request->id)->get();
        }

        return  view('pages.issuances.edit', compact('types', 'districts', 'schoolOrOffices', 'issuance', 'users','division'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'issuance_type' => 'required',
            'issued_to' => 'required',
        ]);

        $issuance = Issuance::findOrFail($id);

        $issuance->issuance_type_id = $request->issuance_type;
        $issuance->issued_to_user_id = $request->issued_to;
        $issuance->issued_by_user_id = Auth::user()->id;
        $issuance->issued_on = Carbon::now()->timezone('Asia/Manila');
        $issuance->update();

        return redirect()->route('asset_issuance.create', ['issuanceId' => $issuance->id, 'issuanceCode' => $issuance->issuance_code]);
    }

    public function getAssetsByClassification($classificationId)
    {
        $assets = Asset::where('classification_id', $classificationId)->get();
        return response()->json($assets);
    }
    public function getSchoolOrOffice(Request $request)
    {
        // $district = District::where();
        if (empty($request->id)) {
            $schools = Office::get();
        } else {
            $schools = School::where('district_id', $request->id)->get();
        }
        return response()->json($schools);
    }
    public function getIssuedTo(Request $request)
    {
        if (empty($request->district_id)) {
            $users = User::where('office_id', $request->id)->get();
        } else {
            $users = User::where('school_id', $request->id)->get();
        }
        return response()->json($users);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $issuance = Issuance::where('id', $request->id)->delete();
            return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'Issuance deleted successfully!']);
        }

        return response()->json(['icon' => 'error', 'title' => 'Ooops!', 'message' => 'Something went wrong! Try again!']);
    }

     public function client_index(Request $request)
    {
        $issuances = Issuance::all();
        return view('pages.issuances.client_index', compact('issuances'));
    }
}