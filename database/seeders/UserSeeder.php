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

        $user1 =  User::create([
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

        $user2 =  User::create([
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


        $user3 =  User::create([
            'id' => Str::uuid(),
            'first_name' => 'Sub Admin',
            'last_name' => 'Account',
            'email' => 'sub_admin@gmail.com',
            'password' => Hash::make('password@123'),
            'email_verified_at' => Carbon::now()->timezone('Asia/Manila'),
            'role' => 'sub_admin',
            'status' => 1,
            'created_at' => Carbon::now()->timezone('Asia/Manila'),
            'updated_at' => Carbon::now()->timezone('Asia/Manila')
        ]);

        $user4 =  User::create([
            'id' => Str::uuid(),
            'first_name' => 'User',
            'last_name' => 'Account',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password@123'),
            'email_verified_at' => Carbon::now()->timezone('Asia/Manila'),
            'role' => 'users',
            'status' => 1,
            'created_at' => Carbon::now()->timezone('Asia/Manila'),
            'updated_at' => Carbon::now()->timezone('Asia/Manila')
        ]);

        $user5 =  User::create([
            'id' => Str::uuid(),
            'first_name' => 'Client',
            'last_name' => 'Account',
            'email' => 'client@gmail.com',
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
        $user1->assignRole(1);
        $user2->assignRole(2);
        $user3->assignRole(3);
        $user4->assignRole(4);
        $user5->assignRole(5);
    }
}
