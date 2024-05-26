<?php

namespace App\Http\Controllers\BackEnd;

use App\Exports\PPMPExport;
use App\Http\Controllers\Controller;
use App\Models\PPMP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PPMPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $data = [];
        if ($request->ajax()) {

            $data = PPMP::all();

            return DataTables::of($data)

                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d-m-Y H:i:s');
                })
                ->editColumn('status', function ($request) {

                    if ($request->status === 'pending') {
                        $result = '<span class="badge badge-warning">pending</span>';
                    } elseif ($request->status === 'reject') {
                        $result = '<span class="badge badge-danger">Reject</span>';

                    } elseif ($request->status === 'approved') {
                        $result = '<span class="badge badge-success">Approved</span>';
                    }

                    return $result;
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<div class="btn-group">';

                    if (auth()->user()->hasRole('super-admin')) {
                        $btn .= '<button type="button" data-id="' . $row->id . '" class="btn bg-success btn-sm" id="approvedButton"><i class="fas fa-check"></i></button>';
                        $btn .= '<button type="button" data-id="' . $row->id . '" class="btn bg-warning btn-sm" id="rejectButton"><i class="fa-solid fa-x"></i></button>';
                        $btn .= '<button type="button" data-id="' . $row->id . '" class="btn bg-danger btn-sm" id="deleteButton"><i class="far fa-trash-alt"></i></button>';
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
                ->rawColumns(['action', 'status', 'created_at'])
                ->make(true);
        }

        return view('pages.ppmp.index');
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
                'remarks' => 'required|string|max:255',
                'attachment' => 'file|mimes:xlsx,xls|max:2048',
                'amount' => 'required|numeric|min:0.01|max:999999999999.99',
            ]);

            // checked if new data or exists
            if (empty($request->id)) {

                $data = new PPMP();

                $data->remarks = $request->remarks;
                $data->amount = $request->amount;

                if ($request->hasFile('attachment')) {
                    $attachment = $request->file('attachment');

                    // Upload the new file
                    $attachment = Storage::disk('local')->putFileAs('/', $attachment, str()->uuid() . '.' . $attachment->extension());

                    $data['attachment'] = $attachment;
                }

                // $data->user_id = Auth::user()->id;
                $data->save();

                return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'PPMP submitted successfully!']);

            } else {
                $data = PPMP::find($request->id);
                $data->get_started = $request->get_started;
                $data->alt_mode_procurement = $request->alt_mode_procurement;
                $data->title = $request->title;
                $data->src_fund = $request->src_fund;
                $data->amount = $request->amount_abc;
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
                // $data->user_id = Auth::user()->id;
                // $data->office_id = Auth::user()->office_id;
                $data->save();

                return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'PPMP updated successfully!']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = ['id' => $request->id];
        $data = PPMP::where($id)->first();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = ['id' => $request->id];
        $data = PPMP::where($id)->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
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

    public function exportPPMP()
    {
        return Excel::download(new PPMPExport, time() . 'ppmp.xlsx');
    }
    public function approved(Request $request, $id)
    {
        if ($request->ajax()) {

            $data = PPMP::findOrFail($id);
            if (auth()->user()->hasRole('super-admin')) {
                $data->status = 'approved';
            }

            $data->save();

            return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => $data->remarks]);
        }

        return response()->json(['icon' => 'error', 'title' => 'Ooops!', 'message' => 'Something went wrong! Try again!']);
    }
    public function reject(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = PPMP::findOrFail($id);
            if (auth()->user()->hasRole('super-admin')) {
                $data->status = 'reject';
            }

            $data->save();

            return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'PPMP reject successfully!']);
        }

        return response()->json(['icon' => 'error', 'title' => 'Ooops!', 'message' => 'Something went wrong! Try again!']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $data = PPMP::where('id', $request->id)->first();

            if ($data->attachment) {
                Storage::delete($data->attachment);
            }

            $data->delete();
            return response()->json(['icon' => 'success', 'title' => 'Success!', 'message' => 'Purchase Request deleted successfully!']);
        }

        return response()->json(['icon' => 'error', 'title' => 'Ooops!', 'message' => 'Something went wrong! Try again!']);
    }

}
