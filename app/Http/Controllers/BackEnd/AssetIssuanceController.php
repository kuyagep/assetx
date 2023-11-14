<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\AssetIssuance;
use App\Models\Issuance;
use Illuminate\Http\Request;

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
            return redirect()->route('issuance.create')
                ->with('error', 'Asset Issuance failed.');
        }

        $issuance = Issuance::findOrFail($request->get('issuanceId'));

        // You can pass any necessary data to the view here
        return view('pages.asset_issuance.create', compact('issuance'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => 'required',
            'issuance_id' => 'required',
            'quantity' => 'required',
        ]);

        AssetIssuance::create($request->all());
        $asset_issuances = AssetIssuance::where('issuance_id', $request->issuance_id)->get();
        return redirect()->route('asset_issuance.create', compact('asset_issuances'))
            ->with('success', 'Asset Issuance added successfully.');
    }

    public function edit($id)
    {
        $assetIssuance = AssetIssuance::findOrFail($id);
        // You can pass any necessary data to the view here
        return view('asset_issuance.edit', compact('assetIssuance'));
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
}
