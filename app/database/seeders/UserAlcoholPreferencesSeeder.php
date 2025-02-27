<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAlcoholPreferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $preferences = ['好き', '普通', '嫌い'];

        foreach (range(1, 10) as $userId) {
            foreach (range(1, 3) as $alcoholTypeId) { // お酒の種類ごとにデータを作成（例: 3種類）
                DB::table('user_alcohol_preferences')->insert([
                    'user_id' => $userId,
                    'alcohol_type_id' => $alcoholTypeId,
                    'preference' => $preferences[array_rand($preferences)], // ランダムで好みを選択
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
