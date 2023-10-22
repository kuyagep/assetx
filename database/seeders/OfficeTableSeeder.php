<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Office;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
       $office = Office::create([
            'division_id' => 1,
            'name' => 'N/A',
            'slug' => 'n-a',
            'created_at' => Carbon::now()->timezone('Asia/Manila'),
            'updated_at' => Carbon::now()->timezone('Asia/Manila'),
        ]);
       
    }
}