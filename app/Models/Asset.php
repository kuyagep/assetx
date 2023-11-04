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
            $property->property_no = static::generateUniquePropertyCode();
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
        $lastNumber = $lastProperty ? substr($lastProperty->property_no, -5) : 0;

        // Increment the last number and pad it with leading zeros
        $newNumber = str_pad(++$lastNumber, 5, '0', STR_PAD_LEFT);

        return $newNumber;
    }



    protected $fillable = [
        'article',
        'description',
        'reference',
        'property_no',
        'unit_of_measure',
        'unit_value',
        'balance_per_card_qty',
        'balance_per_card_value',
        'onhand_per_count_qty',
        'onhand_per_count_value',
        'shortage_overage_qty',
        'shortage_overage_value',
        'date_acquired',
        'remarks',
        'classification_id',
        'status_id',
        'issuance_id',
    ];

    public function classification()
    {
        return $this->belongsTo(AssetClassification::class, 'classification_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo(AssetStatus::class, 'status_id', 'id');
    }
    public function issuances()
    {
        return $this->belongsToMany(Issuance::class, 'asset_issuance');
    }


    /**
     * to retrieve all issuances for a specific asset along with the user information:
     * $asset = Asset::find($assetId);
     * $issuances = $asset->issuances;

     */

     /**
      * o retrieve all issuances for a specific user:
      *$user = User::find($userId);
    *$issuances = $user->issuances;
    *
      */
}