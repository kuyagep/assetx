<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'assets';

    protected $guarded = [];

    public function classifications()
    {
        return $this->belongsTo(Classification::class, 'classification_id', 'id');
    }
    public function asset_status()
    {
        return $this->belongsTo(AssetStatus::class, 'asset_status_id', 'id');
    }
    public function issuance_type()
    {
        return $this->belongsTo(IssuanceType::class, 'issuance_type_id', 'id');
    }
}