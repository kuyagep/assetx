<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid();
        });
    }

   
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
     protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public static function getPermissionGroups(){
        $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();

        return $permission_groups;
    }//end 

    public static function getPermissionByGroupName($group_name){
        $permissions = DB::table('permissions')
                        ->select('name', 'id')
                        ->where('group_name', $group_name)
                        ->get();
        return $permissions;
    }





}