<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            AlcoholTypesSeeder::class,
            UsersSeeder::class,
            FriendsSeeder::class,
            UserAlcoholPreferencesSeeder::class
            ]);
        // DB::table('users')->insert([
        //     [
        //         'name' => 'test',               // ユーザー名
        //         'email' => 'test@test',  // メールアドレス
        //         'password' => Hash::make('password') // パスワードをハッシュ化
        //     ],
        // ]);
    }
}
