<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;


     protected $fillable = [
        'district_id',
        'school_id',
        'name',
        'code',
        'logo',
        'slug',
        'status'
     ];

     public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}