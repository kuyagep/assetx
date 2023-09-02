<?php

namespace Database\Seeders;


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
        DB::table('users')->insert([
            [ //Developer
                'id' => Str::uuid(),
                'first_name' => 'Super Admin',
                'last_name' => 'Account',
                'email' => 'super_admin@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => Carbon::now(),
                'role' => 'super_admin',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ],
            [ //Administrator
                'id' => Str::uuid(),
                'first_name' => 'Administrator',
                'last_name' => 'Account',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => Carbon::now(),
                'role' => 'admin',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [ //Custodian Administrator
                'id' => Str::uuid(),
                'first_name' => 'Client',
                'last_name' => 'Account',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => Carbon::now(),
                'role' => 'client',
                'status' => 'active',
                 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]); //call this class to the DatabaseSeeder & run  'php artisan db:seed --class=UserSeeder'
    }
}