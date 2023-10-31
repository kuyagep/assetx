<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'assets';

    //generate property code
    public static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            // Generate a unique property code
            $property->property_code = static::generateUniquePropertyCode();
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
        $lastProperty = static::orderBy('id', 'desc')->first();
        $lastNumber = $lastProperty ? substr($lastProperty->property_code, -5) : 0;

        // Increment the last number and pad it with leading zeros
        $newNumber = str_pad(++$lastNumber, 5, '0', STR_PAD_LEFT);

        return $newNumber;
    }



    protected $guarded = [];

    public function classification()
    {
        return $this->belongsTo(AssetClassification::class, 'classification_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo(AssetStatus::class, 'status_id', 'id');
    }
    public function issuance_type()
    {
        return $this->belongsTo(IssuanceType::class, 'issuance_type_id', 'id');
    }
}