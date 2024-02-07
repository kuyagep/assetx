<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DivisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Division::create(
            [                
                'name' => 'Division Of Davao del Sur',
                'slug' => Str::slug('Division Of Davao del Sur'),
                'status' => 1,
                'created_at' => Carbon::now()->timezone('Asia/Manila'),
                'updated_at' => Carbon::now()->timezone('Asia/Manila')
            ]
        );
    }
}