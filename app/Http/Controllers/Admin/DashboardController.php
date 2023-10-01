<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function AdminDashboard()
    {
        
        $purchase = Purchase::get();
        $purchasesCount = $purchase->count();
        $user = User::get();
        $users = $user->count();
         return view('admin.index', compact('purchasesCount', 'users'));
    }
}