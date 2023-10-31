<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issuance extends Model
{
    use HasFactory;

    protected $table = 'issuances';

    protected $guarded = [];

    public function issuedBy()
    {
        return $this->belongsTo(User::class, 'issued_by_user_id');
    }

    public function issuedTo()
{
    return $this->belongsTo(User::class, 'issued_to_user_id'); // Update the column name
}
}