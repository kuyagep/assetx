<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetIssuance extends Model
{
    use HasFactory;

    protected $table = "asset_issuance";
    protected $fillable = ['asset_id', 'issuance_id', 'quantity'];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function issuance()
    {
        return $this->belongsTo(Issuance::class);
    }
}
