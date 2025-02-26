<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FriendsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // user_id = 1 で friend_id = 2~10 のレコードを作成
        foreach (range(2, 10) as $friend_id) {
            DB::table('friends')->insert([
                'user_id' => 1,
                'friend_id' => $friend_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            }
    }
}
