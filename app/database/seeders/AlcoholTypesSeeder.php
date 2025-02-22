<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlcoholTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alcohols = ['ビール', '日本酒', '焼酎', 'ウィスキー', '赤ワイン', '白ワイン'];
        foreach ($alcohols as $alcohol) {
            DB::table('alcohol_types')->insert(['name' => $alcohol]);
        }
    }
}
