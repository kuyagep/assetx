<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Purchase extends Model
{
    use HasFactory;

    // protected static function booted()
    // {
    //     static::creating(function ($model) {
    //         $model->{$model->getKeyName()} = Str::uuid();
    //     });
    // }
    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($purchase) {
    //         // Generate a unique purchase code
    //         $purchase->purchase_number = static::generateUniquePurchaseCode();
    //     });
    // }

    public static function generateUniquePurchaseCode()
    {
        // You can customize the format of the purchase code as needed
        $prefix = 'PR';
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
        $lastPurchase = static::orderBy('id', 'desc')->first();
        $lastNumber = $lastPurchase ? substr($lastPurchase->purchase_number, -3) : 0;

        // Increment the last number and pad it with leading zeros
        $newNumber = str_pad(++$lastNumber, 3, '0', STR_PAD_LEFT);

        return $newNumber;
    }



    protected $guarded = [];

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function history()
    {
        return $this->hasMany(PurchaseHistory::class, 'purchase_id', 'id');
    }


    public function purchase_orders()
    {
        return $this->hasMany(PurchaseOrder::class, 'purchase_id', 'id');
    }
}
