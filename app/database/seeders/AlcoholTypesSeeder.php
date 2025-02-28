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
        $alcohols = [
            ['name' => 'ビール', 'image_path' => 'beer.png'],
            ['name' => '日本酒', 'image_path' => 'nihonsyu.png'],
            ['name' => '焼酎', 'image_path' => 'syouchu.png'],
            ['name' => 'ウィスキー', 'image_path' => 'whisky.png'],
            ['name' => '赤ワイン', 'image_path' => 'wine.png'],
            ['name' => '白ワイン', 'image_path' => 'white_wine.png'],
            ['name' => 'チューハイ', 'image_path' => 'chuhai.png'],
        ];

        foreach ($alcohols as $alcohol) {
            DB::table('alcohol_types')->insert([
                'name' => $alcohol['name'],
                'image_path' => $alcohol['image_path'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
