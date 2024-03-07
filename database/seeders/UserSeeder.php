<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
       
       $user0 =  User::create([
                'id' => Str::uuid(),
                'first_name' => 'Super Admin',
                'last_name' => 'Account',
                'email' => 'super_admin@gmail.com',
                'password' => Hash::make('password@123'),
                'email_verified_at' => Carbon::now()->timezone('Asia/Manila'),
                'role' => 'super_admin',
                'status' => 1,
                'created_at' => Carbon::now()->timezone('Asia/Manila'),
                'updated_at' => Carbon::now()->timezone('Asia/Manila')
        ]);        
        
       $user1 =  User::create([
                'id' => Str::uuid(),
                'first_name' => 'Administrator',
                'last_name' => 'Account',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password@123'),
                'email_verified_at' => Carbon::now()->timezone('Asia/Manila'),
                'role' => 'admin',
                'status' => 1,
                'created_at' => Carbon::now()->timezone('Asia/Manila'),
                'updated_at' => Carbon::now()->timezone('Asia/Manila')
        ]);
        

       $user2 =  User::create([
                'id' => Str::uuid(),
                'first_name' => 'Demo',
                'last_name' => 'Account',
                'email' => 'demo@gmail.com',
                'password' => Hash::make('password@123'),
                'email_verified_at' => Carbon::now()->timezone('Asia/Manila'),
                'role' => 'client',
                'status' => 1,
                'created_at' => Carbon::now()->timezone('Asia/Manila'),
                'updated_at' => Carbon::now()->timezone('Asia/Manila')
        ]);        
        // Role::create(['name' => 'super-admin']);
        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'sub-admin']);
        // Role::create(['name' => 'user']);
        // Role::create(['name' => 'client']);
        $user0->assignRole(1);
        $user1->assignRole(2);
        $user2->assignRole(3);
    }
}