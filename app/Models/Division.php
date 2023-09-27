<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Division extends Model
{
    use HasFactory;
    protected $table = 'divisions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
     protected $fillable = [
        'name',
        'address',
        'logo',
        'slug',
        'status'
     ];

     public function districts()
    {
        return $this->hasMany(District::class, 'division_id', 'id');
    }
     public function offices()
    {
        return $this->hasMany(Office::class, 'division_id', 'id');
    }
}