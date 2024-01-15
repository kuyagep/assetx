<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Office;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
class OfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = "Supply Office";
       $office = Office::create([
            'division_id' => 1,
            'name' => $name,
            'slug' => Str::slug($name),
            'created_at' => Carbon::now()->timezone('Asia/Manila'),
            'updated_at' => Carbon::now()->timezone('Asia/Manila'),
        ]);
       
    }
}