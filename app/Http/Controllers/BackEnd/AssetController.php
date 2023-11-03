<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetClassification;
use App\Models\AssetStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class AssetController extends Controller
{
    
    public function index()
    {
        $assets = Asset::all();
        $classifications  = AssetClassification::all();
        $asset_status = AssetStatus::all(); 
        return view('pages.assets.index', compact('assets', 'classifications','asset_status'));
    }

    public function create()
    {
        // Create a form to add a new asset
        $classifications  = AssetClassification::all();
        $asset_status = AssetStatus::all(); 
        return view('pages.assets.create', compact( 'classifications','asset_status'));
       
    }

    public function store(Request $request)
    {
        // Validation rules
    $rules = [
        'article' => 'required|string|max:255',
        'description' => 'required|string',
        'unit_of_measure' => 'required|string|max:255',
        'unit_value' => 'required|numeric',
        'balance_per_card_qty' => 'required|integer',
        'date_acquired' => 'required|date',
        'classification_id' => 'required|exists:asset_classifications,id',
        'status_id' => 'required',
    ];

    // Custom error messages
    $customMessages = [
        'classification_id.exists' => 'The selected classification is invalid.',
        'status_id.exists' => 'The selected status is invalid.',
    ];

    // Validate the request data
    $validator = Validator::make($request->all(), $rules, $customMessages);

    // Check if validation fails
    if ($validator->fails()) {
        return redirect()->route('assets.create')
            ->withErrors($validator)
            ->withInput();
    }
    $asset = new Asset;
    $asset->article = $request->article;
    $asset->description = $request->description;
    $asset->unit_of_measure = $request->unit_of_measure;
    $asset->unit_value = $request->unit_value;
    $asset->balance_per_card_qty = $request->balance_per_card_qty;
    $asset->balance_per_card_value = $request->balance_per_card_qty * $request->unit_value;
    $asset->date_acquired = $request->date_acquired;
    $asset->classification_id = $request->classification_id;
    $asset->status_id = $request->status_id;
        $asset->save();
       return redirect()->route('assets.index')
        ->with('success', 'Asset added successfully');
    }

    public function show(Asset $asset)
    {
        return view('pages.assets.show', compact('asset'));
    }

    public function edit(Asset $asset)
    {
        return view('pages.assets.edit', compact('asset'));
    }

    public function update(Request $request, Asset $asset)
    {
        $asset->update($request->all());
        return redirect()->route('assets.index');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect()->route('assets.index');
    }

}