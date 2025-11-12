<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // posts テーブルにデータを一つ入れる例 (DBファサードを使用)
        DB::table('tasks')->insert(
		        [
		            'title' => 'シーダーで作った記事',
		            'content' => 'この内容はシーダーによって自動で入りました',
		            'deadline_at' => Carbon::now(), // 今の日時を入れる
		            'support_at' => Carbon::now(),
                    'priority' => '1',
                    'status' => '1',
                    'created_at' => Carbon::now(),
		            'updated_at' => Carbon::now(),
                    'deleted_at' => Carbon::now(),
		        ],
		        // ,...
        );//
    }
}
