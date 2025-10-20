<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create(
            [
                'name' => 'テストユーザー',
                'email' => 'test@example.com', // 認証に使うメールアドレスを設定
                'password' => Hash::make('password'), // パスワードをハッシュ化して保存
                // 他に必要なデフォルトカラムがあればここに追加 (例: email_verified_at など)
            ],
            // ...
        );
    }
}
