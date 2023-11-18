<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issuance extends Model
{
    use HasFactory;


    protected $table = 'issuances';

    public static function boot()
    {
        parent::boot();
        // issuance_code
        static::creating(function ($issuance) {
            // Generate a unique property code
            $issuance->issuance_code = static::generateUniquePropertyCode();
        });
    }

    public static function generateUniquePropertyCode()
    {
        // You can customize the format of the property code as needed
        $prefix = 'PROP';
        $currentYear = date('Y');
        $currentMonth = date('m');
        $sequenceNumber = static::generateSequenceNumber();

        return "{$prefix}-{$currentYear}-{$currentMonth}-{$sequenceNumber}";
    }

    public static function generateSequenceNumber()
    {
        // Implement your logic to generate a unique sequence number,
        // such as retrieving the last used number from the database
        // and incrementing it.
        // For example, you can use DB queries to get the last used number.
        $lastIssuance = static::orderBy('id', 'desc')->first();
        $lastNumber = $lastIssuance ? substr($lastIssuance->issuance_code, -5) : 0;

        // Increment the last number and pad it with leading zeros
        $newNumber = str_pad(++$lastNumber, 5, '0', STR_PAD_LEFT);

        return $newNumber;
    }

    protected $guarded = [];




    public function issuedBy()
    {
        return $this->belongsTo(User::class, 'issued_by_user_id');
    }

    public function issuedTo()
    {
        return $this->belongsTo(User::class, 'issued_to_user_id'); // Update the column name
    }

    public function issuanceType()
    {
        return $this->belongsTo(IssuanceType::class, 'issuance_type_id');
    }

    public function assets()
    {
        return $this->belongsToMany(Asset::class, 'asset_issuance');
    }


    /*
    to retrieve the issuance type for a specific issuance record:
        $issuance = Issuance::find($issuanceId);
        $issuanceType = $issuance->issuanceType;

    to retrieve all issuance records associated with a particular issuance type:
        $issuanceType = IssuanceType::find($issuanceTypeId);
        $issuances = $issuanceType->issuances;


    */
}
