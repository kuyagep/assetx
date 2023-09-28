<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Classification extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'status'
     ];
}