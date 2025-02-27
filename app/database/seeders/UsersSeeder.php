<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 追加
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'test',               // ユーザー名
                'email' => 'test@test',  // メールアドレス
                'password' => Hash::make('password') // パスワードをハッシュ化
            ],
        ]);
        // id 2 から 10 のユーザーを作成
        foreach (range(2, 10) as $id) {
            DB::table('users')->insert([
                'id' => $id,
                'name' => 'User ' . $id,
                'email' => 'user' . $id . '@example.com',
                'password' => Hash::make('password'), // パスワードは適切にハッシュ化
                'profile_picture' =>  'images/default_icon.png', // ダミーの画像を設定
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}


