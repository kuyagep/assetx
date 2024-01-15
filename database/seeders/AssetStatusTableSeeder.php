<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AssetStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = "BRAND NEW";
         DB::table('asset_status')->insert([
            [ 
                'name' => $name,
                'slug' => Str::slug($name),
                'created_at' => Carbon::now()->timezone('Asia/Manila'),
                'updated_at' => Carbon::now()->timezone('Asia/Manila'),
            ]
        ]);
    }
}