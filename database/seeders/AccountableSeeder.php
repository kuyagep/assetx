<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accountables')->insert([
            [ 
                'code' => 'PRO-2023-09-032',
                'name' => 'Seminar Workshop Title',
                'total_cost' => 456789,
                'asset_status' => 'working',
                'created_at' => Carbon::now()->timezone('Asia/Manila'),
                'updated_at' => Carbon::now()->timezone('Asia/Manila'),
            ],
            [ 
                'code' => 'PRO-2023-09-038',
                'name' => 'Seminar Workshop Title 2',
                'total_cost' => 4567893,
                'asset_status' => 'working',
                'created_at' => Carbon::now()->timezone('Asia/Manila'),
                'updated_at' => Carbon::now()->timezone('Asia/Manila'),
            ],
            [ 
                'code' => 'PRO-2023-09-056',
                'name' => 'Seminar Workshop Title 3',
                'total_cost' => 6544333,
                'asset_status' => 'working',
                'created_at' => Carbon::now()->timezone('Asia/Manila'),
                'updated_at' => Carbon::now()->timezone('Asia/Manila'),
            ]
        ]);
    }
}