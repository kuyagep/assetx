<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetClassification;
use App\Models\AssetIssuance;
use App\Models\Issuance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetIssuanceController extends Controller
{
    public function index()
    {
        $assetIssuances = AssetIssuance::all();
        return view('asset_issuance.index', compact('assetIssuances'));
    }

    public function create(Request $request)
    {

        if (empty($request->get('issuanceId')) && empty($request->get('issuanceCode'))) {
            return redirect()->route('issuances.create')
                ->with('error', 'Asset Issuance failed.');
        }

        $classifications = AssetClassification::all();
        $issuance = Issuance::findOrFail($request->get('issuanceId'));
        $assetIssuances = AssetIssuance::findOrFail($request->get('issuanceId'))->get();

        // You can pass any necessary data to the view here
        return view('pages.asset_issuance.create', compact('issuance', 'classifications', 'assetIssuances'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'assets' => 'required',
            'issuanceId' => 'required',
            'quantity' => 'required',
        ]);

        // if (empty($request->get('issuanceId')) && empty($request->get('issuanceCode'))) {
        //     return redirect()->route('issuance.create')
        //         ->with('error', 'Asset Issuance failed.');
        // }

        $asset_issuance = new AssetIssuance;
        $asset_issuance->asset_id = $request->assets;
        $asset_issuance->issuance_id = $request->issuanceId;
        $asset_issuance->quantity = $request->quantity;
        $asset_issuance->save();

        $asset_issuances = AssetIssuance::where('issuance_id', $request->issuanceId)->get();

        $classifications = AssetClassification::all();
        return redirect()->route('asset_issuance.create', ['issuanceId' => $request->issuanceId, 'issuanceCode' => $asset_issuance->issuance->issuance_code, 'asset_issuances' => $asset_issuances, 'classifications' => $classifications])
            ->with('success', 'Asset Item added successfully.');
    }



    public function edit(Request $request, $id)
    {
        if (empty($request->get('issuanceId')) && empty($request->get('issuanceCode'))) {
            return redirect()->route('issuance.create')
                ->with('error', 'Asset Issuance failed.');
        }
        $classifications = AssetClassification::all();

        $issuance = Issuance::findOrFail($request->get('issuanceId'));
        // You can pass any necessary data to the view here
        return view('asset_issuance.edit', compact('assetIssuance', 'classifications'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'asset_id' => 'required',
            'issuance_id' => 'required',
            'quantity' => 'required',
        ]);

        $assetIssuance = AssetIssuance::findOrFail($id);
        $assetIssuance->update($request->all());

        return redirect()->route('asset_issuance.index')
            ->with('success', 'Asset Issuance updated successfully.');
    }

    public function destroy($id)
    {
        $assetIssuance = AssetIssuance::findOrFail($id);
        $assetIssuance->delete();

        return redirect()->route('asset_issuance.index')
            ->with('success', 'Asset Issuance deleted successfully.');
    }

    public function getAssetByClassification(Request $request)
    {

        $assets = Asset::where('classification_id', $request->id)->get();
        return response()->json($assets);
    }
}