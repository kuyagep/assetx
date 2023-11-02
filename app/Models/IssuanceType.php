<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuanceType extends Model
{
    use HasFactory;

    protected $table = 'issuance_types';

    protected $fillable = [
        'name',
        'slug',
     ];

     public function issuances()
    {
        return $this->hasMany(Issuance::class, 'issuance_type_id');
    }
    /**
     * to retrieve the issuance type for a specific issuance record:
     * $issuance = Issuance::find($issuanceId);
    * $issuanceType = $issuance->issuanceType;
    * 
    * to retrieve all issuance records associated with a particular issuance type:
    *
    *$issuanceType = IssuanceType::find($issuanceTypeId);
    *$issuances = $issuanceType->issuances;

    */
     
}