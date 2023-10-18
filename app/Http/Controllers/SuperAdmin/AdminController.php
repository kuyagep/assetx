<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function allAdmin(Request $request){
        $users = [];
        if($request->ajax()){
            $users = User::where('role', 'admin')->get();
            return DataTables::of($users)
            ->editColumn('position', function ($request) {
                $result = $request->position->name;
                if($result == null){
                    return "N/A";
                }else{
                    $result = $request->position->name;
                }
                return $result; 
            })
            ->editColumn('phone', function ($request) {
                $result = $request->phone;
                if($result == null){
                    return "N/A";
                }else{
                    $result = $request->phone;
                }
                return $result; 
            })
            ->editColumn('role', function ($request) {
                $result = $request->role;
                if($result == null){
                    return "N/A";
                }else{
                    $result = $request->role;
                }
                return $result; 
            })
            ->editColumn('full_name', function ($request) {
                $result = $request->first_name . " " . $request->last_name;
                return $result;
            })
            ->editColumn('avatar', function ($request) {

                if (empty($request->avatar)) {
                    $temp = asset("assets/dist/img/avatar/default.jpg");
                } else {
                    $temp = asset("assets/dist/img/avatar/" . $request->avatar);
                }

                $result = '<ul class="list-inline">
                        <li class="list-inline-item">
                            <img alt="Avatar" class="table-avatar" src="' . $temp . '" style="width: 2.5rem; height: 2.5rem; border-radius: 50%; object-fit: cover;">
                        </li>
                    </ul>';
                return $result;
                //  return '<img src="' .asset('assets/dist/img/avatar/' . $request->avatar). '" alt="User Image" width="50">';
            })
            ->editColumn('status', function ($request) {

                if($request->status === "active"){
                    $result = '<span class="badge badge-success">Active</span>';
                }else{
                        $result = '<span class="badge badge-danger">Inactive</span>';
                }
                return $result;
            })
            ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d-m-Y H:i:s'); // format date time
            })
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a title="Edit" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-purple btn-sm mr-1 px-2" id="editButton">
                        <i class="fa-regular fa-pen-to-square"></i> </a>';
                $btn .= '<a title="Delete" href="javascript:void(0);" data-id="'.$row->id.'" class="btn bg-danger btn-sm px-2" id="deleteButton">
                        <i class="fa-regular fa-trash-can"></i> </a>';
                return $btn;
            })
            ->rawColumns(['phone','role','position','avatar','action','full_name','status'])
            ->make(true);
        }

        $positions = Position::all();
        return view('pages.admins.all_admin', compact('positions'));
    }
}