<?php

namespace App\Exports;

use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class PurchasesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Purchase::where('user_id', Auth::user()->id)->get();
    }
}