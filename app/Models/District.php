<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class District extends Model
{
    use HasFactory;
   
    // protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
     protected $fillable = [
        'division_id',
        'name',
        'slug',
        'status'
     ];

     public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }
     
}