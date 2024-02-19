<?php

namespace App\Exports;

use App\Models\PPMP;
use Maatwebsite\Excel\Concerns\FromCollection;

class PPMPExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PPMP::all();
    }
}
