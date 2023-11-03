<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('asset_classifications')->insert([
            [ 
                'name' => 'IT EQUIPMENT',
                'slug' => Str::slug('IT EQUIPMENT'),
                'created_at' => Carbon::now()->timezone('Asia/Manila'),
                'updated_at' => Carbon::now()->timezone('Asia/Manila'),
            ]
        ]);
    }
}