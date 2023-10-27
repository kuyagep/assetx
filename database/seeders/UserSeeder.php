<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       //
       $user =  User::create([
                'id' => Str::uuid(),
                'first_name' => 'Super Admin',
                'last_name' => 'Account',
                'email' => 'super_admin@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => Carbon::now()->timezone('Asia/Manila'),
                'role' => 'super_admin',
                'status' => 'active',
                'created_at' => Carbon::now()->timezone('Asia/Manila'),
                'updated_at' => Carbon::now()->timezone('Asia/Manila')
        ]);
        $user->assignRole(1);

        DB::table('users')->insert([            
            [ //Administrator
                'id' => Str::uuid(),
                'first_name' => 'Administrator',
                'last_name' => 'Account',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => Carbon::now()->timezone('Asia/Manila'),
                'role' => 'admin',
                'status' => 'active',
                'created_at' => Carbon::now()->timezone('Asia/Manila'),
                'updated_at' => Carbon::now()->timezone('Asia/Manila')
            ],
            [ //Custodian Administrator
                'id' => Str::uuid(),
                'first_name' => 'Client',
                'last_name' => 'Account',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => Carbon::now()->timezone('Asia/Manila'),
                'role' => 'client',
                'status' => 'active',
                'created_at' => Carbon::now()->timezone('Asia/Manila'),
                'updated_at' => Carbon::now()->timezone('Asia/Manila'),
            ]
            ,
            [ //Demo Account
                'id' => Str::uuid(),
                'first_name' => 'Demo',
                'last_name' => 'Account',
                'email' => 'demo@deped.gov.ph',
                'password' => Hash::make('demo'),
                'email_verified_at' => Carbon::now()->timezone('Asia/Manila'),
                'role' => 'admin',
                'status' => 'active',
                'created_at' => Carbon::now()->timezone('Asia/Manila'),
                'updated_at' => Carbon::now()->timezone('Asia/Manila'),
            ]
        ]); //call this class to the DatabaseSeeder & run  'php artisan db:seed --class=UserSeeder'
    }
}