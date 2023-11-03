<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetClassification extends Model
{
    use HasFactory;

    protected $table = 'asset_classifications';
    protected $fillable = [
        'name',
        'slug',
        'status'
    ];

    public function asset()
    {
        return $this->hasMany(Asset::class, 'classification_id', 'id');
    }
}