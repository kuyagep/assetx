<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

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

    public function purchase()
    {
        return $this->hasMany(Purchase::class, 'office_id', 'id');
    }

     public function user()
    {
        return $this->hasMany(User::class, 'office_id', 'id');
    }
}