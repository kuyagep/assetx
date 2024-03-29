<?php

namespace App\Http\Controllers\BackEnd;

use App\Exports\PurchaseOrders;
use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $data = [];
        if ($request->ajax()) {
            if (auth()->user()->hasRole('super-admin')) {
                $data = PurchaseOrder::all();
            } else {
                $data = PurchaseOrder::where('user_id', Auth::user()->id)->get();
            }

            return DataTables::of($data)
                ->editColumn('office', function ($request) {
                    return $request->office->name;
                })

                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d-m-Y H:i:s');
                })
                ->editColumn('isApproved', function ($request) {

                    if ($request->isApproved === "approved") {
                        $result = '<span class="badge badge-success">Approved</span>';
                    } elseif ($request->isApproved === "pending") {
                        $result = '<span class="badge badge-warning">Pending</span>';
                    } elseif ($request->isApproved === "cancelled") {
                        $result = '<span class="badge badge-danger">Cancelled</span>';
                    } elseif ($request->isApproved === "rebid") {
                        $result = '<span class="badge badge-primary">Rebid</span>';
                    }
                    return $result;
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    

                    $btn = '<div class="btn-group">';
                    $btn .= '<button title="History" type="button" data-id="' . $row->id . '" class="btn btn-sm bg-navy" id="history-button"><i class="fas fa-history"></i></button>';
                    if (auth()->user()->hasRole('admin')) {
                        $btn .= '<button title="Edit" type="button" data-id="' . $row->id . '" class="btn btn-sm btn-warning" id="editButton"><i class="far fa-edit"></i></button>';
                    }
                    if (auth()->user()->hasRole('super-admin')) {
                        $btn .= '<button type="button" data-id="' . $row->id . '" class="btn bg-olive btn-sm " id="approvedButton"><i class="fas fa-check"></i></button>';
                        $btn .= '<button type="button" data-id="' . $row->id . '" class="btn bg-danger btn-sm " id="deleteButton"><i class="far fa-trash-alt"></i></button>';
                    }

                    $btn .= '<div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm  dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                            </button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" data-id="' . $row->attachment . '" title="Download" href="javascript:void(0)" id="downloadButton">Download</a>
                                     <a class="dropdown-item" href="#">Dropdown link</a>
                                </div>
                            </div>
                        </div>';

                    return $btn;
                })
                ->rawColumns(['action', 'isApproved', 'created_at', 'office'])
                ->make(true);
        }

        return view('pages.purchase_order.index');
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
                'po_category' => 'required',
                'po_date' => 'required|date',
                'amount' => 'required|numeric|min:0.01|max:999999999999.99',
                'remarks' => 'required|string|max:255',
                'attachment' => 'file|mimes:xlsx,xls|max:2048',
            ]);


            // checked if new data or exists
            if (empty($request->id)) {
                
                $data = new PurchaseOrder();
                $data->category = $request->po_category;
                $data->purchase_id = $request->purchase_id;
                $data->supplier_id = $request->supplier_id;
                $data->purchase_order_date = $request->po_date;
                $data->amount = $request->amount;
                $data->remarks = $request->remarks;
                
                $request->status = "pending";

                if ($request->hasFile('attachment')) {
                    $attachment = $request->file('attachment');

                    // Upload the new file 
                    $attachment = Storage::disk('local')->putFileAs('/', $attachment, str()->uuid() . '.' . $attachment->extension());

                    $data['attachment'] = $attachment;
                }
                $data->save();

                // history
                // $purchaseHistory = new PurchaseHistory;
                // $purchaseHistory->purchase_id = $data->id; // Set the purchase_id to link it with the newly created purchase
                // $purchaseHistory->manage_by = Auth::user()->id; // You can set an action or description for the history
                // $purchaseHistory->action = 'submit'; // You can set an action or description for the history
                // $purchaseHistory->remarks = 'Submitted document for approval'; // You can set an action or description for the history

                // $purchaseHistory->save();

                return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'Purchase Order saved successfully!']);
            } else {
                $data = PurchaseOrder::find($request->id);
                // $data->get_started = $request->get_started;
                $data->alt_mode_procurement = $request->alt_mode_procurement;
                // $data->src_fund = $request->src_fund;
                $data->amount = $request->amount;
                if (auth()->user()->hasRole('super-admin')) {
                    $data->isApproved = $request->isApproved;
                }

                if ($request->hasFile('attachment')) {
                    $attachment = $request->file('attachment');

                    // Upload the new file and update the record
                    $attachment = Storage::disk('local')->putFileAs('/', $attachment, str()->uuid() . '.' . $attachment->extension());
                    // Delete the old file if it exists
                    if ($data->attachment) {
                        Storage::delete($data->attachment);
                    }
                    // $file->move(public_path('assets/dist/attachment/purchases'), $filename);
                    $data['attachment'] = $attachment;
                }
                $data->user_id = Auth::user()->id;
                $data->office_id = Auth::user()->office_id;
                $data->save();



                return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'Purchase Order updated successfully!']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = ['id' => $request->id];
        $data = PurchaseOrder::where($id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = ['id' => $request->id];
        $data = PurchaseOrder::where($id)->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    }

    public function history(Request $request, $id)
    {
        $purchase = PurchaseOrder::findOrFail($id);
        // $histories = PurchaseHistory::where('purchase_id', $purchase->id)->orderBy('created_at', 'desc')->get();

        return view('pages.purchase_order.history', compact('purchase', 'histories'));
    }

    public function download(Request $request, $id)
    {
        //$filePath = 'private/' . $id;
        $storagePath = storage_path("app/{$id}");

        if (Storage::disk('local')->exists($id)) {
            // Perform authorization checks (e.g., user roles or permissions) here
            // For example, check if the user is authenticated
            if (Auth::check()) {
                // Check for any other authorization logic you need
                // For example, you can check user roles or permissions here
                // if (Auth::user()->hasRole('admin')) {
                return response()->download($storagePath);
                // }
            } else {
                abort(403); // Unauthorized access
            }
        }
        abort(404); // File not found
    }


    public function exportPurchaseOrder() 
    {        
        return Excel::download(new PurchaseOrders, time().'_purchase_orders.xlsx');
    }
    public function approved(Request $request)
    {
        if ($request->ajax()) {
            $data = PurchaseOrder::find($request->id);
            if (auth()->user()->hasRole('super-admin')) {
                $data->isApproved = 'approved';
            }

            $data->save();

            // $purchaseHistory = new PurchaseHistory;
            // $purchaseHistory->purchase_id = $data->id; // Set the purchase_id to link it with the newly created purchase
            // $purchaseHistory->manage_by = Auth::user()->id; // You can set an action or description for the history
            // $purchaseHistory->action = 'approved'; // You can set an action or description for the history
            // $purchaseHistory->remarks = 'Approved the document'; // You can set an action or description for the history

            // $purchaseHistory->save();
            return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'Purchase Order approved successfully!']);
        }

        return response()->json(['icon' => 'error', 'title' => 'Ooops!', 'message' => 'Something went wrong! Try again!']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $data = PurchaseOrder::where('id', $request->id)->first();

            if ($data->attachment) {
                Storage::delete($data->attachment);
            }

            $data->delete();
            return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'Purchase Order deleted successfully!']);
        }

        return response()->json(['icon' => 'error', 'title' => 'Ooops!', 'message' => 'Something went wrong! Try again!']);
    }

    public function adminPurchaseOrder (Request $request)
    {

        $data = [];
        if ($request->ajax()) {
            $data = PurchaseOrder::all();
            return DataTables::of($data)
                ->editColumn('purchase_number', function ($request) {                    
                    return $request->purchase->purchase_number;
                })
                ->editColumn('title', function ($request) {                    
                    return $request->purchase->title;
                })
                ->editColumn('amount', function ($request) {
                     return number_format($request->amount, 2, '.', ',');
                })
                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d-m-Y H:i:s');
                })
                ->editColumn('status', function ($request) {

                    if ($request->status === "approved") {
                        $result = '<span class="badge badge-success">Approved</span>';
                    } elseif ($request->status === "pending") {
                        $result = '<span class="badge badge-warning">Pending</span>';
                    } elseif ($request->status === "cancelled") {
                        $result = '<span class="badge badge-danger">Cancelled</span>';
                    } elseif ($request->status === "rebid") {
                        $result = '<span class="badge badge-primary">Rebid</span>';
                    }
                    return $result;
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<div class="btn-group">';
                    $btn .= '<button title="History" type="button" data-id="' . $row->id . '" class="btn btn-sm bg-navy" id="history-button"><i class="fas fa-history"></i></button>';
                    if (auth()->user()->hasRole('client')) {
                        $btn .= '<button title="Edit" type="button" data-id="' . $row->id . '" class="btn btn-sm btn-warning" id="editButton"><i class="far fa-edit"></i></button>';
                    }


                    $btn .= '<div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm  dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                            </button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" data-id="' . $row->attachment . '" title="Download" href="javascript:void(0)" id="downloadButton">Download</a>
                                </div>
                            </div>
                        </div>';

                    return $btn;
                })
                ->rawColumns(['action', 'status', 'created_at','amount','title','purchase_number'])
                ->make(true);
        }

        $purchases = Purchase::all();
        $suppliers = Supplier::all();

        return view('pages.purchase_order.admin_purchase_order', compact('purchases','suppliers'));
    }
    public function clientPurchaseOrder (Request $request)
    {

        $data = [];
        if ($request->ajax()) {
            $data = PurchaseOrder::all();
            return DataTables::of($data)
                ->editColumn('purchase_number', function ($request) {                    
                    return $request->purchase->purchase_number;
                })
                ->editColumn('title', function ($request) {                    
                    return $request->purchase->title;
                })
                ->editColumn('amount', function ($request) {
                     return number_format($request->amount, 2, '.', ',');
                })
                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d-m-Y H:i:s');
                })
                ->editColumn('status', function ($request) {

                    if ($request->status === "approved") {
                        $result = '<span class="badge badge-success">Approved</span>';
                    } elseif ($request->status === "pending") {
                        $result = '<span class="badge badge-warning">Pending</span>';
                    } elseif ($request->status === "cancelled") {
                        $result = '<span class="badge badge-danger">Cancelled</span>';
                    } elseif ($request->status === "rebid") {
                        $result = '<span class="badge badge-primary">Rebid</span>';
                    }
                    return $result;
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    
                    

                    $btn = '<div class="btn-group">';
                    $btn .= '<button title="History" type="button" data-id="' . $row->id . '" class="btn btn-sm bg-navy" id="history-button"><i class="fas fa-history"></i></button>';
                    if (auth()->user()->hasRole('client')) {
                        $btn .= '<button title="Edit" type="button" data-id="' . $row->id . '" class="btn btn-sm btn-warning" id="editButton"><i class="far fa-edit"></i></button>';
                    }

                    if (auth()->user()->hasRole('super-admin')) {
                        $btn .= '<button type="button" data-id="' . $row->id . '" class="btn bg-olive btn-sm " id="approvedButton"><i class="fas fa-check"></i></button>';
                        $btn .= '<button type="button" data-id="' . $row->id . '" class="btn bg-danger btn-sm " id="deleteButton"><i class="far fa-trash-alt"></i></button>';
                    }

                    $btn .= '<div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm  dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                            </button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" data-id="' . $row->attachment . '" title="Download" href="javascript:void(0)" id="downloadButton">Download</a>
                                </div>
                            </div>
                        </div>';

                    return $btn;
                })
                ->rawColumns(['action', 'status', 'created_at','amount','title','purchase_number'])
                ->make(true);
        }

        $purchases = Purchase::all();
        $suppliers = Supplier::all();

        return view('pages.purchase_order.client_purchase_order', compact('purchases','suppliers'));
    }

    public function getPurchaseOrder(Request $request)
    {

        $purchase = Purchase::all();
        return response()->json($purchase);
    }
}