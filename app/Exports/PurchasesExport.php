<?php

namespace App\Exports;

use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Spatie\Permission\Middlewares\RoleMiddleware;

class PurchasesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // if(auth()->user()->hasRole('super-admin')){    
        //     return Purchase::all();
        // }else{
        //     return Purchase::where('user_id', Auth::user()->id)->get();
        // }
        return Purchase::all();        
    }
}