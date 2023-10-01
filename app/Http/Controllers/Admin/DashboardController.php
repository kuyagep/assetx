<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function AdminDashboard()
    {
        
        $purchase = Purchase::get();
        $purchasesCount = $purchase->count();
         return view('admin.index', compact('purchasesCount'));
    }
}