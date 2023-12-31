<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetStatus extends Model
{
    use HasFactory;

    protected $table = 'asset_status';

    protected $fillable = [
        'name',
        'slug',
     ];
     public function asset()
    {
        return $this->hasMany(Asset::class, 'status_id', 'id');
    }
}