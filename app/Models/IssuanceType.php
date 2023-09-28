<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuanceType extends Model
{
    use HasFactory;

    protected $table = 'issuance_type';

    protected $fillable = [
        'name',
        'slug',
     ];
}